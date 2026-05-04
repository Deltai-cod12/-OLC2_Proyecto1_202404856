# Código ARM64 generado por Golampi Compiler
# Arquitectura: AArch64 (ARM64)

.section .data
_str_1: .ascii "=== INICIO DE CALIFICACION: FUNCIONALIDADES BASICAS ==="
    .byte 0
_str_2: .ascii "
--- 1.1 DECLARACION LARGA ---"
    .byte 0
_str_3: .ascii "Golampi"
    .byte 0
_str_4: .ascii "
--- 1.2 ASIGNACION DE VARIABLES ---"
    .byte 0
_str_5: .ascii "Actualizado"
    .byte 0
_str_6: .ascii "
--- 1.3 FORMATO DE IDENTIFICADORES ---"
    .byte 0
_str_7: .ascii "Case sensitive:"
    .byte 0
_str_8: .ascii "
--- 1.4 DECLARACION CORTA ---"
    .byte 0
_str_9: .ascii "Inferencia"
    .byte 0
_str_10: .ascii "
--- 1.5 DECLARACION LARGA SIN INICIALIZAR ---"
    .byte 0
_str_11: .byte 0
_str_12: .ascii "
--- 1.6 DECLARACION MULTIPLE ---"
    .byte 0
_str_13: .ascii "Hola"
    .byte 0
_str_14: .ascii "Mundo"
    .byte 0
_str_15: .ascii "
--- 1.7 CONSTANTES ---"
    .byte 0
_str_16: .ascii "
--- 1.8 MANEJO DE NIL ---"
    .byte 0
_str_17: .ascii "Impresion de nil:"
    .byte 0
_str_18: .ascii "Comparacion nil == nil:"
    .byte 0
_str_19: .ascii "
--- 1.11 OPERACIONES ARITMETICAS ---"
    .byte 0
_str_20: .ascii "+:"
    .byte 0
_str_21: .ascii "-:"
    .byte 0
_str_22: .ascii "*:"
    .byte 0
_str_23: .ascii "/:"
    .byte 0
_str_24: .ascii "%:"
    .byte 0
_str_25: .ascii "
--- 1.12 OPERACIONES RELACIONALES ---"
    .byte 0
_str_26: .ascii "==:"
    .byte 0
_str_27: .ascii "!=:"
    .byte 0
_str_28: .ascii "<:"
    .byte 0
_str_29: .ascii ">:"
    .byte 0
_str_30: .ascii "
--- 1.13 OPERACIONES LOGICAS ---"
    .byte 0
_str_31: .ascii "true && false:"
    .byte 0
_str_32: .ascii "true || false:"
    .byte 0
_str_33: .ascii "!true:"
    .byte 0
_str_34: .ascii "
--- 1.14 CORTO CIRCUITO ---"
    .byte 0
_str_35: .ascii "AND:"
    .byte 0
_str_36: .ascii "OR:"
    .byte 0
_str_37: .ascii "
--- 1.15 OPERADORES DE ASIGNACION ---"
    .byte 0
_str_38: .ascii "Resultado final:"
    .byte 0
_str_39: .ascii "
=== FIN DE CALIFICACION: FUNCIONALIDADES BASICAS ==="
    .byte 0
_int_buf:   .space 32
_float_buf: .space 32
_newline:   .byte 10
_space_ch:  .byte 32
_dot_ch:    .byte 46
_true_str:  .ascii "true"
_false_str: .ascii "false"
_nil_str:   .ascii "<nil>"
_null_str:  .byte 0
_empty_str: .byte 0

.section .text
.align 2
.global _start

