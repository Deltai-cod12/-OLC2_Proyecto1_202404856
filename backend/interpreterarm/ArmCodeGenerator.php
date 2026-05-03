<?php

namespace interpreterarm;

use generated_arm\GolampiArmVisitor;
use generated_arm\Context\ProgramContext;
use generated_arm\Context\FunctionDeclContext;
use generated_arm\Context\ParamsContext;
use generated_arm\Context\ParamContext;
use generated_arm\Context\ReturnTypesContext;
use generated_arm\Context\BlockContext;
use generated_arm\Context\StatementContext;
use generated_arm\Context\StatementCoreContext;
use generated_arm\Context\VarDeclContext;
use generated_arm\Context\ConstDeclContext;
use generated_arm\Context\ShortVarDeclContext;
use generated_arm\Context\AssignmentContext;
use generated_arm\Context\AssignTargetContext;
use generated_arm\Context\AssignOpContext;
use generated_arm\Context\IdListContext;
use generated_arm\Context\ExpListContext;
use generated_arm\Context\TypeContext;
use generated_arm\Context\BaseTypeContext;
use generated_arm\Context\PointerTypeContext;
use generated_arm\Context\ArrayTypeContext;
use generated_arm\Context\ArrayDimensionContext;
use generated_arm\Context\ArrayLiteralContext;
use generated_arm\Context\ArrayElementsContext;
use generated_arm\Context\ArrayElementContext;
use generated_arm\Context\ArrayAccessContext;
use generated_arm\Context\ArrayIndexContext;
use generated_arm\Context\PointerAccessContext;
use generated_arm\Context\FunctionCallContext;
use generated_arm\Context\FunctionNameContext;
use generated_arm\Context\ArgsContext;
use generated_arm\Context\ExpressionContext;
use generated_arm\Context\LogicalOrExpContext;
use generated_arm\Context\LogicalAndExpContext;
use generated_arm\Context\EqualityExpContext;
use generated_arm\Context\RelationalExpContext;
use generated_arm\Context\AdditiveExpContext;
use generated_arm\Context\MultiplicativeExpContext;
use generated_arm\Context\UnaryExpContext;
use generated_arm\Context\PrimaryContext;
use generated_arm\Context\IfStmtContext;
use generated_arm\Context\SwitchStmtContext;
use generated_arm\Context\CaseClauseContext;
use generated_arm\Context\DefaultClauseContext;
use generated_arm\Context\ForStmtContext;
use generated_arm\Context\ForClauseContext;
use generated_arm\Context\SimpleStmtContext;
use generated_arm\Context\IncDecStmtContext;
use generated_arm\Context\ShortVarDeclNoSemiContext;
use generated_arm\Context\AssignmentNoSemiContext;
use generated_arm\Context\BreakStmtContext;
use generated_arm\Context\ContinueStmtContext;
use generated_arm\Context\ReturnStmtContext;

use reportsarm\ErrorReport;
use reportsarm\SymbolTableReport;

use Antlr\Antlr4\Runtime\Tree\AbstractParseTreeVisitor;
use Antlr\Antlr4\Runtime\ParserRuleContext;

require_once __DIR__ . '/FrameManager.php';
require_once __DIR__ . '/ArmSymbolTable.php';

/**
 * Generador de código ARM64 (AArch64) para el lenguaje Golampi.
 *
 * ARQUITECTURA:
 *   - Usa FrameManager para layout del stack con prólogo diferido.
 *   - Las variables empiezan en [x29, #16] y crecen hacia offsets positivos.
 *   - visitExpressionToReg devuelve un ValResult (valor + tipo) para
 *     que emitPrintln nunca confunda un puntero de string con un entero.
 *   - El prólogo (`stp x29, x30, [sp, #-SIZE]!`) se inserta al final,
 *     cuando ya se conoce el tamaño real del frame.
 */
class ArmCodeGenerator extends AbstractParseTreeVisitor implements GolampiArmVisitor
{
    private ArmSymbolTable     $symTable;
    private FrameManager       $frame;
    private ErrorReport        $errorReport;
    private SymbolTableReport  $symReport;

    // ── Código generado ────────────────────────────────────────────────────
    /** @var string[] sección .data */
    private array $dataSection     = [];
    /** @var string[] sección .text (funciones ya finalizadas) */
    private array $textSection     = [];
    /** @var string[] cuerpo de la función que se está compilando ahora */
    private array $currentFuncCode = [];

    // ── Contexto de generación ─────────────────────────────────────────────
    private string $currentFunc = '';
    private int    $labelCount  = 0;
    private int    $strCount    = 0;

    /** Pila de etiquetas break/continue para bucles */
    private array $breakStack    = [];
    private array $continueStack = [];

    /** Todas las funciones declaradas (primer pase, hoisting) */
    private array $declaredFunctions = [];

    /**
     * Offset del scratch slot usado en emitPrintln para preservar x19.
     * Se asigna al entrar en cada función vía FrameManager::reserveSlot().
     */
    private int $scratchOffset = 16;

    public function __construct(
        ErrorReport      $errorReport,
        SymbolTableReport $symReport
    ) {
        $this->symTable = new ArmSymbolTable();
        $this->frame    = new FrameManager();
        $this->errorReport = $errorReport;
        $this->symReport   = $symReport;
    }

    // ══════════════════════════════════════════════════════════════════════
    //  RESULTADO FINAL
    // ══════════════════════════════════════════════════════════════════════

    /**
     * Convierte el contenido de un string Golampi a formato .ascii para GNU as.
     */
    private function escapeStringForAsm(string $content): string
    {
        $map = [
            "\\n"  => "\n",
            "\\t"  => "\t",
            "\\r"  => "\r",
            "\\\\" => "\\",
        ];
        $result = str_replace(array_keys($map), array_values($map), $content);
        $result = preg_replace('/(?<!\\\\)"/', '\\"', $result);
        return $result;
    }

    public function getAssembly(): string
    {
        $out = [];
        $out[] = '# Código ARM64 generado por Golampi Compiler';
        $out[] = '# Arquitectura: AArch64 (ARM64)';
        $out[] = '';

        $out[] = '.section .data';
        foreach ($this->dataSection as $line) {
            $out[] = $line;
        }
        $out[] = '_int_buf:   .space 32';
        $out[] = '_float_buf: .space 32';
        $out[] = '_newline:   .byte 10';
        $out[] = '_space_ch:  .byte 32';
        $out[] = '_dot_ch:    .byte 46';
        $out[] = '_true_str:  .ascii "true"';
        $out[] = '_false_str: .ascii "false"';
        $out[] = '_nil_str:   .ascii "<nil>"';
        $out[] = '_null_str:  .byte 0';
        $out[] = '_empty_str: .byte 0';
        $out[] = '';

        $out[] = '.section .text';
        $out[] = '.align 2';
        $out[] = '.global _start';
        $out[] = '';

        foreach ($this->buildRuntime() as $l) {
            $out[] = $l;
        }

        foreach ($this->textSection as $line) {
            $out[] = $line;
        }

        $out[] = '';
        $out[] = '_start:';
        $out[] = '    bl main';
        $out[] = '    mov x0, #0';
        $out[] = '    mov x8, #93';
        $out[] = '    svc #0';

        return implode("\n", $out) . "\n";
    }

    // ══════════════════════════════════════════════════════════════════════
    //  RUNTIME EMBEBIDO
    // ══════════════════════════════════════════════════════════════════════

    private function buildRuntime(): array
    {
        $r = [];

        // ── print_int ─────────────────────────────────────────────────────
        $r[] = 'print_int:';
        $r[] = '    stp x29, x30, [sp, #-48]!';
        $r[] = '    mov x29, sp';
        $r[] = '    str x19, [sp, #16]';
        $r[] = '    str x20, [sp, #24]';
        $r[] = '    str x21, [sp, #32]';
        $r[] = '    mov x19, x0';
        $r[] = '    cmp x19, #0';
        $r[] = '    b.ge _pi_positive';
        $r[] = '    adrp x0, _int_buf';
        $r[] = '    add x0, x0, :lo12:_int_buf';
        $r[] = '    mov w1, #45';
        $r[] = '    strb w1, [x0]';
        $r[] = '    mov x1, x0';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    neg x19, x19';
        $r[] = '_pi_positive:';
        $r[] = '    adrp x20, _int_buf';
        $r[] = '    add x20, x20, :lo12:_int_buf';
        $r[] = '    mov x21, #0';
        $r[] = '    cmp x19, #0';
        $r[] = '    b.ne _pi_loop';
        $r[] = '    mov w1, #48';
        $r[] = '    strb w1, [x20]';
        $r[] = '    mov x1, x20';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    b _pi_newline';
        $r[] = '_pi_loop:';
        $r[] = '    cbz x19, _pi_reverse';
        $r[] = '    mov x0, x19';
        $r[] = '    mov x1, #10';
        $r[] = '    udiv x2, x0, x1';
        $r[] = '    msub x3, x2, x1, x0';
        $r[] = '    add w3, w3, #48';
        $r[] = '    strb w3, [x20, x21]';
        $r[] = '    add x21, x21, #1';
        $r[] = '    mov x19, x2';
        $r[] = '    b _pi_loop';
        $r[] = '_pi_reverse:';
        $r[] = '    mov x0, #0';
        $r[] = '    sub x1, x21, #1';
        $r[] = '_pi_rev_loop:';
        $r[] = '    cmp x0, x1';
        $r[] = '    b.ge _pi_print';
        $r[] = '    ldrb w2, [x20, x0]';
        $r[] = '    ldrb w3, [x20, x1]';
        $r[] = '    strb w3, [x20, x0]';
        $r[] = '    strb w2, [x20, x1]';
        $r[] = '    add x0, x0, #1';
        $r[] = '    sub x1, x1, #1';
        $r[] = '    b _pi_rev_loop';
        $r[] = '_pi_print:';
        $r[] = '    mov x1, x20';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, x21';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '_pi_newline:';
        $r[] = '    adrp x0, _newline';
        $r[] = '    add x0, x0, :lo12:_newline';
        $r[] = '    mov x1, x0';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    ldr x19, [sp, #16]';
        $r[] = '    ldr x20, [sp, #24]';
        $r[] = '    ldr x21, [sp, #32]';
        $r[] = '    ldp x29, x30, [sp], #48';
        $r[] = '    ret';
        $r[] = '';

        // ── print_bool ────────────────────────────────────────────────────
        $r[] = 'print_bool:';
        $r[] = '    stp x29, x30, [sp, #-16]!';
        $r[] = '    mov x29, sp';
        $r[] = '    cmp x0, #0';
        $r[] = '    b.eq _pb_false';
        $r[] = '    adrp x1, _true_str';
        $r[] = '    add x1, x1, :lo12:_true_str';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #4';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    b _pb_nl';
        $r[] = '_pb_false:';
        $r[] = '    adrp x1, _false_str';
        $r[] = '    add x1, x1, :lo12:_false_str';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #5';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '_pb_nl:';
        $r[] = '    adrp x1, _newline';
        $r[] = '    add x1, x1, :lo12:_newline';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '_pb_end:';
        $r[] = '    ldp x29, x30, [sp], #16';
        $r[] = '    ret';
        $r[] = '';

        // ── print_string ──────────────────────────────────────────────────
        $r[] = 'print_string:';
        $r[] = '    stp x29, x30, [sp, #-16]!';
        $r[] = '    mov x29, sp';
        $r[] = '    mov x1, x0';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #0';
        $r[] = '_ps_len_loop:';
        $r[] = '    ldrb w3, [x1, x2]';
        $r[] = '    cbz w3, _ps_print';
        $r[] = '    add x2, x2, #1';
        $r[] = '    b _ps_len_loop';
        $r[] = '_ps_print:';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    adrp x1, _newline';
        $r[] = '    add x1, x1, :lo12:_newline';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    ldp x29, x30, [sp], #16';
        $r[] = '    ret';
        $r[] = '';

        // ── print_rune ────────────────────────────────────────────────────
        $r[] = 'print_rune:';
        $r[] = '    stp x29, x30, [sp, #-32]!';
        $r[] = '    mov x29, sp';
        $r[] = '    str x19, [sp, #16]';
        $r[] = '    mov w19, w0';
        $r[] = '    and w19, w19, #0xFF';
        $r[] = '    cbz w19, _pr_skip_char';
        $r[] = '    strb w19, [sp, #24]';
        $r[] = '    mov x0, #1';
        $r[] = '    add x1, sp, #24';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '_pr_skip_char:';
        $r[] = '    adrp x1, _newline';
        $r[] = '    add x1, x1, :lo12:_newline';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    ldr x19, [sp, #16]';
        $r[] = '    ldp x29, x30, [sp], #32';
        $r[] = '    ret';
        $r[] = '';

        // ── print_space ───────────────────────────────────────────────────
        $r[] = 'print_space:';
        $r[] = '    stp x29, x30, [sp, #-16]!';
        $r[] = '    mov x29, sp';
        $r[] = '    adrp x1, _space_ch';
        $r[] = '    add x1, x1, :lo12:_space_ch';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    ldp x29, x30, [sp], #16';
        $r[] = '    ret';
        $r[] = '';

        // ── print_newline ─────────────────────────────────────────────────
        $r[] = 'print_newline:';
        $r[] = '    stp x29, x30, [sp, #-16]!';
        $r[] = '    mov x29, sp';
        $r[] = '    adrp x1, _newline';
        $r[] = '    add x1, x1, :lo12:_newline';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    ldp x29, x30, [sp], #16';
        $r[] = '    ret';
        $r[] = '';

        // ── print_int_inline ──────────────────────────────────────────────
        $r[] = 'print_int_inline:';
        $r[] = '    stp x29, x30, [sp, #-48]!';
        $r[] = '    mov x29, sp';
        $r[] = '    str x19, [sp, #16]';
        $r[] = '    str x20, [sp, #24]';
        $r[] = '    str x21, [sp, #32]';
        $r[] = '    mov x19, x0';
        $r[] = '    cmp x19, #0';
        $r[] = '    b.ge _pii_positive';
        $r[] = '    adrp x0, _int_buf';
        $r[] = '    add x0, x0, :lo12:_int_buf';
        $r[] = '    mov w1, #45';
        $r[] = '    strb w1, [x0]';
        $r[] = '    mov x1, x0';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    neg x19, x19';
        $r[] = '_pii_positive:';
        $r[] = '    adrp x20, _int_buf';
        $r[] = '    add x20, x20, :lo12:_int_buf';
        $r[] = '    mov x21, #0';
        $r[] = '    cmp x19, #0';
        $r[] = '    b.ne _pii_loop';
        $r[] = '    mov w1, #48';
        $r[] = '    strb w1, [x20]';
        $r[] = '    mov x1, x20';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    b _pii_done';
        $r[] = '_pii_loop:';
        $r[] = '    cbz x19, _pii_reverse';
        $r[] = '    mov x0, x19';
        $r[] = '    mov x1, #10';
        $r[] = '    udiv x2, x0, x1';
        $r[] = '    msub x3, x2, x1, x0';
        $r[] = '    add w3, w3, #48';
        $r[] = '    strb w3, [x20, x21]';
        $r[] = '    add x21, x21, #1';
        $r[] = '    mov x19, x2';
        $r[] = '    b _pii_loop';
        $r[] = '_pii_reverse:';
        $r[] = '    mov x0, #0';
        $r[] = '    sub x1, x21, #1';
        $r[] = '_pii_rev_loop:';
        $r[] = '    cmp x0, x1';
        $r[] = '    b.ge _pii_print';
        $r[] = '    ldrb w2, [x20, x0]';
        $r[] = '    ldrb w3, [x20, x1]';
        $r[] = '    strb w3, [x20, x0]';
        $r[] = '    strb w2, [x20, x1]';
        $r[] = '    add x0, x0, #1';
        $r[] = '    sub x1, x1, #1';
        $r[] = '    b _pii_rev_loop';
        $r[] = '_pii_print:';
        $r[] = '    mov x1, x20';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, x21';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '_pii_done:';
        $r[] = '    ldr x19, [sp, #16]';
        $r[] = '    ldr x20, [sp, #24]';
        $r[] = '    ldr x21, [sp, #32]';
        $r[] = '    ldp x29, x30, [sp], #48';
        $r[] = '    ret';
        $r[] = '';

        // ── print_bool_inline ─────────────────────────────────────────────
        $r[] = 'print_bool_inline:';
        $r[] = '    stp x29, x30, [sp, #-16]!';
        $r[] = '    mov x29, sp';
        $r[] = '    cmp x0, #0';
        $r[] = '    b.eq _pbi_false';
        $r[] = '    adrp x1, _true_str';
        $r[] = '    add x1, x1, :lo12:_true_str';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #4';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    b _pbi_end';
        $r[] = '_pbi_false:';
        $r[] = '    adrp x1, _false_str';
        $r[] = '    add x1, x1, :lo12:_false_str';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #5';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '_pbi_end:';
        $r[] = '    ldp x29, x30, [sp], #16';
        $r[] = '    ret';
        $r[] = '';

        // ── print_rune_inline ─────────────────────────────────────────────
        $r[] = 'print_rune_inline:';
        $r[] = '    stp x29, x30, [sp, #-32]!';
        $r[] = '    mov x29, sp';
        $r[] = '    str x19, [sp, #16]';
        $r[] = '    mov w19, w0';
        $r[] = '    and w19, w19, #0xFF';
        $r[] = '    cbz w19, _pri_skip_char';
        $r[] = '    strb w19, [sp, #24]';
        $r[] = '    mov x0, #1';
        $r[] = '    add x1, sp, #24';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '_pri_skip_char:';
        $r[] = '    ldr x19, [sp, #16]';
        $r[] = '    ldp x29, x30, [sp], #32';
        $r[] = '    ret';
        $r[] = '';

        // ── print_string_inline ───────────────────────────────────────────
        $r[] = 'print_string_inline:';
        $r[] = '    stp x29, x30, [sp, #-16]!';
        $r[] = '    mov x29, sp';
        $r[] = '    mov x1, x0';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x2, #0';
        $r[] = '_psi_len_loop:';
        $r[] = '    ldrb w3, [x1, x2]';
        $r[] = '    cbz w3, _psi_print';
        $r[] = '    add x2, x2, #1';
        $r[] = '    b _psi_len_loop';
        $r[] = '_psi_print:';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    ldp x29, x30, [sp], #16';
        $r[] = '    ret';
        $r[] = '';

        // ── print_float ───────────────────────────────────────────────────
        // Convención: x0 = valor * 1000 (entero escalado)
        $r[] = 'print_float:';
        $r[] = '    stp x29, x30, [sp, #-64]!';
        $r[] = '    mov x29, sp';
        $r[] = '    str x19, [sp, #16]';
        $r[] = '    str x20, [sp, #24]';
        $r[] = '    str x21, [sp, #32]';
        $r[] = '    mov x19, x0';
        $r[] = '    cmp x19, #0';
        $r[] = '    b.ge _pf_positive';
        $r[] = '    mov x9, #45';
        $r[] = '    str x9, [sp, #48]';
        $r[] = '    mov x0, #1';
        $r[] = '    add x1, sp, #48';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    neg x19, x19';
        $r[] = '_pf_positive:';
        $r[] = '    mov x1, #1000';
        $r[] = '    udiv x20, x19, x1';
        $r[] = '    msub x21, x20, x1, x19';
        $r[] = '    mov x0, x20';
        $r[] = '    bl   print_int_inline';
        $r[] = '    mov x9, #46';
        $r[] = '    str x9, [sp, #48]';
        $r[] = '    mov x0, #1';
        $r[] = '    add x1, sp, #48';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    mov x0, x21';
        $r[] = '    bl   _pf_print_decimal';
        $r[] = '    mov x9, #10';
        $r[] = '    str x9, [sp, #48]';
        $r[] = '    mov x0, #1';
        $r[] = '    add x1, sp, #48';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    ldr x19, [sp, #16]';
        $r[] = '    ldr x20, [sp, #24]';
        $r[] = '    ldr x21, [sp, #32]';
        $r[] = '    ldp x29, x30, [sp], #64';
        $r[] = '    ret';
        $r[] = '';

        $r[] = '_pf_print_decimal:';
        $r[] = '    stp x29, x30, [sp, #-64]!';
        $r[] = '    mov x29, sp';
        $r[] = '    str x19, [sp, #16]';
        $r[] = '    str x20, [sp, #24]';
        $r[] = '    str x21, [sp, #32]';
        $r[] = '    mov x19, x0';
        $r[] = '    mov x1, #100';
        $r[] = '    udiv x20, x19, x1';
        $r[] = '    msub x21, x20, x1, x19';
        $r[] = '    mov x1, #10';
        $r[] = '    udiv x9, x21, x1';
        $r[] = '    msub x10, x9, x1, x21';
        $r[] = '    add x1, sp, #48';
        $r[] = '    add w2, w20, #48';
        $r[] = '    strb w2, [x1]';
        $r[] = '    add w3, w9, #48';
        $r[] = '    strb w3, [x1, #1]';
        $r[] = '    add w4, w10, #48';
        $r[] = '    strb w4, [x1, #2]';
        $r[] = '    mov x2, #1';
        $r[] = '    cbnz x9, _pfd_has2';
        $r[] = '    cbnz x10, _pfd_has2';
        $r[] = '    b    _pfd_print';
        $r[] = '_pfd_has2:';
        $r[] = '    mov x2, #2';
        $r[] = '    cbz x10, _pfd_print';
        $r[] = '    mov x2, #3';
        $r[] = '_pfd_print:';
        $r[] = '    mov x0, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    ldr x19, [sp, #16]';
        $r[] = '    ldr x20, [sp, #24]';
        $r[] = '    ldr x21, [sp, #32]';
        $r[] = '    ldp x29, x30, [sp], #64';
        $r[] = '    ret';
        $r[] = '';

        // ── print_float_inline ────────────────────────────────────────────
        $r[] = 'print_float_inline:';
        $r[] = '    stp x29, x30, [sp, #-64]!';
        $r[] = '    mov x29, sp';
        $r[] = '    str x19, [sp, #16]';
        $r[] = '    str x20, [sp, #24]';
        $r[] = '    str x21, [sp, #32]';
        $r[] = '    mov x19, x0';
        $r[] = '    cmp x19, #0';
        $r[] = '    b.ge _pfi_positive';
        $r[] = '    mov x9, #45';
        $r[] = '    str x9, [sp, #48]';
        $r[] = '    mov x0, #1';
        $r[] = '    add x1, sp, #48';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    neg x19, x19';
        $r[] = '_pfi_positive:';
        $r[] = '    mov x1, #1000';
        $r[] = '    udiv x20, x19, x1';
        $r[] = '    msub x21, x20, x1, x19';
        $r[] = '    mov x0, x20';
        $r[] = '    bl   print_int_inline';
        $r[] = '    mov x9, #46';
        $r[] = '    str x9, [sp, #48]';
        $r[] = '    mov x0, #1';
        $r[] = '    add x1, sp, #48';
        $r[] = '    mov x2, #1';
        $r[] = '    mov x8, #64';
        $r[] = '    svc #0';
        $r[] = '    mov x0, x21';
        $r[] = '    bl   _pf_print_decimal';
        $r[] = '    ldr x19, [sp, #16]';
        $r[] = '    ldr x20, [sp, #24]';
        $r[] = '    ldr x21, [sp, #32]';
        $r[] = '    ldp x29, x30, [sp], #64';
        $r[] = '    ret';
        $r[] = '';

        return $r;
    }

    // ══════════════════════════════════════════════════════════════════════
    //  UTILIDADES INTERNAS
    // ══════════════════════════════════════════════════════════════════════

    private function emit(string $line): void
    {
        $line = rtrim($line);
        // Eliminar comentarios descriptivos pegados (no toca inmediatos como #0, #-8)
        $line = preg_replace('/\s{2,}#(?![0-9\-]).*$/', '', $line);
        $this->currentFuncCode[] = $line;
    }

    private function emitLabel(string $label): void
    {
        $this->currentFuncCode[] = $label . ':';
    }

    private function newLabel(string $prefix = 'L'): string
    {
        return $prefix . '_' . (++$this->labelCount);
    }

    private function newStrLabel(): string
    {
        return '_str_' . (++$this->strCount);
    }

    // ──────────────────────────────────────────────────────────────────────
    //  CARGA / ALMACENAMIENTO DE VARIABLES
    // ──────────────────────────────────────────────────────────────────────

    private function emitLoadVar(string $reg, ArmSymbol $sym): void
    {
        if ($sym->scope === 'global') {
            $this->emit("    adrp {$reg}, {$sym->name}");
            $this->emit("    add  {$reg}, {$reg}, :lo12:{$sym->name}");
            $this->emit("    ldr  {$reg}, [{$reg}]");
        } else {
            $this->emit("    ldr  {$reg}, [x29, #{$sym->offset}]");
        }
    }

    private function emitStoreVar(string $reg, ArmSymbol $sym): void
    {
        if ($sym->scope === 'global') {
            $tmp = ($reg === 'x10') ? 'x11' : 'x10';
            $this->emit("    adrp {$tmp}, {$sym->name}");
            $this->emit("    add  {$tmp}, {$tmp}, :lo12:{$sym->name}");
            $this->emit("    str  {$reg}, [{$tmp}]");
        } else {
            $this->emit("    str  {$reg}, [x29, #{$sym->offset}]");
        }
    }

    // ──────────────────────────────────────────────────────────────────────
    //  CARGA DE INMEDIATOS GRANDES (>16 bits)
    // ──────────────────────────────────────────────────────────────────────

    private function emitMovImm(string $reg, int $val): void
    {
        if ($val >= 0 && $val <= 65535) {
            $this->emit("    mov  {$reg}, #{$val}");
        } elseif ($val < 0 && $val >= -65536) {
            $this->emit("    mov  {$reg}, #{$val}");
        } else {
            $lo = $val & 0xFFFF;
            $hi = ($val >> 16) & 0xFFFF;
            $this->emit("    movz {$reg}, #{$lo}");
            if ($hi > 0) {
                $this->emit("    movk {$reg}, #{$hi}, lsl #16");
            }
        }
    }

    // ══════════════════════════════════════════════════════════════════════
    //  VISITOR: PROGRAMA
    // ══════════════════════════════════════════════════════════════════════

    public function visitProgram(ProgramContext $ctx): mixed
    {
        foreach ($ctx->functionDecl() as $funcCtx) {
            $this->registerFunctionSignature($funcCtx);
        }
        foreach ($ctx->functionDecl() as $funcCtx) {
            $this->visitFunctionDecl($funcCtx);
        }
        return null;
    }

    private function registerFunctionSignature(FunctionDeclContext $ctx): void
    {
        $name        = $ctx->IDENTIFIER()->getText();
        $paramTypes  = [];
        $returnTypes = [];

        if ($ctx->params() !== null) {
            foreach ($ctx->params()->param() as $p) {
                $paramTypes[] = $this->resolveTypeName($p->type());
            }
        }
        if ($ctx->returnTypes() !== null) {
            foreach ($ctx->returnTypes()->type() as $rt) {
                $returnTypes[] = $this->resolveTypeName($rt);
            }
        }

        $line = $ctx->IDENTIFIER()->getSymbol()->getLine();
        $col  = $ctx->IDENTIFIER()->getSymbol()->getCharPositionInLine();
        $sym  = $this->symTable->declareFunction($name, $paramTypes, $returnTypes, $line, $col);
        $this->declaredFunctions[$name] = $sym;
        $this->symReport->addSymbol($name, 'función', 'global', '—', $line, $col + 1);
    }

    // ══════════════════════════════════════════════════════════════════════
    //  VISITOR: FUNCIÓN — PRÓLOGO DIFERIDO
    // ══════════════════════════════════════════════════════════════════════

    public function visitFunctionDecl(FunctionDeclContext $ctx): mixed
    {
        $name = $ctx->IDENTIFIER()->getText();
        $this->currentFunc     = $name;
        $this->currentFuncCode = [];

        // ── Inicializar FrameManager y tabla de símbolos ──────────────────
        $this->frame->enter($name);
        $this->symTable->enterFunction($name);

        // Reservar scratch slot para preservar x19 durante bl en emitPrintln
        // (el primer slot después de x29/x30 = offset 16)
        $this->scratchOffset = $this->frame->reserveSlot(8);  // offset 16

        // ── Etiqueta de función ───────────────────────────────────────────
        $this->emitLabel($name);

        // Placeholder para el prólogo — se rellena al final
        $prologuePlaceholder = "__PROLOGUE_{$name}__";
        $epiloguePlaceholder = "__EPILOGUE_{$name}__";

        $this->emit($prologuePlaceholder);
        $this->emit("    mov x29, sp");

        // ── Parámetros ────────────────────────────────────────────────────
        $params = [];
        if ($ctx->params() !== null) {
            foreach ($ctx->params()->param() as $i => $p) {
                $pname = $p->IDENTIFIER()->getText();
                $ptype = $this->resolveTypeName($p->type());
                $params[] = ['name' => $pname, 'type' => $ptype, 'reg' => 'x' . $i];
            }
        }

        foreach ($params as $i => $p) {
            $pCtx = $ctx->params()->param()[$i];
            $sym  = $this->symTable->declareLocal(
                $p['name'], $p['type'], 8,
                $pCtx->IDENTIFIER()->getSymbol()->getLine(),
                $pCtx->IDENTIFIER()->getSymbol()->getCharPositionInLine(),
                false, true
            );
            // Asignar offset vía FrameManager
            $this->frame->registerSymbol($sym, 8);
            $this->emit("    str  {$p['reg']}, [x29, #{$sym->offset}]");
            $this->symReport->addSymbol(
                $p['name'], $p['type'], $name, '—',
                $pCtx->IDENTIFIER()->getSymbol()->getLine(),
                $pCtx->IDENTIFIER()->getSymbol()->getCharPositionInLine() + 1
            );
        }

        // ── Cuerpo ────────────────────────────────────────────────────────
        $this->visitBlock($ctx->block());

        // ── Epílogo ───────────────────────────────────────────────────────
        $this->emitLabel("_ret_{$name}");
        $this->emit($epiloguePlaceholder);
        $this->emit("    ret");
        $this->emit("");

        $this->symTable->exitFunction();

        // ── Calcular frameSize real y reemplazar placeholders ─────────────
        $frameSize = $this->frame->leave();

        $code = implode("\n", $this->currentFuncCode);
        $code = str_replace(
            $prologuePlaceholder,
            "    stp x29, x30, [sp, #-{$frameSize}]!",
            $code
        );
        $code = str_replace(
            $epiloguePlaceholder,
            "    ldp x29, x30, [sp], #{$frameSize}",
            $code
        );

        foreach (explode("\n", $code) as $line) {
            $this->textSection[] = $line;
        }

        $this->currentFunc = '';
        return null;
    }

    // ══════════════════════════════════════════════════════════════════════
    //  VISITOR: BLOQUE Y SENTENCIAS
    // ══════════════════════════════════════════════════════════════════════

    public function visitBlock(BlockContext $ctx): mixed
    {
        foreach ($ctx->statement() as $stmt) {
            $this->visitStatement($stmt);
        }
        return null;
    }

    public function visitStatement(StatementContext $ctx): mixed
    {
        return $this->visitStatementCore($ctx->statementCore());
    }

    public function visitStatementCore(StatementCoreContext $ctx): mixed
    {
        if ($ctx->varDecl() !== null)       return $this->visitVarDecl($ctx->varDecl());
        if ($ctx->constDecl() !== null)     return $this->visitConstDecl($ctx->constDecl());
        if ($ctx->shortVarDecl() !== null)  return $this->visitShortVarDecl($ctx->shortVarDecl());
        if ($ctx->assignment() !== null)    return $this->visitAssignment($ctx->assignment());
        if ($ctx->incDecStmt() !== null)    return $this->visitIncDecStmt($ctx->incDecStmt());
        if ($ctx->ifStmt() !== null)        return $this->visitIfStmt($ctx->ifStmt());
        if ($ctx->switchStmt() !== null)    return $this->visitSwitchStmt($ctx->switchStmt());
        if ($ctx->forStmt() !== null)       return $this->visitForStmt($ctx->forStmt());
        if ($ctx->breakStmt() !== null)     return $this->visitBreakStmt($ctx->breakStmt());
        if ($ctx->continueStmt() !== null)  return $this->visitContinueStmt($ctx->continueStmt());
        if ($ctx->returnStmt() !== null)    return $this->visitReturnStmt($ctx->returnStmt());
        if ($ctx->functionCall() !== null)  return $this->visitFunctionCallStmt($ctx->functionCall());
        if ($ctx->expression() !== null)    return $this->visitExpression($ctx->expression());
        return null;
    }

    // ══════════════════════════════════════════════════════════════════════
    //  VISITOR: DECLARACIONES DE VARIABLES
    // ══════════════════════════════════════════════════════════════════════

    public function visitVarDecl(VarDeclContext $ctx): mixed
    {
        $line = $ctx->VAR()->getSymbol()->getLine();
        $col  = $ctx->VAR()->getSymbol()->getCharPositionInLine();

        if ($ctx->arrayType() !== null) {
            return $this->declareArrayVar($ctx, $line, $col);
        }

        $idList = $ctx->idList()->IDENTIFIER();
        $type   = $this->resolveTypeName($ctx->type());
        $exprs  = $ctx->expList() !== null ? $ctx->expList()->expression() : [];

        foreach ($idList as $i => $idToken) {
            $varName = $idToken->getText();
            if ($this->symTable->existsInCurrentScope($varName)) {
                $this->errorReport->addError(
                    'Semántico', "Identificador '{$varName}' ya declarado en este ámbito",
                    $idToken->getSymbol()->getLine(),
                    $idToken->getSymbol()->getCharPositionInLine()
                );
                continue;
            }

            $sym = $this->symTable->declareLocal(
                $varName, $type, 8,
                $idToken->getSymbol()->getLine(),
                $idToken->getSymbol()->getCharPositionInLine()
            );
            // Asignar offset real vía FrameManager
            $this->frame->registerSymbol($sym, 8);

            if (isset($exprs[$i])) {
                $val = $this->visitExpressionTyped($exprs[$i], 'x9');
                $this->emitStoreVar($val->reg, $sym);
                $this->symReport->addSymbol($varName, $type, $this->currentFunc, '(expr)', $sym->line, $sym->column + 1);
            } else {
                $this->emitDefaultValue($type, 'x9');
                $this->emitStoreVar('x9', $sym);
                $this->symReport->addSymbol($varName, $type, $this->currentFunc, '(default)', $sym->line, $sym->column + 1);
            }
        }
        return null;
    }

    /**
     * Emite el valor por defecto de un tipo en $reg.
     */
    private function emitDefaultValue(string $type, string $reg): void
    {
        if ($type === 'string') {
            $lbl = $this->newStrLabel();
            $this->dataSection[] = "{$lbl}: .byte 0";
            $this->emit("    adrp {$reg}, {$lbl}");
            $this->emit("    add  {$reg}, {$reg}, :lo12:{$lbl}");
        } else {
            $this->emit("    mov  {$reg}, #0");
        }
    }

    private function declareArrayVar(VarDeclContext $ctx, int $line, int $col): mixed
    {
        $name         = $ctx->IDENTIFIER()->getText();
        $arrayTypeCtx = $ctx->arrayType();
        $dims         = [];
        foreach ($arrayTypeCtx->arrayDimension() as $d) {
            $dims[] = (int)$d->INT_LITERAL()->getText();
        }
        $baseType   = $arrayTypeCtx->baseType()->getText();
        $totalElems = array_product($dims);
        $totalSize  = $totalElems * 8;

        // Reservar espacio en el frame para el arreglo completo
        $offset = $this->frame->allocate($totalSize);
        $sym    = $this->symTable->declareLocal($name, 'array', $totalSize, $line, $col);
        $sym->offset     = $offset;
        $sym->dimensions = $dims;
        $sym->baseType   = ArmSymbolTable::normalizeType($baseType);

        // Inicializar a cero
        for ($i = 0; $i < $totalElems; $i++) {
            $elemOff = $offset + $i * 8;
            $this->emit("    mov  x9, #0");
            $this->emit("    str  x9, [x29, #{$elemOff}]");
        }

        if ($ctx->arrayLiteral() !== null) {
            $this->initArrayFromLiteral($ctx->arrayLiteral(), $sym, $dims);
        }

        $this->symReport->addSymbol($name, "array[{$baseType}]", $this->currentFunc, '(array)', $line, $col + 1);
        return null;
    }

    /**
     * Declara un arreglo a partir de un literal en el lado derecho de :=
     * Ej: arrLen := [4]int32{1, 2, 3, 4}
     */
    private function declareArrayVarFromLiteral(string $name, ArrayLiteralContext $litCtx, int $line, int $col): void
    {
        if ($this->symTable->existsInCurrentScope($name)) {
            // Si ya existe, reasignar desde literal (infrecuente pero posible)
            $sym = $this->symTable->lookup($name);
            if ($sym !== null && $litCtx->arrayElements() !== null) {
                $this->initArrayFromLiteral($litCtx, $sym, $sym->dimensions);
            }
            return;
        }

        // Extraer dimensiones y tipo base del arrayLiteral
        $arrayTypeCtx = $litCtx->arrayType();
        $dims         = [];
        foreach ($arrayTypeCtx->arrayDimension() as $d) {
            $dims[] = (int)$d->INT_LITERAL()->getText();
        }
        $baseType   = $arrayTypeCtx->baseType()->getText();
        $totalElems = array_product($dims);
        $totalSize  = $totalElems * 8;

        $offset = $this->frame->allocate($totalSize);
        $sym    = $this->symTable->declareLocal($name, 'array', $totalSize, $line, $col);
        $sym->offset     = $offset;
        $sym->dimensions = $dims;
        $sym->baseType   = ArmSymbolTable::normalizeType($baseType);

        // Inicializar a cero
        for ($i = 0; $i < $totalElems; $i++) {
            $elemOff = $offset + $i * 8;
            $this->emit("    mov  x9, #0");
            $this->emit("    str  x9, [x29, #{$elemOff}]");
        }

        // Inicializar con valores del literal
        if ($litCtx->arrayElements() !== null) {
            $this->initArrayFromLiteral($litCtx, $sym, $dims);
        }

        $this->symReport->addSymbol($name, "array[{$baseType}]", $this->currentFunc, '(array)', $line, $col + 1);
    }


    private function initArrayFromLiteral(ArrayLiteralContext $litCtx, ArmSymbol $sym, array $dims): void
    {
        if ($litCtx->arrayElements() === null) return;
        $elements = $litCtx->arrayElements()->arrayElement();
        $this->initArrayElements($elements, $sym, 0, $dims, 0);
    }

    private function initArrayElements(array $elements, ArmSymbol $sym, int $baseOffset, array $dims, int $depth): void
    {
        $stride = 1;
        for ($d = $depth + 1; $d < count($dims); $d++) {
            $stride *= $dims[$d];
        }
        foreach ($elements as $i => $elem) {
            if ($elem->expression() !== null) {
                $elemOff = $sym->offset + ($baseOffset + $i) * 8;
                $val     = $this->visitExpressionTyped($elem->expression(), 'x9');
                $this->emit("    str  {$val->reg}, [x29, #{$elemOff}]");
            } elseif ($elem->arrayElements() !== null) {
                $sub = $elem->arrayElements()->arrayElement();
                $this->initArrayElements($sub, $sym, $baseOffset + $i * $stride, $dims, $depth + 1);
            }
        }
    }

    public function visitConstDecl(ConstDeclContext $ctx): mixed
    {
        $name = $ctx->IDENTIFIER()->getText();
        $type = $this->resolveTypeName($ctx->type());
        $line = $ctx->IDENTIFIER()->getSymbol()->getLine();
        $col  = $ctx->IDENTIFIER()->getSymbol()->getCharPositionInLine();

        if ($this->symTable->existsInCurrentScope($name)) {
            $this->errorReport->addError('Semántico', "Constante '{$name}' ya declarada", $line, $col);
            return null;
        }

        $sym = $this->symTable->declareLocal($name, $type, 8, $line, $col, true);
        $this->frame->registerSymbol($sym, 8);
        $val = $this->visitExpressionTyped($ctx->expression(), 'x9');
        $this->emitStoreVar($val->reg, $sym);
        $this->symReport->addSymbol($name, $type, $this->currentFunc, '(const)', $line, $col + 1);
        return null;
    }

    public function visitShortVarDecl(ShortVarDeclContext $ctx): mixed
    {
        return $this->processShortVarDecl($ctx->idList(), $ctx->expList());
    }

    private function processShortVarDecl(IdListContext $idListCtx, ExpListContext $expListCtx): mixed
    {
        $ids   = $idListCtx->IDENTIFIER();
        $exprs = $expListCtx->expression();

        // Caso especial: múltiple retorno desde una única llamada a función
        // Ej: mcd, pasos := euclides(48, 18)
        // En este caso hay 2 ids pero 1 expr que es una llamada a función.
        // El ABI AAPCS64 devuelve los valores en x0, x1.
        if (count($ids) > 1 && count($exprs) === 1) {
            $singleExpr = $exprs[0];
            // Comprobar si la única expresión es una llamada a función
            $primary = $singleExpr->logicalOrExp()
                ->logicalAndExp(0)->equalityExp(0)->relationalExp(0)
                ->additiveExp(0)->multiplicativeExp(0)->unaryExp(0)->primary();
            if ($primary !== null && $primary->functionCall() !== null) {
                // Emitir la llamada (resultado en x0, x1, ...)
                $this->visitFunctionCallExpr($primary->functionCall(), 'x0');
                // Ahora guardar x0 → ids[0], x1 → ids[1], ...
                // Inferir tipos de retorno desde la firma de la función
                $funcName = $primary->functionCall()->functionName()->getText();
                $retTypes = [];
                if (isset($this->declaredFunctions[$funcName])) {
                    $retTypes = $this->declaredFunctions[$funcName]->returnTypes ?? [];
                }
                foreach ($ids as $i => $idToken) {
                    $varName = $idToken->getText();
                    $line    = $idToken->getSymbol()->getLine();
                    $col     = $idToken->getSymbol()->getCharPositionInLine();
                    $retType = $retTypes[$i] ?? 'int32';
                    $retReg  = 'x' . $i;

                    if (!$this->symTable->existsInCurrentScope($varName)) {
                        $sym = $this->symTable->declareLocal($varName, $retType, 8, $line, $col);
                        $this->frame->registerSymbol($sym, 8);
                        $this->emit("    str  {$retReg}, [x29, #{$sym->offset}]");
                        $this->symReport->addSymbol($varName, $retType, $this->currentFunc, '(expr)', $line, $col + 1);
                    } else {
                        $sym = $this->symTable->lookup($varName);
                        if ($sym !== null) {
                            $this->emit("    str  {$retReg}, [x29, #{$sym->offset}]");
                        }
                    }
                }
                return null;
            }
        }

        // Caso normal: una expresión por identificador
        foreach ($ids as $i => $idToken) {
            $varName = $idToken->getText();
            $line    = $idToken->getSymbol()->getLine();
            $col     = $idToken->getSymbol()->getCharPositionInLine();

            if (isset($exprs[$i])) {
                // Verificar si es un literal de arreglo (array literal en RHS de :=)
                $exprPrimary = $exprs[$i]->logicalOrExp()
                    ->logicalAndExp(0)->equalityExp(0)->relationalExp(0)
                    ->additiveExp(0)->multiplicativeExp(0)->unaryExp(0)->primary();

                if ($exprPrimary !== null && $exprPrimary->arrayLiteral() !== null) {
                    // Procesar como declaración de arreglo
                    $this->declareArrayVarFromLiteral(
                        $varName, $exprPrimary->arrayLiteral(), $line, $col
                    );
                    continue;
                }

                $val  = $this->visitExpressionTyped($exprs[$i], 'x9');
                $type = $val->type;
                $reg  = $val->reg;
            } else {
                $type = 'int32';
                $reg  = 'x9';
                $this->emit("    mov  x9, #0");
            }

            if (!$this->symTable->existsInCurrentScope($varName)) {
                $sym = $this->symTable->declareLocal($varName, $type, 8, $line, $col);
                $this->frame->registerSymbol($sym, 8);
                $this->emitStoreVar($reg, $sym);
                $this->symReport->addSymbol($varName, $type, $this->currentFunc, '(expr)', $line, $col + 1);
            } else {
                $sym = $this->symTable->lookup($varName);
                if ($sym !== null) {
                    $this->emitStoreVar($reg, $sym);
                }
            }
        }
        return null;
    }

    // ══════════════════════════════════════════════════════════════════════
    //  VISITOR: ASIGNACIÓN
    // ══════════════════════════════════════════════════════════════════════

    public function visitAssignment(AssignmentContext $ctx): mixed
    {
        $op     = $ctx->assignOp()->getText();
        $exprs  = $ctx->expList()->expression();
        $target = $ctx->assignTarget();

        if ($target->idList() !== null) {
            foreach ($target->idList()->IDENTIFIER() as $i => $idToken) {
                $varName = $idToken->getText();
                $sym     = $this->symTable->lookup($varName);
                if ($sym === null) {
                    $this->errorReport->addError('Semántico', "Variable '{$varName}' no declarada",
                        $idToken->getSymbol()->getLine(), $idToken->getSymbol()->getCharPositionInLine());
                    continue;
                }
                $val = isset($exprs[$i]) ? $this->visitExpressionTyped($exprs[$i], 'x9') : new ValResult('x9', 'int32');
                $this->emitAssignOp($op, $sym, $val->reg);
            }
            return null;
        }
        if ($target->arrayAccess() !== null) {
            return $this->assignToArray($target->arrayAccess(), $exprs[0] ?? null, $op);
        }
        if ($target->pointerAccess() !== null) {
            return $this->assignToPointer($target->pointerAccess(), $exprs[0] ?? null);
        }
        return null;
    }

    private function emitAssignOp(string $op, ArmSymbol $sym, string $rhs): void
    {
        if ($op === '=') {
            $this->emitStoreVar($rhs, $sym);
            return;
        }
        $this->emitLoadVar('x10', $sym);
        switch ($op) {
            case '+=': $this->emit("    add  x9, x10, {$rhs}"); break;
            case '-=': $this->emit("    sub  x9, x10, {$rhs}"); break;
            case '*=': $this->emit("    mul  x9, x10, {$rhs}"); break;
            case '/=': $this->emit("    sdiv x9, x10, {$rhs}"); break;
        }
        $this->emitStoreVar('x9', $sym);
    }

    private function assignToArray(ArrayAccessContext $arrCtx, ?ExpressionContext $valCtx, string $op): mixed
    {
        $name = $arrCtx->IDENTIFIER()->getText();
        $sym  = $this->symTable->lookup($name);
        if ($sym === null) {
            $this->errorReport->addError('Semántico', "Arreglo '{$name}' no declarado",
                $arrCtx->IDENTIFIER()->getSymbol()->getLine(),
                $arrCtx->IDENTIFIER()->getSymbol()->getCharPositionInLine());
            return null;
        }
        $this->computeArrayOffset($sym, $arrCtx->arrayIndex(), 'x11');
        $val = $valCtx ? $this->visitExpressionTyped($valCtx, 'x9') : new ValResult('x9', 'int32');
        $this->emit("    str  {$val->reg}, [x11]");
        return null;
    }

    private function assignToPointer(PointerAccessContext $ptrCtx, ?ExpressionContext $valCtx): mixed
    {
        // Contar cuántos * hay
        $stars   = count($ptrCtx->MULT());
        $varName = $ptrCtx->IDENTIFIER()->getText();
        $sym     = $this->symTable->lookup($varName);
        if ($sym === null) {
            $this->errorReport->addError('Semántico', "Variable '{$varName}' no declarada",
                $ptrCtx->IDENTIFIER()->getSymbol()->getLine(),
                $ptrCtx->IDENTIFIER()->getSymbol()->getCharPositionInLine());
            return null;
        }
        // Evaluar valor a asignar
        $val = $valCtx ? $this->visitExpressionTyped($valCtx, 'x9') : new ValResult('x9', 'int32');
        if ($val->reg !== 'x9') $this->emit("    mov  x9, {$val->reg}");

        // Cargar la dirección apuntada (el puntero almacenado en sym)
        $this->emitLoadVar('x10', $sym);
        // Si hay más de un *, desreferenciar los niveles extras
        for ($s = 1; $s < $stars; $s++) {
            $this->emit("    ldr  x10, [x10]");
        }
        $this->emit("    str  x9, [x10]");
        return null;
    }

    // ══════════════════════════════════════════════════════════════════════
    //  VISITOR: INC/DEC
    // ══════════════════════════════════════════════════════════════════════

    public function visitIncDecStmt(IncDecStmtContext $ctx): mixed
    {
        $name = $ctx->IDENTIFIER()->getText();
        $sym  = $this->symTable->lookup($name);
        if ($sym === null) {
            $this->errorReport->addError('Semántico', "Variable '{$name}' no declarada",
                $ctx->IDENTIFIER()->getSymbol()->getLine(),
                $ctx->IDENTIFIER()->getSymbol()->getCharPositionInLine());
            return null;
        }
        $this->emitLoadVar('x9', $sym);
        if ($ctx->INC() !== null) {
            $this->emit("    add  x9, x9, #1");
        } else {
            $this->emit("    sub  x9, x9, #1");
        }
        $this->emitStoreVar('x9', $sym);
        return null;
    }

    // ══════════════════════════════════════════════════════════════════════
    //  VISITOR: IF
    // ══════════════════════════════════════════════════════════════════════

    public function visitIfStmt(IfStmtContext $ctx): mixed
    {
        $labelElse = $this->newLabel('else');
        $labelEnd  = $this->newLabel('end_if');

        if ($ctx->simpleStmt() !== null) {
            $this->visitSimpleStmt($ctx->simpleStmt());
        }

        $condVal = $this->visitExpressionTyped($ctx->expression(), 'x9');
        $this->emit("    cmp  {$condVal->reg}, #0");

        $blocks  = $ctx->block();
        $this->emit("    b.eq {$labelElse}");
        $this->visitBlock($blocks[0]);
        $this->emit("    b    {$labelEnd}");

        $this->emitLabel($labelElse);
        if (isset($blocks[1])) {
            $this->visitBlock($blocks[1]);
        } elseif ($ctx->ifStmt() !== null) {
            $this->visitIfStmt($ctx->ifStmt());
        }

        $this->emitLabel($labelEnd);
        return null;
    }

    // ══════════════════════════════════════════════════════════════════════
    //  VISITOR: SWITCH
    // ══════════════════════════════════════════════════════════════════════

    public function visitSwitchStmt(SwitchStmtContext $ctx): mixed
    {
        $labelEnd = $this->newLabel('end_sw');
        $this->breakStack[] = $labelEnd;

        // Guardamos el valor del switch en x19 (callee-saved).
        // Para esto, necesitamos preservar el x19 del llamador en el scratch slot.
        $scratch = $this->scratchOffset;
        $this->emit("    str  x19, [x29, #{$scratch}]");

        $switchVal = $this->visitExpressionTyped($ctx->expression(), 'x9');
        if ($switchVal->reg !== 'x9') {
            $this->emit("    mov  x9, {$switchVal->reg}");
        }
        $this->emit("    mov  x19, x9");

        $cases       = $ctx->caseClause();
        $caseLabels  = [];
        foreach ($cases as $case) {
            $caseLabels[] = $this->newLabel('case');
        }
        $labelDefault = $this->newLabel('default');

        foreach ($cases as $i => $case) {
            foreach ($case->expList()->expression() as $caseExpr) {
                $caseVal = $this->visitExpressionTyped($caseExpr, 'x9');
                $this->emit("    cmp  x19, {$caseVal->reg}");
                $this->emit("    b.eq {$caseLabels[$i]}");
            }
        }

        if ($ctx->defaultClause() !== null) {
            $this->emit("    b    {$labelDefault}");
        } else {
            $this->emit("    b    {$labelEnd}");
        }

        foreach ($cases as $i => $case) {
            $this->emitLabel($caseLabels[$i]);
            foreach ($case->statement() as $stmt) {
                $this->visitStatement($stmt);
            }
            $this->emit("    b    {$labelEnd}");
        }

        if ($ctx->defaultClause() !== null) {
            $this->emitLabel($labelDefault);
            foreach ($ctx->defaultClause()->statement() as $stmt) {
                $this->visitStatement($stmt);
            }
        }

        $this->emitLabel($labelEnd);
        $this->emit("    ldr  x19, [x29, #{$scratch}]");
        array_pop($this->breakStack);
        return null;
    }

    // ══════════════════════════════════════════════════════════════════════
    //  VISITOR: FOR
    // ══════════════════════════════════════════════════════════════════════

    public function visitForStmt(ForStmtContext $ctx): mixed
    {
        $labelStart = $this->newLabel('for_start');
        $labelEnd   = $this->newLabel('for_end');
        $labelCont  = $this->newLabel('for_cont');

        $this->breakStack[]    = $labelEnd;
        $this->continueStack[] = $labelCont;

        if ($ctx->forClause() !== null) {
            $clause = $ctx->forClause();
            $this->visitSimpleStmt($clause->simpleStmt(0));
            $this->emitLabel($labelStart);
            $condVal = $this->visitExpressionTyped($clause->expression(), 'x9');
            $this->emit("    cmp  {$condVal->reg}, #0");
            $this->emit("    b.eq {$labelEnd}");
            $this->visitBlock($ctx->block());
            $this->emitLabel($labelCont);
            $this->visitSimpleStmt($clause->simpleStmt(1));
            $this->emit("    b    {$labelStart}");
        } elseif ($ctx->expression() !== null) {
            $this->emitLabel($labelStart);
            $condVal = $this->visitExpressionTyped($ctx->expression(), 'x9');
            $this->emit("    cmp  {$condVal->reg}, #0");
            $this->emit("    b.eq {$labelEnd}");
            $this->visitBlock($ctx->block());
            $this->emitLabel($labelCont);
            $this->emit("    b    {$labelStart}");
        } else {
            // for infinito
            $this->emitLabel($labelStart);
            $this->visitBlock($ctx->block());
            $this->emitLabel($labelCont);
            $this->emit("    b    {$labelStart}");
        }

        $this->emitLabel($labelEnd);
        array_pop($this->breakStack);
        array_pop($this->continueStack);
        return null;
    }

    // ══════════════════════════════════════════════════════════════════════
    //  VISITOR: SIMPLE STATEMENTS (para for/if init)
    // ══════════════════════════════════════════════════════════════════════

    public function visitSimpleStmt(SimpleStmtContext $ctx): mixed
    {
        if ($ctx->shortVarDeclNoSemi() !== null) {
            return $this->processShortVarDecl(
                $ctx->shortVarDeclNoSemi()->idList(),
                $ctx->shortVarDeclNoSemi()->expList()
            );
        }
        if ($ctx->assignmentNoSemi() !== null) {
            return $this->processAssignmentNoSemi($ctx->assignmentNoSemi());
        }
        if ($ctx->incDecStmt() !== null) {
            return $this->visitIncDecStmt($ctx->incDecStmt());
        }
        return null;
    }

    private function processAssignmentNoSemi(AssignmentNoSemiContext $ctx): mixed
    {
        $op     = $ctx->assignOp()->getText();
        $exprs  = $ctx->expList()->expression();
        $target = $ctx->assignTarget();

        if ($target->idList() !== null) {
            foreach ($target->idList()->IDENTIFIER() as $i => $idToken) {
                $varName = $idToken->getText();
                $sym     = $this->symTable->lookup($varName);
                if ($sym === null) continue;
                $val = isset($exprs[$i]) ? $this->visitExpressionTyped($exprs[$i], 'x9') : new ValResult('x9', 'int32');
                $this->emitAssignOp($op, $sym, $val->reg);
            }
        }
        return null;
    }

    // ══════════════════════════════════════════════════════════════════════
    //  VISITOR: BREAK / CONTINUE / RETURN
    // ══════════════════════════════════════════════════════════════════════

    public function visitBreakStmt(BreakStmtContext $ctx): mixed
    {
        if (!empty($this->breakStack)) {
            $this->emit("    b    " . end($this->breakStack));
        }
        return null;
    }

    public function visitContinueStmt(ContinueStmtContext $ctx): mixed
    {
        if (!empty($this->continueStack)) {
            $this->emit("    b    " . end($this->continueStack));
        }
        return null;
    }

    public function visitReturnStmt(ReturnStmtContext $ctx): mixed
    {
        if ($ctx->expList() !== null) {
            $exprs = $ctx->expList()->expression();
            if (count($exprs) === 1) {
                // Evaluar en x9 primero para no pisarse con x0 durante la evaluación
                // (ej: potencia llama a bl que devuelve en x0, si evaluamos en x0
                //  el mul posterior usa el x0 ya sobreescrito)
                $val = $this->visitExpressionTyped($exprs[0], 'x9');
                if ($val->reg !== 'x0') {
                    $this->emit("    mov  x0, {$val->reg}");
                }
            } elseif (count($exprs) >= 2) {
                // Evaluar en temporales antes de mover a x0/x1
                $v0 = $this->visitExpressionTyped($exprs[0], 'x9');
                $v1 = $this->visitExpressionTyped($exprs[1], 'x10');
                if ($v0->reg !== 'x0') $this->emit("    mov  x0, {$v0->reg}");
                if ($v1->reg !== 'x1') $this->emit("    mov  x1, {$v1->reg}");
            }
        }
        $this->emit("    b    _ret_{$this->currentFunc}");
        return null;
    }

    // ══════════════════════════════════════════════════════════════════════
    //  VISITOR: LLAMADAS A FUNCIÓN
    // ══════════════════════════════════════════════════════════════════════

    public function visitFunctionCallStmt(FunctionCallContext $ctx): mixed
    {
        $this->visitFunctionCallExpr($ctx, 'x0');
        return null;
    }

    /**
     * Genera código para una llamada a función y devuelve ValResult.
     */
    private function visitFunctionCallExpr(FunctionCallContext $ctx, string $destReg): ValResult
    {
        $funcName = $ctx->functionName()->getText();
        $args     = $ctx->args() ? $ctx->args()->expList()->expression() : [];

        if ($funcName === 'fmt.Println' || $funcName === 'println') {
            $this->emitPrintln($args, $destReg);
            return new ValResult($destReg, 'void');
        }
        if ($funcName === 'len') {
            return new ValResult($this->emitLen($args, $destReg), 'int32');
        }
        if ($funcName === 'now') {
            return new ValResult($this->emitNow($destReg), 'string');
        }
        if ($funcName === 'substr') {
            return new ValResult($this->emitSubstr($args, $destReg), 'string');
        }
        if ($funcName === 'typeOf') {
            return new ValResult($this->emitTypeOf($args, $destReg), 'string');
        }

        // Función de usuario
        foreach ($args as $i => $arg) {
            $argReg = "x{$i}";
            $val    = $this->visitExpressionTyped($arg, $argReg);
            if ($val->reg !== $argReg) {
                $this->emit("    mov  {$argReg}, {$val->reg}");
            }
        }
        $this->emit("    bl   {$funcName}");
        if ($destReg !== 'x0') {
            $this->emit("    mov  {$destReg}, x0");
        }

        // Intentar inferir tipo de retorno
        $retType = 'int32';
        if (isset($this->declaredFunctions[$funcName])) {
            $fsym = $this->declaredFunctions[$funcName];
            if (!empty($fsym->returnTypes)) {
                $retType = $fsym->returnTypes[0];
            }
        }
        return new ValResult($destReg, $retType);
    }

    // ══════════════════════════════════════════════════════════════════════
    //  EMIT PRINTLN — con tipos correctos
    // ══════════════════════════════════════════════════════════════════════

    private function emitPrintln(array $args, string $dest): void
    {
        $count = count($args);
        if ($count === 0) {
            $this->emit("    bl   print_newline");
            return;
        }

        $scratch = $this->scratchOffset;

        // Preservar x19 del llamador
        $this->emit("    str  x19, [x29, #{$scratch}]");

        foreach ($args as $idx => $arg) {
            $isLast = ($idx === $count - 1);

            // Evaluar argumento con tipo
            $val = $this->visitExpressionTyped($arg, 'x9');
            $typeStr = $val->type;

            // Imprimir separador de espacio (excepto el primero)
            if ($idx > 0) {
                $this->emit("    str  x9, [x29, #{$scratch}]");
                $this->emit("    bl   print_space");
                $this->emit("    ldr  x9, [x29, #{$scratch}]");
            }

            // Mover a x0 para la función de print
            if ($val->reg !== 'x9') {
                $this->emit("    mov  x9, {$val->reg}");
            }
            // Guardar valor en scratch antes del bl (bl destruye x0-x18)
            $this->emit("    str  x9, [x29, #{$scratch}]");
            $this->emit("    ldr  x0, [x29, #{$scratch}]");

            // Seleccionar función de print correcta según el tipo
            if ($typeStr === 'nil') {
                // nil → imprimir "<nil>"
                $this->emit("    adrp x0, _nil_str");
                $this->emit("    add  x0, x0, :lo12:_nil_str");
                $fn = $isLast ? 'print_string' : 'print_string_inline';
                $this->emit("    bl   {$fn}");
            } elseif ($typeStr === 'string') {
                $lc     = $this->labelCount++;
                $nilLbl = "_pnil_{$lc}";
                $okLbl  = "_pok_{$lc}";
                $fn     = $isLast ? 'print_string' : 'print_string_inline';
                $this->emit("    cbz  x0, {$nilLbl}");
                $this->emit("    bl   {$fn}");
                $this->emit("    b    {$okLbl}");
                $this->emitLabel($nilLbl);
                $this->emit("    adrp x0, _nil_str");
                $this->emit("    add  x0, x0, :lo12:_nil_str");
                $this->emit("    bl   {$fn}");
                $this->emitLabel($okLbl);
            } elseif ($typeStr === 'bool') {
                $this->emit("    bl   " . ($isLast ? 'print_bool' : 'print_bool_inline'));
            } elseif ($typeStr === 'rune') {
                $this->emit("    bl   " . ($isLast ? 'print_rune' : 'print_int_inline'));
            } elseif ($typeStr === 'float32') {
                $this->emit("    bl   " . ($isLast ? 'print_float' : 'print_float_inline'));
            } else {
                // int32, int, u int, punteros de no-string
                $this->emit("    bl   " . ($isLast ? 'print_int' : 'print_int_inline'));
            }
        }

        // Restaurar x19
        $this->emit("    ldr  x19, [x29, #{$scratch}]");
    }

    // ── Funciones built-in ─────────────────────────────────────────────────

    private function emitLen(array $args, string $dest): string
    {
        if (empty($args)) return $dest;
        $arg = $args[0];
        $txt = trim($arg->getText());
        $sym = $this->symTable->lookup($txt);
        if ($sym !== null && $sym->type === 'array') {
            $total = array_product($sym->dimensions);
            $this->emitMovImm($dest, $total);
            return $dest;
        }
        $val = $this->visitExpressionTyped($arg, 'x0');
        if ($val->reg !== 'x0') $this->emit("    mov  x0, {$val->reg}");
        $lbl1 = $this->newLabel('len_lp');
        $lbl2 = $this->newLabel('len_end');
        $this->emit("    mov  x1, #0");
        $this->emitLabel($lbl1);
        $this->emit("    ldrb w2, [x0, x1]");
        $this->emit("    cbz  w2, {$lbl2}");
        $this->emit("    add  x1, x1, #1");
        $this->emit("    b    {$lbl1}");
        $this->emitLabel($lbl2);
        if ($dest !== 'x1') $this->emit("    mov  {$dest}, x1");
        return $dest;
    }

    private function emitNow(string $dest): string
{
    $lbl = $this->newStrLabel();

    //  Obtener fecha actual dinámica
    $now = date("Y-m-d H:i:s");

    //  Escapar por seguridad (por si acaso)
    $now = addslashes($now);

    //  Insertar en sección .data
    $this->dataSection[] = "{$lbl}: .asciz \"{$now}\"";

    //  Cargar dirección en registro destino
    $this->emit("    adrp {$dest}, {$lbl}");
    $this->emit("    add  {$dest}, {$dest}, :lo12:{$lbl}");

    return $dest;
}

    private function emitSubstr(array $args, string $dest): string
    {
        if (count($args) < 3) return $dest;

        // substr(str, start, length) → retorna puntero a un buffer en stack con
        // los primeros `length` bytes a partir de `start`, null-terminado.
        // Usamos un label en .data para un buffer estático de 256 bytes.
        static $substrBufCount = 0;
        $substrBufCount++;
        $bufLbl = "_substr_buf_{$substrBufCount}";
        $this->dataSection[] = "{$bufLbl}: .space 256";

        $v0 = $this->visitExpressionTyped($args[0], 'x0');  // string base
        $v1 = $this->visitExpressionTyped($args[1], 'x1');  // start
        $v2 = $this->visitExpressionTyped($args[2], 'x2');  // length

        if ($v0->reg !== 'x0') $this->emit("    mov  x0, {$v0->reg}");
        if ($v1->reg !== 'x1') $this->emit("    mov  x1, {$v1->reg}");
        if ($v2->reg !== 'x2') $this->emit("    mov  x2, {$v2->reg}");

        // x0 = str + start
        $this->emit("    add  x0, x0, x1");

        // Copiar x2 bytes de x0 a bufLbl
        $loopLbl = $this->newLabel('substr_lp');
        $endLbl  = $this->newLabel('substr_end');
        $this->emit("    adrp x3, {$bufLbl}");
        $this->emit("    add  x3, x3, :lo12:{$bufLbl}");
        $this->emit("    mov  x4, #0");
        $this->emitLabel($loopLbl);
        $this->emit("    cmp  x4, x2");
        $this->emit("    b.ge {$endLbl}");
        $this->emit("    ldrb w5, [x0, x4]");
        $this->emit("    strb w5, [x3, x4]");
        $this->emit("    add  x4, x4, #1");
        $this->emit("    b    {$loopLbl}");
        $this->emitLabel($endLbl);
        // Null-terminar
        $this->emit("    mov  w5, #0");
        $this->emit("    strb w5, [x3, x4]");

        // Retornar puntero al buffer
        $this->emit("    adrp {$dest}, {$bufLbl}");
        $this->emit("    add  {$dest}, {$dest}, :lo12:{$bufLbl}");
        return $dest;
    }

    private function emitTypeOf(array $args, string $dest): string
    {
        if (empty($args)) return $dest;
        $type = $this->inferExprType($args[0]);
        $lbl  = $this->newStrLabel();
        $this->dataSection[] = "{$lbl}: .asciz \"{$type}\"";
        $this->emit("    adrp {$dest}, {$lbl}");
        $this->emit("    add  {$dest}, {$dest}, :lo12:{$lbl}");
        return $dest;
    }

    // ══════════════════════════════════════════════════════════════════════
    //  VISITOR: EXPRESIONES — NÚCLEO TIPADO
    //
    //  Cada visitXxxToReg retorna un ValResult { reg, type }.
    //  El tipo viaja con el valor para que emitPrintln siempre sepa qué
    //  función de print llamar, independientemente del contexto.
    // ══════════════════════════════════════════════════════════════════════

    /**
     * Punto de entrada principal para evaluar una expresión.
     * Retorna un ValResult con (registro, tipo).
     */
    private function visitExpressionTyped(ExpressionContext $ctx, string $destReg): ValResult
    {
        return $this->visitLogicalOrTyped($ctx->logicalOrExp(), $destReg);
    }

    /** @deprecated Usar visitExpressionTyped */
    private function visitExpressionToReg(ExpressionContext $ctx, string $destReg): string
    {
        $val = $this->visitExpressionTyped($ctx, $destReg);
        return $val->reg;
    }

    public function visitExpression(ExpressionContext $ctx): mixed
    {
        $this->visitExpressionTyped($ctx, 'x9');
        return null;
    }

    private function visitLogicalOrTyped(LogicalOrExpContext $ctx, string $dest): ValResult
    {
        $operands = $ctx->logicalAndExp();
        if (count($operands) === 1) {
            return $this->visitLogicalAndTyped($operands[0], $dest);
        }
        // a || b  → bool
        $labelTrue = $this->newLabel('or_true');
        $labelEnd  = $this->newLabel('or_end');

        $r = $this->visitLogicalAndTyped($operands[0], $dest);
        if ($r->reg !== $dest) $this->emit("    mov  {$dest}, {$r->reg}");
        $this->emit("    cmp  {$dest}, #0");
        $this->emit("    b.ne {$labelTrue}");

        for ($i = 1; $i < count($operands); $i++) {
            $r = $this->visitLogicalAndTyped($operands[$i], $dest);
            if ($r->reg !== $dest) $this->emit("    mov  {$dest}, {$r->reg}");
            if ($i < count($operands) - 1) {
                $this->emit("    cmp  {$dest}, #0");
                $this->emit("    b.ne {$labelTrue}");
            }
        }
        $this->emit("    b    {$labelEnd}");
        $this->emitLabel($labelTrue);
        $this->emit("    mov  {$dest}, #1");
        $this->emitLabel($labelEnd);
        return new ValResult($dest, 'bool');
    }

    private function visitLogicalAndTyped(LogicalAndExpContext $ctx, string $dest): ValResult
    {
        $operands = $ctx->equalityExp();
        if (count($operands) === 1) {
            return $this->visitEqualityTyped($operands[0], $dest);
        }
        $labelFalse = $this->newLabel('and_false');
        $labelEnd   = $this->newLabel('and_end');

        $r = $this->visitEqualityTyped($operands[0], $dest);
        if ($r->reg !== $dest) $this->emit("    mov  {$dest}, {$r->reg}");
        $this->emit("    cmp  {$dest}, #0");
        $this->emit("    b.eq {$labelFalse}");

        for ($i = 1; $i < count($operands); $i++) {
            $r = $this->visitEqualityTyped($operands[$i], $dest);
            if ($r->reg !== $dest) $this->emit("    mov  {$dest}, {$r->reg}");
            if ($i < count($operands) - 1) {
                $this->emit("    cmp  {$dest}, #0");
                $this->emit("    b.eq {$labelFalse}");
            }
        }
        $this->emit("    b    {$labelEnd}");
        $this->emitLabel($labelFalse);
        $this->emit("    mov  {$dest}, #0");
        $this->emitLabel($labelEnd);
        return new ValResult($dest, 'bool');
    }

    private function visitEqualityTyped(EqualityExpContext $ctx, string $dest): ValResult
    {
        $operands = $ctx->relationalExp();
        if (count($operands) === 1) {
            return $this->visitRelationalTyped($operands[0], $dest);
        }
        $left  = $this->visitRelationalTyped($operands[0], $dest);
        $right = $this->visitRelationalTyped($operands[1], 'x10');
        if ($left->reg !== $dest)   $this->emit("    mov  {$dest}, {$left->reg}");
        if ($right->reg !== 'x10')  $this->emit("    mov  x10, {$right->reg}");

        $ops = [];
        for ($i = 0; $i < $ctx->getChildCount(); $i++) {
            $child = $ctx->getChild($i);
            if ($child instanceof \Antlr\Antlr4\Runtime\Tree\TerminalNode) {
                $t = $child->getText();
                if ($t === '==' || $t === '!=') $ops[] = $t;
            }
        }
        $op = $ops[0] ?? '==';

        $this->emit("    cmp  {$dest}, x10");
        $lblTrue = $this->newLabel('eq_t');
        $lblEnd  = $this->newLabel('eq_e');
        $branch  = ($op === '==') ? 'b.eq' : 'b.ne';
        $this->emit("    {$branch} {$lblTrue}");
        $this->emit("    mov  {$dest}, #0");
        $this->emit("    b    {$lblEnd}");
        $this->emitLabel($lblTrue);
        $this->emit("    mov  {$dest}, #1");
        $this->emitLabel($lblEnd);
        return new ValResult($dest, 'bool');
    }

    private function visitRelationalTyped(RelationalExpContext $ctx, string $dest): ValResult
    {
        $operands = $ctx->additiveExp();
        if (count($operands) === 1) {
            return $this->visitAdditiveTyped($operands[0], $dest);
        }
        $left  = $this->visitAdditiveTyped($operands[0], $dest);
        $right = $this->visitAdditiveTyped($operands[1], 'x10');
        if ($left->reg !== $dest)   $this->emit("    mov  {$dest}, {$left->reg}");
        if ($right->reg !== 'x10')  $this->emit("    mov  x10, {$right->reg}");

        $op = '';
        for ($i = 0; $i < $ctx->getChildCount(); $i++) {
            $child = $ctx->getChild($i);
            if ($child instanceof \Antlr\Antlr4\Runtime\Tree\TerminalNode) {
                $t = $child->getText();
                if (in_array($t, ['<', '<=', '>', '>='])) { $op = $t; break; }
            }
        }

        $this->emit("    cmp  {$dest}, x10");
        $lblTrue = $this->newLabel('rel_t');
        $lblEnd  = $this->newLabel('rel_e');
        $branch  = match($op) {
            '<'  => 'b.lt',
            '<=' => 'b.le',
            '>'  => 'b.gt',
            '>=' => 'b.ge',
            default => 'b.lt',
        };
        $this->emit("    {$branch} {$lblTrue}");
        $this->emit("    mov  {$dest}, #0");
        $this->emit("    b    {$lblEnd}");
        $this->emitLabel($lblTrue);
        $this->emit("    mov  {$dest}, #1");
        $this->emitLabel($lblEnd);
        return new ValResult($dest, 'bool');
    }

    private function visitAdditiveTyped(AdditiveExpContext $ctx, string $dest): ValResult
    {
        $operands = $ctx->multiplicativeExp();
        $result   = $this->visitMultiplicativeTyped($operands[0], $dest);
        if ($result->reg !== $dest) $this->emit("    mov  {$dest}, {$result->reg}");
        $type = $result->type;

        $ops = [];
        for ($j = 0; $j < $ctx->getChildCount(); $j++) {
            $child = $ctx->getChild($j);
            if ($child instanceof \Antlr\Antlr4\Runtime\Tree\TerminalNode) {
                $t = $child->getText();
                if ($t === '+' || $t === '-') $ops[] = $t;
            }
        }

        for ($i = 1; $i < count($operands); $i++) {
            $op  = $ops[$i - 1] ?? '+';
            $rhs = $this->visitMultiplicativeTyped($operands[$i], 'x10');
            if ($rhs->reg !== 'x10') $this->emit("    mov  x10, {$rhs->reg}");
            if ($op === '+') {
                $this->emit("    add  {$dest}, {$dest}, x10");
            } else {
                $this->emit("    sub  {$dest}, {$dest}, x10");
            }
        }
        return new ValResult($dest, $type);
    }

    private function visitMultiplicativeTyped(MultiplicativeExpContext $ctx, string $dest): ValResult
    {
        $operands = $ctx->unaryExp();
        $result   = $this->visitUnaryTyped($operands[0], $dest);
        if ($result->reg !== $dest) $this->emit("    mov  {$dest}, {$result->reg}");
        $type = $result->type;

        $ops = [];
        for ($j = 0; $j < $ctx->getChildCount(); $j++) {
            $child = $ctx->getChild($j);
            if ($child instanceof \Antlr\Antlr4\Runtime\Tree\TerminalNode) {
                $t = $child->getText();
                if ($t === '*' || $t === '/' || $t === '%') $ops[] = $t;
            }
        }

        for ($i = 1; $i < count($operands); $i++) {
            $op  = $ops[$i - 1] ?? '*';
            $rhs = $this->visitUnaryTyped($operands[$i], 'x10');
            if ($rhs->reg !== 'x10') $this->emit("    mov  x10, {$rhs->reg}");

            $leftIsFloat  = ($type === 'float32');
            $rightIsFloat = ($rhs->type === 'float32');

            if ($op === '*') {
                $this->emit("    mul  {$dest}, {$dest}, x10");
                // float*float → acumula escala x1000 extra → dividir por 1000
                if ($leftIsFloat && $rightIsFloat) {
                    $this->emit("    mov  x11, #1000");
                    $this->emit("    sdiv {$dest}, {$dest}, x11");
                }
                if ($leftIsFloat || $rightIsFloat) $type = 'float32';
            } elseif ($op === '/') {
                // float/float: (a*1000)/(b*1000) = a/b (sin escala) → multiplicar por 1000
                if ($leftIsFloat && $rightIsFloat) {
                    $this->emit("    mov  x11, #1000");
                    $this->emit("    mul  {$dest}, {$dest}, x11");
                }
                $this->emit("    sdiv {$dest}, {$dest}, x10");
                if ($leftIsFloat || $rightIsFloat) $type = 'float32';
            } else {
                // módulo: solo enteros
                $this->emit("    sdiv x11, {$dest}, x10");
                $this->emit("    msub {$dest}, x11, x10, {$dest}");
            }
        }
        return new ValResult($dest, $type);
    }

    private function visitUnaryTyped(UnaryExpContext $ctx, string $dest): ValResult
    {
        if ($ctx->primary() !== null) {
            return $this->visitPrimaryTyped($ctx->primary(), $dest);
        }

        $op = $ctx->getChild(0)->getText();

        // ── & (address-of) ────────────────────────────────────────────────
        // Necesita acceso especial al identificador interno para calcular
        // su dirección en el frame (add destReg, x29, #offset) en lugar
        // de cargar el valor.
        if ($op === '&') {
            return $this->visitAddressOf($ctx->unaryExp(), $dest);
        }

        $inner = $this->visitUnaryTyped($ctx->unaryExp(), $dest);
        if ($inner->reg !== $dest) $this->emit("    mov  {$dest}, {$inner->reg}");

        $type = $inner->type;

        if ($op === '-') {
            $this->emit("    neg  {$dest}, {$dest}");
        } elseif ($op === '!') {
            $this->emit("    cmp  {$dest}, #0");
            $lblT = $this->newLabel('not_t');
            $lblE = $this->newLabel('not_e');
            $this->emit("    b.eq {$lblT}");
            $this->emit("    mov  {$dest}, #0");
            $this->emit("    b    {$lblE}");
            $this->emitLabel($lblT);
            $this->emit("    mov  {$dest}, #1");
            $this->emitLabel($lblE);
            $type = 'bool';
        } elseif ($op === '*') {
            // Desreferenciación de puntero: el valor en dest es una dirección,
            // cargar lo que apunta.
            $this->emit("    ldr  {$dest}, [{$dest}]");
        }
        return new ValResult($dest, $type);
    }

    /**
     * Emite la DIRECCIÓN de una variable (operador &varName o &arr).
     * Para variables escalares locales: add dest, x29, #offset
     * Para arreglos locales:            add dest, x29, #offset  (base del arreglo)
     */
    private function visitAddressOf(UnaryExpContext $inner, string $dest): ValResult
    {
        // Bajar hasta el primary del unaryExp interno
        $cur = $inner;
        while ($cur->primary() === null && $cur->unaryExp() !== null) {
            $cur = $cur->unaryExp();
        }
        $primary = $cur->primary();

        if ($primary !== null) {
            // Caso: &arr[i]  — acceso indexado, calculamos dirección del elemento
            if ($primary->arrayAccess() !== null) {
                $name = $primary->arrayAccess()->IDENTIFIER()->getText();
                $sym  = $this->symTable->lookup($name);
                if ($sym !== null) {
                    $this->computeArrayOffset($sym, $primary->arrayAccess()->arrayIndex(), $dest);
                    return new ValResult($dest, '*int32');
                }
                $this->emit("    mov  {$dest}, #0");
                return new ValResult($dest, '*int32');
            }

            // Caso: &varName  — dirección de variable escalar o arreglo
            if ($primary->IDENTIFIER() !== null) {
                $varName = $primary->IDENTIFIER()->getText();
                $sym     = $this->symTable->lookup($varName);
                if ($sym !== null) {
                    if ($sym->scope === 'global') {
                        $this->emit("    adrp {$dest}, {$sym->name}");
                        $this->emit("    add  {$dest}, {$dest}, :lo12:{$sym->name}");
                    } else {
                        // Variable local: dirección = x29 + offset
                        $this->emit("    add  {$dest}, x29, #{$sym->offset}");
                    }
                    return new ValResult($dest, '*' . $sym->type);
                }
            }
        }

        // Fallback
        $this->emit("    mov  {$dest}, #0");
        return new ValResult($dest, '*int32');
    }

    private function visitPrimaryTyped(PrimaryContext $ctx, string $dest): ValResult
    {
        // ── Literal entero ────────────────────────────────────────────────
        if ($ctx->INT_LITERAL() !== null) {
            $val = (int)$ctx->INT_LITERAL()->getText();
            $this->emitMovImm($dest, $val);
            return new ValResult($dest, 'int32');
        }

        // ── Literal flotante (escalado x1000) ─────────────────────────────
        if ($ctx->FLOAT_LITERAL() !== null) {
            $val    = $ctx->FLOAT_LITERAL()->getText();
            $scaled = (int)round((float)$val * 1000);
            $this->emitMovImm($dest, $scaled);
            return new ValResult($dest, 'float32');
        }

        // ── String literal ────────────────────────────────────────────────
        if ($ctx->STRING() !== null) {
            $raw     = $ctx->STRING()->getText();
            $content = substr($raw, 1, -1);
            $lbl     = $this->newStrLabel();
            $escaped = $this->escapeStringForAsm($content);
            $this->dataSection[] = "{$lbl}: .ascii \"{$escaped}\"";
            $this->dataSection[] = "    .byte 0";
            $this->emit("    adrp {$dest}, {$lbl}");
            $this->emit("    add  {$dest}, {$dest}, :lo12:{$lbl}");
            return new ValResult($dest, 'string');
        }

        // ── Rune literal ──────────────────────────────────────────────────
        if ($ctx->RUNE_LITERAL() !== null) {
            $raw   = $ctx->RUNE_LITERAL()->getText();
            $inner = substr($raw, 1, -1);
            $cp    = str_starts_with($inner, '\\u')
                ? hexdec(substr($inner, 2))
                : ord($inner);
            $this->emitMovImm($dest, $cp);
            return new ValResult($dest, 'rune');
        }

        // ── true / false ──────────────────────────────────────────────────
        if ($ctx->TRUE() !== null) {
            $this->emit("    mov  {$dest}, #1");
            return new ValResult($dest, 'bool');
        }
        if ($ctx->FALSE() !== null) {
            $this->emit("    mov  {$dest}, #0");
            return new ValResult($dest, 'bool');
        }

        // ── nil ───────────────────────────────────────────────────────────
        if ($ctx->NIL() !== null) {
            $this->emit("    mov  {$dest}, #0");
            return new ValResult($dest, 'nil');
        }

        // ── Identificador ─────────────────────────────────────────────────
        if ($ctx->IDENTIFIER() !== null
            && $ctx->functionCall() === null
            && $ctx->arrayAccess() === null
        ) {
            $varName = $ctx->IDENTIFIER()->getText();
            $sym     = $this->symTable->lookup($varName);
            if ($sym === null) {
                $this->errorReport->addError('Semántico', "Variable '{$varName}' no declarada",
                    $ctx->IDENTIFIER()->getSymbol()->getLine(),
                    $ctx->IDENTIFIER()->getSymbol()->getCharPositionInLine());
                $this->emit("    mov  {$dest}, #0");
                return new ValResult($dest, 'int32');
            }
            $this->emitLoadVar($dest, $sym);
            return new ValResult($dest, $sym->type);
        }

        // ── Llamada a función ─────────────────────────────────────────────
        if ($ctx->functionCall() !== null) {
            return $this->visitFunctionCallExpr($ctx->functionCall(), $dest);
        }

        // ── Acceso a arreglo ──────────────────────────────────────────────
        if ($ctx->arrayAccess() !== null) {
            return $this->loadFromArray($ctx->arrayAccess(), $dest);
        }

        // ── Acceso por puntero ────────────────────────────────────────────
        if ($ctx->pointerAccess() !== null) {
            $stars   = count($ctx->pointerAccess()->MULT());
            $varName = $ctx->pointerAccess()->IDENTIFIER()->getText();
            $sym     = $this->symTable->lookup($varName);
            if ($sym !== null) {
                // Cargar el valor del puntero (la dirección)
                $this->emitLoadVar($dest, $sym);
                // Desreferenciar tantos niveles como * haya
                for ($s = 0; $s < $stars; $s++) {
                    $this->emit("    ldr  {$dest}, [{$dest}]");
                }
            } else {
                $this->emit("    mov  {$dest}, #0");
            }
            // El tipo base del puntero (quitar un nivel de *)
            $baseType = ltrim($sym->type ?? 'int32', '*') ?: 'int32';
            return new ValResult($dest, $baseType);
        }

        // ── Expresión entre paréntesis ────────────────────────────────────
        if ($ctx->expression() !== null) {
            return $this->visitExpressionTyped($ctx->expression(), $dest);
        }

        // ── Array literal (en expresión) ──────────────────────────────────
        if ($ctx->arrayLiteral() !== null) {
            $this->emit("    mov  {$dest}, #0");
            return new ValResult($dest, 'array');
        }

        $this->emit("    mov  {$dest}, #0");
        return new ValResult($dest, 'int32');
    }

    // ══════════════════════════════════════════════════════════════════════
    //  ARREGLOS
    // ══════════════════════════════════════════════════════════════════════

    private function loadFromArray(ArrayAccessContext $ctx, string $dest): ValResult
    {
        $name = $ctx->IDENTIFIER()->getText();
        $sym  = $this->symTable->lookup($name);
        if ($sym === null) {
            $this->errorReport->addError('Semántico', "Arreglo '{$name}' no declarado",
                $ctx->IDENTIFIER()->getSymbol()->getLine(),
                $ctx->IDENTIFIER()->getSymbol()->getCharPositionInLine());
            $this->emit("    mov  {$dest}, #0");
            return new ValResult($dest, 'int32');
        }
        $this->computeArrayOffset($sym, $ctx->arrayIndex(), 'x11');
        $this->emit("    ldr  {$dest}, [x11]");
        $baseType = $sym->baseType ?? 'int32';
        return new ValResult($dest, $baseType);
    }

    private function computeArrayOffset(ArmSymbol $sym, array $indices, string $addrReg): void
    {
        $baseOff = $sym->offset;
        $this->emit("    add  {$addrReg}, x29, #{$baseOff}");
        $dims = $sym->dimensions;
        foreach ($indices as $i => $idxCtx) {
            $idxVal = $this->visitExpressionTyped($idxCtx->expression(), 'x12');
            if ($idxVal->reg !== 'x12') $this->emit("    mov  x12, {$idxVal->reg}");
            $stride = 8;
            for ($d = $i + 1; $d < count($dims); $d++) {
                $stride *= $dims[$d];
            }
            $this->emitMovImm('x13', $stride);
            $this->emit("    mul  x12, x12, x13");
            $this->emit("    add  {$addrReg}, {$addrReg}, x12");
        }
    }

    // ══════════════════════════════════════════════════════════════════════
    //  INFERENCIA DE TIPO (para compatibilidad con código heredado)
    // ══════════════════════════════════════════════════════════════════════

    private function inferExprType(ExpressionContext $ctx): string
    {
        $txt = $ctx->getText();
        if (str_contains($txt, 'nil')) return 'nil';

        $primary = $ctx->logicalOrExp()
            ->logicalAndExp(0)
            ->equalityExp(0)
            ->relationalExp(0)
            ->additiveExp(0)
            ->multiplicativeExp(0)
            ->unaryExp(0)
            ->primary() ?? null;

        // Operaciones booleanas
        $lor = $ctx->logicalOrExp();
        if (count($lor->logicalAndExp()) > 1) return 'bool';
        $land = $lor->logicalAndExp(0);
        if (count($land->equalityExp()) > 1) return 'bool';
        $eq = $land->equalityExp(0);
        if (count($eq->relationalExp()) > 1) return 'bool';
        $rel = $eq->relationalExp(0);
        if (count($rel->additiveExp()) > 1) return 'bool';

        // NOT unario
        $unary = $rel->additiveExp(0)->multiplicativeExp(0)->unaryExp(0);
        if ($unary->primary() === null && $unary->unaryExp() !== null) {
            if ($unary->getChild(0)->getText() === '!') return 'bool';
        }

        if ($primary === null) {
            if (str_starts_with($txt, '"')) return 'string';
            if ($txt === 'true' || $txt === 'false') return 'bool';
            if (str_starts_with($txt, "'")) return 'rune';
            if ($txt === 'nil') return 'nil';
            if (str_contains($txt, '.') && is_numeric($txt)) return 'float32';
            $sym = $this->symTable->lookup($txt);
            if ($sym !== null) return $sym->type;
            return 'int32';
        }

        if ($primary->STRING() !== null)       return 'string';
        if ($primary->TRUE() !== null)         return 'bool';
        if ($primary->FALSE() !== null)        return 'bool';
        if ($primary->NIL() !== null)          return 'nil';
        if ($primary->RUNE_LITERAL() !== null) return 'rune';
        if ($primary->FLOAT_LITERAL() !== null) return 'float32';
        if ($primary->INT_LITERAL() !== null)  return 'int32';
        if ($primary->IDENTIFIER() !== null
            && $primary->functionCall() === null
            && $primary->arrayAccess() === null) {
            $sym = $this->symTable->lookup($primary->IDENTIFIER()->getText());
            if ($sym !== null) return $sym->type;
        }
        if ($primary->arrayLiteral() !== null)  return 'array';
        if ($primary->expression() !== null)    return $this->inferExprType($primary->expression());
        return 'int32';
    }

    // ══════════════════════════════════════════════════════════════════════
    //  RESOLUCIÓN DE TIPOS
    // ══════════════════════════════════════════════════════════════════════

    private function resolveTypeName(TypeContext $ctx): string
    {
        if ($ctx->baseType() !== null) {
            return ArmSymbolTable::normalizeType($ctx->baseType()->getText());
        }
        if ($ctx->pointerType() !== null) {
            return '*' . $this->resolveTypeName($ctx->pointerType()->type());
        }
        if ($ctx->arrayType() !== null) {
            $dims = array_map(
                fn($d) => $d->INT_LITERAL()->getText(),
                $ctx->arrayType()->arrayDimension()
            );
            $base = ArmSymbolTable::normalizeType($ctx->arrayType()->baseType()->getText());
            return '[' . implode('][', $dims) . ']' . $base;
        }
        return 'int32';
    }

    // ══════════════════════════════════════════════════════════════════════
    //  MÉTODOS VISITOR REQUERIDOS POR LA INTERFAZ (no usados directamente)
    // ══════════════════════════════════════════════════════════════════════

    public function visitParams(ParamsContext $ctx): mixed                         { return null; }
    public function visitParam(ParamContext $ctx): mixed                           { return null; }
    public function visitReturnTypes(ReturnTypesContext $ctx): mixed               { return null; }
    public function visitIdList(IdListContext $ctx): mixed                         { return null; }
    public function visitExpList(ExpListContext $ctx): mixed                       { return null; }
    public function visitType(TypeContext $ctx): mixed                             { return null; }
    public function visitBaseType(BaseTypeContext $ctx): mixed                     { return null; }
    public function visitPointerType(PointerTypeContext $ctx): mixed               { return null; }
    public function visitArrayType(ArrayTypeContext $ctx): mixed                   { return null; }
    public function visitArrayDimension(ArrayDimensionContext $ctx): mixed         { return null; }
    public function visitArrayLiteral(ArrayLiteralContext $ctx): mixed             { return null; }
    public function visitArrayElements(ArrayElementsContext $ctx): mixed           { return null; }
    public function visitArrayElement(ArrayElementContext $ctx): mixed             { return null; }
    public function visitArrayAccess(ArrayAccessContext $ctx): mixed               { return null; }
    public function visitArrayIndex(ArrayIndexContext $ctx): mixed                 { return null; }
    public function visitPointerAccess(PointerAccessContext $ctx): mixed           { return null; }
    public function visitFunctionCall(FunctionCallContext $ctx): mixed             { return null; }
    public function visitFunctionName(FunctionNameContext $ctx): mixed             { return null; }
    public function visitArgs(ArgsContext $ctx): mixed                             { return null; }
    public function visitLogicalOrExp(LogicalOrExpContext $ctx): mixed             { return null; }
    public function visitLogicalAndExp(LogicalAndExpContext $ctx): mixed           { return null; }
    public function visitEqualityExp(EqualityExpContext $ctx): mixed               { return null; }
    public function visitRelationalExp(RelationalExpContext $ctx): mixed           { return null; }
    public function visitAdditiveExp(AdditiveExpContext $ctx): mixed               { return null; }
    public function visitMultiplicativeExp(MultiplicativeExpContext $ctx): mixed   { return null; }
    public function visitUnaryExp(UnaryExpContext $ctx): mixed                     { return null; }
    public function visitPrimary(PrimaryContext $ctx): mixed                       { return null; }
    public function visitCaseClause(CaseClauseContext $ctx): mixed                 { return null; }
    public function visitDefaultClause(DefaultClauseContext $ctx): mixed           { return null; }
    public function visitForClause(ForClauseContext $ctx): mixed                   { return null; }
    public function visitShortVarDeclNoSemi(ShortVarDeclNoSemiContext $ctx): mixed { return null; }
    public function visitAssignmentNoSemi(AssignmentNoSemiContext $ctx): mixed     { return null; }
    public function visitAssignTarget(AssignTargetContext $ctx): mixed             { return null; }
    public function visitAssignOp(AssignOpContext $ctx): mixed                     { return null; }

    public function defaultResult(): mixed { return null; }
}

// ══════════════════════════════════════════════════════════════════════════
//  CLASE AUXILIAR: ValResult
//  Transporta el registro y el tipo de Golampi de un valor evaluado.
// ══════════════════════════════════════════════════════════════════════════

/**
 * Resultado de evaluar una expresión.
 *
 * @property string $reg  Registro ARM64 donde quedó el resultado (ej. 'x9')
 * @property string $type Tipo Golampi del valor (ej. 'int32', 'string', 'bool', 'float32', 'rune', 'nil')
 */
class ValResult
{
    public function __construct(
        public readonly string $reg,
        public readonly string $type
    ) {}
}