print_int:
    stp x29, x30, [sp, #-48]!
    mov x29, sp
    str x19, [sp, #16]
    str x20, [sp, #24]
    str x21, [sp, #32]
    mov x19, x0
    cmp x19, #0
    b.ge _pi_positive
    adrp x0, _int_buf
    add x0, x0, :lo12:_int_buf
    mov w1, #45
    strb w1, [x0]
    mov x1, x0
    mov x0, #1
    mov x2, #1
    mov x8, #64
    svc #0
    neg x19, x19
_pi_positive:
    adrp x20, _int_buf
    add x20, x20, :lo12:_int_buf
    mov x21, #0
    cmp x19, #0
    b.ne _pi_loop
    mov w1, #48
    strb w1, [x20]
    mov x1, x20
    mov x0, #1
    mov x2, #1
    mov x8, #64
    svc #0
    b _pi_newline
_pi_loop:
    cbz x19, _pi_reverse
    mov x0, x19
    mov x1, #10
    udiv x2, x0, x1
    msub x3, x2, x1, x0
    add w3, w3, #48
    strb w3, [x20, x21]
    add x21, x21, #1
    mov x19, x2
    b _pi_loop
_pi_reverse:
    mov x0, #0
    sub x1, x21, #1
_pi_rev_loop:
    cmp x0, x1
    b.ge _pi_print
    ldrb w2, [x20, x0]
    ldrb w3, [x20, x1]
    strb w3, [x20, x0]
    strb w2, [x20, x1]
    add x0, x0, #1
    sub x1, x1, #1
    b _pi_rev_loop
_pi_print:
    mov x1, x20
    mov x0, #1
    mov x2, x21
    mov x8, #64
    svc #0
_pi_newline:
    adrp x0, _newline
    add x0, x0, :lo12:_newline
    mov x1, x0
    mov x0, #1
    mov x2, #1
    mov x8, #64
    svc #0
    ldr x19, [sp, #16]
    ldr x20, [sp, #24]
    ldr x21, [sp, #32]
    ldp x29, x30, [sp], #48
    ret

print_bool:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    cmp x0, #0
    b.eq _pb_false
    adrp x1, _true_str
    add x1, x1, :lo12:_true_str
    mov x0, #1
    mov x2, #4
    mov x8, #64
    svc #0
    b _pb_nl
_pb_false:
    adrp x1, _false_str
    add x1, x1, :lo12:_false_str
    mov x0, #1
    mov x2, #5
    mov x8, #64
    svc #0
_pb_nl:
    adrp x1, _newline
    add x1, x1, :lo12:_newline
    mov x0, #1
    mov x2, #1
    mov x8, #64
    svc #0
_pb_end:
    ldp x29, x30, [sp], #16
    ret

print_string:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    mov x1, x0
    mov x0, #1
    mov x2, #0
_ps_len_loop:
    ldrb w3, [x1, x2]
    cbz w3, _ps_print
    add x2, x2, #1
    b _ps_len_loop
_ps_print:
    mov x8, #64
    svc #0
    adrp x1, _newline
    add x1, x1, :lo12:_newline
    mov x0, #1
    mov x2, #1
    mov x8, #64
    svc #0
    ldp x29, x30, [sp], #16
    ret

print_rune:
    stp x29, x30, [sp, #-32]!
    mov x29, sp
    str x19, [sp, #16]
    mov w19, w0
    and w19, w19, #0xFF
    cbz w19, _pr_skip_char
    strb w19, [sp, #24]
    mov x0, #1
    add x1, sp, #24
    mov x2, #1
    mov x8, #64
    svc #0
_pr_skip_char:
    adrp x1, _newline
    add x1, x1, :lo12:_newline
    mov x0, #1
    mov x2, #1
    mov x8, #64
    svc #0
    ldr x19, [sp, #16]
    ldp x29, x30, [sp], #32
    ret

print_space:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    adrp x1, _space_ch
    add x1, x1, :lo12:_space_ch
    mov x0, #1
    mov x2, #1
    mov x8, #64
    svc #0
    ldp x29, x30, [sp], #16
    ret

print_newline:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    adrp x1, _newline
    add x1, x1, :lo12:_newline
    mov x0, #1
    mov x2, #1
    mov x8, #64
    svc #0
    ldp x29, x30, [sp], #16
    ret

print_int_inline:
    stp x29, x30, [sp, #-48]!
    mov x29, sp
    str x19, [sp, #16]
    str x20, [sp, #24]
    str x21, [sp, #32]
    mov x19, x0
    cmp x19, #0
    b.ge _pii_positive
    adrp x0, _int_buf
    add x0, x0, :lo12:_int_buf
    mov w1, #45
    strb w1, [x0]
    mov x1, x0
    mov x0, #1
    mov x2, #1
    mov x8, #64
    svc #0
    neg x19, x19
_pii_positive:
    adrp x20, _int_buf
    add x20, x20, :lo12:_int_buf
    mov x21, #0
    cmp x19, #0
    b.ne _pii_loop
    mov w1, #48
    strb w1, [x20]
    mov x1, x20
    mov x0, #1
    mov x2, #1
    mov x8, #64
    svc #0
    b _pii_done
_pii_loop:
    cbz x19, _pii_reverse
    mov x0, x19
    mov x1, #10
    udiv x2, x0, x1
    msub x3, x2, x1, x0
    add w3, w3, #48
    strb w3, [x20, x21]
    add x21, x21, #1
    mov x19, x2
    b _pii_loop
_pii_reverse:
    mov x0, #0
    sub x1, x21, #1
_pii_rev_loop:
    cmp x0, x1
    b.ge _pii_print
    ldrb w2, [x20, x0]
    ldrb w3, [x20, x1]
    strb w3, [x20, x0]
    strb w2, [x20, x1]
    add x0, x0, #1
    sub x1, x1, #1
    b _pii_rev_loop
_pii_print:
    mov x1, x20
    mov x0, #1
    mov x2, x21
    mov x8, #64
    svc #0
_pii_done:
    ldr x19, [sp, #16]
    ldr x20, [sp, #24]
    ldr x21, [sp, #32]
    ldp x29, x30, [sp], #48
    ret

print_bool_inline:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    cmp x0, #0
    b.eq _pbi_false
    adrp x1, _true_str
    add x1, x1, :lo12:_true_str
    mov x0, #1
    mov x2, #4
    mov x8, #64
    svc #0
    b _pbi_end
_pbi_false:
    adrp x1, _false_str
    add x1, x1, :lo12:_false_str
    mov x0, #1
    mov x2, #5
    mov x8, #64
    svc #0
_pbi_end:
    ldp x29, x30, [sp], #16
    ret

print_rune_inline:
    stp x29, x30, [sp, #-32]!
    mov x29, sp
    str x19, [sp, #16]
    mov w19, w0
    and w19, w19, #0xFF
    cbz w19, _pri_skip_char
    strb w19, [sp, #24]
    mov x0, #1
    add x1, sp, #24
    mov x2, #1
    mov x8, #64
    svc #0
_pri_skip_char:
    ldr x19, [sp, #16]
    ldp x29, x30, [sp], #32
    ret

print_string_inline:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    mov x1, x0
    mov x0, #1
    mov x2, #0
_psi_len_loop:
    ldrb w3, [x1, x2]
    cbz w3, _psi_print
    add x2, x2, #1
    b _psi_len_loop
_psi_print:
    mov x8, #64
    svc #0
    ldp x29, x30, [sp], #16
    ret

print_float:
    stp x29, x30, [sp, #-64]!
    mov x29, sp
    str x19, [sp, #16]
    str x20, [sp, #24]
    str x21, [sp, #32]
    mov x19, x0
    cmp x19, #0
    b.ge _pf_positive
    mov x9, #45
    str x9, [sp, #48]
    mov x0, #1
    add x1, sp, #48
    mov x2, #1
    mov x8, #64
    svc #0
    neg x19, x19
_pf_positive:
    mov x1, #1000
    udiv x20, x19, x1
    msub x21, x20, x1, x19
    mov x0, x20
    bl   print_int_inline
    mov x9, #46
    str x9, [sp, #48]
    mov x0, #1
    add x1, sp, #48
    mov x2, #1
    mov x8, #64
    svc #0
    mov x0, x21
    bl   _pf_print_decimal
    mov x9, #10
    str x9, [sp, #48]
    mov x0, #1
    add x1, sp, #48
    mov x2, #1
    mov x8, #64
    svc #0
    ldr x19, [sp, #16]
    ldr x20, [sp, #24]
    ldr x21, [sp, #32]
    ldp x29, x30, [sp], #64
    ret

_pf_print_decimal:
    stp x29, x30, [sp, #-64]!
    mov x29, sp
    str x19, [sp, #16]
    str x20, [sp, #24]
    str x21, [sp, #32]
    mov x19, x0
    mov x1, #100
    udiv x20, x19, x1
    msub x21, x20, x1, x19
    mov x1, #10
    udiv x9, x21, x1
    msub x10, x9, x1, x21
    add x1, sp, #48
    add w2, w20, #48
    strb w2, [x1]
    add w3, w9, #48
    strb w3, [x1, #1]
    add w4, w10, #48
    strb w4, [x1, #2]
    mov x2, #1
    cbnz x9, _pfd_has2
    cbnz x10, _pfd_has2
    b    _pfd_print
_pfd_has2:
    mov x2, #2
    cbz x10, _pfd_print
    mov x2, #3
_pfd_print:
    mov x0, #1
    mov x8, #64
    svc #0
    ldr x19, [sp, #16]
    ldr x20, [sp, #24]
    ldr x21, [sp, #32]
    ldp x29, x30, [sp], #64
    ret

print_float_inline:
    stp x29, x30, [sp, #-64]!
    mov x29, sp
    str x19, [sp, #16]
    str x20, [sp, #24]
    str x21, [sp, #32]
    mov x19, x0
    cmp x19, #0
    b.ge _pfi_positive
    mov x9, #45
    str x9, [sp, #48]
    mov x0, #1
    add x1, sp, #48
    mov x2, #1
    mov x8, #64
    svc #0
    neg x19, x19
_pfi_positive:
    mov x1, #1000
    udiv x20, x19, x1
    msub x21, x20, x1, x19
    mov x0, x20
    bl   print_int_inline
    mov x9, #46
    str x9, [sp, #48]
    mov x0, #1
    add x1, sp, #48
    mov x2, #1
    mov x8, #64
    svc #0
    mov x0, x21
    bl   _pf_print_decimal
    ldr x19, [sp, #16]
    ldr x20, [sp, #24]
    ldr x21, [sp, #32]
    ldp x29, x30, [sp], #64
    ret

main:
    stp x29, x30, [sp, #-272]!
    mov x29, sp
    str  x19, [x29, #16]
    adrp x9, _str_1
    add  x9, x9, :lo12:_str_1
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_0
    bl   print_string
    b    _pok_0
_pnil_0:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_0:
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_2
    add  x9, x9, :lo12:_str_2
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_1
    bl   print_string
    b    _pok_1
_pnil_1:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_1:
    ldr  x19, [x29, #16]
    mov  x9, #42
    str  x9, [x29, #24]
    mov  x9, #3140
    str  x9, [x29, #32]
    mov  x9, #1
    str  x9, [x29, #40]
    mov  x9, #71
    str  x9, [x29, #48]
    adrp x9, _str_3
    add  x9, x9, :lo12:_str_3
    str  x9, [x29, #56]
    str  x19, [x29, #16]
    ldr  x9, [x29, #24]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    ldr  x9, [x29, #32]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_float_inline
    ldr  x9, [x29, #40]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool_inline
    ldr  x9, [x29, #48]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    ldr  x9, [x29, #56]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_2
    bl   print_string
    b    _pok_2
_pnil_2:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_2:
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_4
    add  x9, x9, :lo12:_str_4
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_3
    bl   print_string
    b    _pok_3
_pnil_3:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_3:
    ldr  x19, [x29, #16]
    mov  x9, #120
    str  x9, [x29, #24]
    mov  x9, #9750
    str  x9, [x29, #32]
    mov  x9, #0
    str  x9, [x29, #40]
    mov  x9, #90
    str  x9, [x29, #48]
    adrp x9, _str_5
    add  x9, x9, :lo12:_str_5
    str  x9, [x29, #56]
    str  x19, [x29, #16]
    ldr  x9, [x29, #24]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    ldr  x9, [x29, #32]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_float_inline
    ldr  x9, [x29, #40]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool_inline
    ldr  x9, [x29, #48]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    ldr  x9, [x29, #56]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_4
    bl   print_string
    b    _pok_4
_pnil_4:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_4:
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_6
    add  x9, x9, :lo12:_str_6
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_5
    bl   print_string
    b    _pok_5
_pnil_5:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_5:
    ldr  x19, [x29, #16]
    mov  x9, #1
    str  x9, [x29, #64]
    mov  x9, #2
    str  x9, [x29, #72]
    str  x19, [x29, #16]
    adrp x9, _str_7
    add  x9, x9, :lo12:_str_7
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_6
    bl   print_string_inline
    b    _pok_6
_pnil_6:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_6:
    ldr  x9, [x29, #64]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    ldr  x9, [x29, #72]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_8
    add  x9, x9, :lo12:_str_8
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_7
    bl   print_string
    b    _pok_7
_pnil_7:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_7:
    ldr  x19, [x29, #16]
    mov  x9, #7
    str  x9, [x29, #80]
    mov  x9, #2500
    str  x9, [x29, #88]
    mov  x9, #1
    str  x9, [x29, #96]
    mov  x9, #88
    str  x9, [x29, #104]
    adrp x9, _str_9
    add  x9, x9, :lo12:_str_9
    str  x9, [x29, #112]
    str  x19, [x29, #16]
    ldr  x9, [x29, #80]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    ldr  x9, [x29, #88]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_float_inline
    ldr  x9, [x29, #96]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool_inline
    ldr  x9, [x29, #104]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    ldr  x9, [x29, #112]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_8
    bl   print_string
    b    _pok_8
_pnil_8:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_8:
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_10
    add  x9, x9, :lo12:_str_10
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_9
    bl   print_string
    b    _pok_9
_pnil_9:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_9:
    ldr  x19, [x29, #16]
    mov  x9, #0
    str  x9, [x29, #120]
    mov  x9, #0
    str  x9, [x29, #128]
    mov  x9, #0
    str  x9, [x29, #136]
    mov  x9, #0
    str  x9, [x29, #144]
    adrp x9, _str_11
    add  x9, x9, :lo12:_str_11
    str  x9, [x29, #152]
    str  x19, [x29, #16]
    ldr  x9, [x29, #120]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    ldr  x9, [x29, #128]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_float_inline
    ldr  x9, [x29, #136]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool_inline
    ldr  x9, [x29, #144]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    ldr  x9, [x29, #152]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_10
    bl   print_string
    b    _pok_10
_pnil_10:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_10:
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_12
    add  x9, x9, :lo12:_str_12
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_11
    bl   print_string
    b    _pok_11
_pnil_11:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_11:
    ldr  x19, [x29, #16]
    mov  x9, #10
    str  x9, [x29, #160]
    mov  x9, #20
    str  x9, [x29, #168]
    adrp x9, _str_13
    add  x9, x9, :lo12:_str_13
    str  x9, [x29, #176]
    adrp x9, _str_14
    add  x9, x9, :lo12:_str_14
    str  x9, [x29, #184]
    str  x19, [x29, #16]
    ldr  x9, [x29, #160]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    ldr  x9, [x29, #168]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    ldr  x9, [x29, #176]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_12
    bl   print_string_inline
    b    _pok_12
_pnil_12:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_12:
    ldr  x9, [x29, #184]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_13
    bl   print_string
    b    _pok_13
_pnil_13:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_13:
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_15
    add  x9, x9, :lo12:_str_15
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_14
    bl   print_string
    b    _pok_14
_pnil_14:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_14:
    ldr  x19, [x29, #16]
    mov  x9, #3142
    str  x9, [x29, #192]
    mov  x9, #1000
    str  x9, [x29, #200]
    str  x19, [x29, #16]
    ldr  x9, [x29, #192]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_float_inline
    ldr  x9, [x29, #200]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_16
    add  x9, x9, :lo12:_str_16
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_15
    bl   print_string
    b    _pok_15
_pnil_15:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_15:
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_17
    add  x9, x9, :lo12:_str_17
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_16
    bl   print_string_inline
    b    _pok_16
_pnil_16:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_16:
    mov  x9, #0
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_18
    add  x9, x9, :lo12:_str_18
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_17
    bl   print_string_inline
    b    _pok_17
_pnil_17:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_17:
    mov  x9, #0
    mov  x10, #0
    cmp  x9, x10
    b.eq eq_t_19
    mov  x9, #0
    b    eq_e_20
eq_t_19:
    mov  x9, #1
eq_e_20:
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_19
    add  x9, x9, :lo12:_str_19
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_20
    bl   print_string
    b    _pok_20
_pnil_20:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_20:
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_20
    add  x9, x9, :lo12:_str_20
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_21
    bl   print_string_inline
    b    _pok_21
_pnil_21:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_21:
    mov  x9, #15
    mov  x14, #25
    add  x9, x9, x14
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_21
    add  x9, x9, :lo12:_str_21
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_22
    bl   print_string_inline
    b    _pok_22
_pnil_22:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_22:
    mov  x9, #50
    mov  x14, #18
    sub  x9, x9, x14
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_22
    add  x9, x9, :lo12:_str_22
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_23
    bl   print_string_inline
    b    _pok_23
_pnil_23:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_23:
    mov  x9, #7
    mov  x15, #8
    mul  x9, x9, x15
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_23
    add  x9, x9, :lo12:_str_23
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_24
    bl   print_string_inline
    b    _pok_24
_pnil_24:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_24:
    mov  x9, #100
    mov  x15, #3
    sdiv x9, x9, x15
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_24
    add  x9, x9, :lo12:_str_24
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_25
    bl   print_string_inline
    b    _pok_25
_pnil_25:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_25:
    mov  x9, #17
    mov  x15, #5
    sdiv x16, x9, x15
    msub x9, x16, x15, x9
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_25
    add  x9, x9, :lo12:_str_25
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_26
    bl   print_string
    b    _pok_26
_pnil_26:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_26:
    ldr  x19, [x29, #16]
    mov  x9, #10
    str  x9, [x29, #208]
    mov  x9, #20
    str  x9, [x29, #216]
    str  x19, [x29, #16]
    adrp x9, _str_26
    add  x9, x9, :lo12:_str_26
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_27
    bl   print_string_inline
    b    _pok_27
_pnil_27:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_27:
    ldr  x9, [x29, #208]
    ldr  x10, [x29, #216]
    cmp  x9, x10
    b.eq eq_t_29
    mov  x9, #0
    b    eq_e_30
eq_t_29:
    mov  x9, #1
eq_e_30:
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_27
    add  x9, x9, :lo12:_str_27
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_30
    bl   print_string_inline
    b    _pok_30
_pnil_30:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_30:
    ldr  x9, [x29, #208]
    ldr  x10, [x29, #216]
    cmp  x9, x10
    b.ne eq_t_32
    mov  x9, #0
    b    eq_e_33
eq_t_32:
    mov  x9, #1
eq_e_33:
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_28
    add  x9, x9, :lo12:_str_28
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_33
    bl   print_string_inline
    b    _pok_33
_pnil_33:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_33:
    ldr  x9, [x29, #208]
    ldr  x10, [x29, #216]
    cmp  x9, x10
    b.lt rel_t_35
    mov  x9, #0
    b    rel_e_36
rel_t_35:
    mov  x9, #1
rel_e_36:
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_29
    add  x9, x9, :lo12:_str_29
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_36
    bl   print_string_inline
    b    _pok_36
_pnil_36:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_36:
    ldr  x9, [x29, #208]
    ldr  x10, [x29, #216]
    cmp  x9, x10
    b.gt rel_t_38
    mov  x9, #0
    b    rel_e_39
rel_t_38:
    mov  x9, #1
rel_e_39:
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_30
    add  x9, x9, :lo12:_str_30
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_39
    bl   print_string
    b    _pok_39
_pnil_39:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_39:
    ldr  x19, [x29, #16]
    mov  x9, #1
    str  x9, [x29, #224]
    mov  x9, #0
    str  x9, [x29, #232]
    str  x19, [x29, #16]
    adrp x9, _str_31
    add  x9, x9, :lo12:_str_31
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_40
    bl   print_string_inline
    b    _pok_40
_pnil_40:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_40:
    ldr  x9, [x29, #224]
    cmp  x9, #0
    b.eq and_false_42
    ldr  x9, [x29, #232]
    b    and_end_43
and_false_42:
    mov  x9, #0
and_end_43:
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_32
    add  x9, x9, :lo12:_str_32
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_43
    bl   print_string_inline
    b    _pok_43
_pnil_43:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_43:
    ldr  x9, [x29, #224]
    cmp  x9, #0
    b.ne or_true_45
    ldr  x9, [x29, #232]
    b    or_end_46
or_true_45:
    mov  x9, #1
or_end_46:
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_33
    add  x9, x9, :lo12:_str_33
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_46
    bl   print_string_inline
    b    _pok_46
_pnil_46:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_46:
    ldr  x9, [x29, #224]
    cmp  x9, #0
    b.eq not_t_48
    mov  x9, #0
    b    not_e_49
not_t_48:
    mov  x9, #1
not_e_49:
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_34
    add  x9, x9, :lo12:_str_34
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_49
    bl   print_string
    b    _pok_49
_pnil_49:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_49:
    ldr  x19, [x29, #16]
    mov  x9, #0
    str  x9, [x29, #240]
    mov  x9, #0
    cmp  x9, #0
    b.eq and_false_51
    mov  x9, #100
    ldr  x15, [x29, #240]
    sdiv x9, x9, x15
    mov  x10, #1
    cmp  x9, x10
    b.eq eq_t_53
    mov  x9, #0
    b    eq_e_54
eq_t_53:
    mov  x9, #1
eq_e_54:
    b    and_end_52
and_false_51:
    mov  x9, #0
and_end_52:
    str  x9, [x29, #248]
    mov  x9, #1
    cmp  x9, #0
    b.ne or_true_55
    mov  x9, #100
    ldr  x15, [x29, #240]
    sdiv x9, x9, x15
    mov  x10, #1
    cmp  x9, x10
    b.eq eq_t_57
    mov  x9, #0
    b    eq_e_58
eq_t_57:
    mov  x9, #1
eq_e_58:
    b    or_end_56
or_true_55:
    mov  x9, #1
or_end_56:
    str  x9, [x29, #256]
    str  x19, [x29, #16]
    adrp x9, _str_35
    add  x9, x9, :lo12:_str_35
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_58
    bl   print_string_inline
    b    _pok_58
_pnil_58:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_58:
    ldr  x9, [x29, #248]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_36
    add  x9, x9, :lo12:_str_36
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_59
    bl   print_string_inline
    b    _pok_59
_pnil_59:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_59:
    ldr  x9, [x29, #256]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_37
    add  x9, x9, :lo12:_str_37
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_60
    bl   print_string
    b    _pok_60
_pnil_60:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_60:
    ldr  x19, [x29, #16]
    mov  x9, #50
    str  x9, [x29, #264]
    mov  x9, #10
    ldr  x14, [x29, #264]
    add  x9, x14, x9
    str  x9, [x29, #264]
    mov  x9, #5
    ldr  x14, [x29, #264]
    sub  x9, x14, x9
    str  x9, [x29, #264]
    mov  x9, #2
    ldr  x14, [x29, #264]
    mul  x9, x14, x9
    str  x9, [x29, #264]
    mov  x9, #5
    ldr  x14, [x29, #264]
    sdiv x9, x14, x9
    str  x9, [x29, #264]
    str  x19, [x29, #16]
    adrp x9, _str_38
    add  x9, x9, :lo12:_str_38
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_61
    bl   print_string_inline
    b    _pok_61
_pnil_61:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_61:
    ldr  x9, [x29, #264]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_39
    add  x9, x9, :lo12:_str_39
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_62
    bl   print_string
    b    _pok_62
_pnil_62:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string
_pok_62:
    ldr  x19, [x29, #16]
_ret_main:
    ldp x29, x30, [sp], #272
    ret


_start:
    bl main
    mov x0, #0
    mov x8, #93
    svc #0
