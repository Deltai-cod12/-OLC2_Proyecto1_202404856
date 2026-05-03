# Código ARM64 generado por Golampi Compiler
# Arquitectura: AArch64 (ARM64)

.section .data
_str_1: .ascii "=== INICIO DE CALIFICACION: ARREGLOS N-D ==="
    .byte 0
_str_2: .ascii "
--- 5.3 INDICE DE INESTABILIDAD ---"
    .byte 0
_str_3: .ascii "Indice:"
    .byte 0
_str_4: .ascii "
--- 5.4 REGLA DE CRAMER ---"
    .byte 0
_str_5: .ascii "x, y:"
    .byte 0
_str_6: .ascii "
--- 5.5 PROMEDIO DE CAPAS ---"
    .byte 0
_str_7: .ascii "Promedios capa 0:"
    .byte 0
_str_8: .ascii "Promedios capa 1:"
    .byte 0
_str_9: .ascii "
--- 5.6 SOFTMAX ---"
    .byte 0
_str_10: .ascii "Fila 0:"
    .byte 0
_str_11: .ascii "Fila 1:"
    .byte 0
_str_12: .ascii "
=== FIN DE CALIFICACION: ARREGLOS N-D ==="
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
    stp x29, x30, [sp, #-304]!
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
    mov  x9, #0
    str  x9, [x29, #24]
    mov  x9, #0
    str  x9, [x29, #32]
    mov  x9, #0
    str  x9, [x29, #40]
    mov  x9, #0
    str  x9, [x29, #48]
    mov  x9, #0
    str  x9, [x29, #56]
    mov  x9, #0
    str  x9, [x29, #64]
    mov  x9, #0
    str  x9, [x29, #72]
    mov  x9, #0
    str  x9, [x29, #80]
    mov  x9, #0
    str  x9, [x29, #88]
    mov  x9, #0
    str  x9, [x29, #96]
    mov  x9, #0
    str  x9, [x29, #104]
    mov  x9, #0
    str  x9, [x29, #112]
    mov  x9, #2
    str  x9, [x29, #24]
    mov  x9, #5
    str  x9, [x29, #32]
    mov  x9, #3
    str  x9, [x29, #40]
    mov  x9, #8
    str  x9, [x29, #48]
    mov  x9, #1
    str  x9, [x29, #56]
    mov  x9, #1
    str  x9, [x29, #64]
    mov  x9, #4
    str  x9, [x29, #72]
    mov  x9, #6
    str  x9, [x29, #80]
    mov  x9, #7
    str  x9, [x29, #88]
    mov  x9, #3
    str  x9, [x29, #96]
    mov  x9, #9
    str  x9, [x29, #104]
    mov  x9, #9
    str  x9, [x29, #112]
    str  x19, [x29, #16]
    adrp x9, _str_3
    add  x9, x9, :lo12:_str_3
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_2
    bl   print_string_inline
    b    _pok_2
_pnil_2:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_2:
    ldr  x0, [x29, #24]
    bl   indiceInestabilidad
    mov  x9, x0
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int
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
    mov  x9, #0
    str  x9, [x29, #120]
    mov  x9, #0
    str  x9, [x29, #128]
    mov  x9, #0
    str  x9, [x29, #136]
    mov  x9, #0
    str  x9, [x29, #144]
    mov  x9, #2
    str  x9, [x29, #120]
    mov  x9, #1
    str  x9, [x29, #128]
    mov  x9, #1
    str  x9, [x29, #136]
    mov  x9, #3
    str  x9, [x29, #144]
    mov  x9, #0
    str  x9, [x29, #152]
    mov  x9, #0
    str  x9, [x29, #160]
    mov  x9, #5
    str  x9, [x29, #152]
    mov  x9, #6
    str  x9, [x29, #160]
    ldr  x0, [x29, #120]
    ldr  x1, [x29, #152]
    bl   reglaCramer
    mov  x9, x0
    str  x9, [x29, #168]
    str  x19, [x29, #16]
    adrp x9, _str_5
    add  x9, x9, :lo12:_str_5
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_4
    bl   print_string_inline
    b    _pok_4
_pnil_4:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_4:
    add  x11, x29, #168
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    add  x11, x29, #168
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int
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
    mov  x9, #0
    str  x9, [x29, #176]
    mov  x9, #0
    str  x9, [x29, #184]
    mov  x9, #0
    str  x9, [x29, #192]
    mov  x9, #0
    str  x9, [x29, #200]
    mov  x9, #0
    str  x9, [x29, #208]
    mov  x9, #0
    str  x9, [x29, #216]
    mov  x9, #0
    str  x9, [x29, #224]
    mov  x9, #0
    str  x9, [x29, #232]
    mov  x9, #1
    str  x9, [x29, #176]
    mov  x9, #3
    str  x9, [x29, #184]
    mov  x9, #5
    str  x9, [x29, #192]
    mov  x9, #7
    str  x9, [x29, #200]
    mov  x9, #2
    str  x9, [x29, #208]
    mov  x9, #4
    str  x9, [x29, #216]
    mov  x9, #6
    str  x9, [x29, #224]
    mov  x9, #8
    str  x9, [x29, #232]
    ldr  x0, [x29, #176]
    bl   promedioCapas
    mov  x9, x0
    str  x9, [x29, #240]
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
    add  x11, x29, #240
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    add  x11, x29, #240
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
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
    bl   print_string_inline
    b    _pok_7
_pnil_7:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_7:
    add  x11, x29, #240
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    add  x11, x29, #240
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_9
    add  x9, x9, :lo12:_str_9
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
    mov  x9, #0
    str  x9, [x29, #248]
    mov  x9, #0
    str  x9, [x29, #256]
    mov  x9, #0
    str  x9, [x29, #264]
    mov  x9, #0
    str  x9, [x29, #272]
    mov  x9, #0
    str  x9, [x29, #280]
    mov  x9, #0
    str  x9, [x29, #288]
    mov  x9, #1000
    str  x9, [x29, #248]
    mov  x9, #2000
    str  x9, [x29, #256]
    mov  x9, #3000
    str  x9, [x29, #264]
    mov  x9, #4000
    str  x9, [x29, #272]
    mov  x9, #2000
    str  x9, [x29, #280]
    mov  x9, #1000
    str  x9, [x29, #288]
    ldr  x0, [x29, #248]
    bl   softmax
    mov  x9, x0
    str  x9, [x29, #296]
    str  x19, [x29, #16]
    adrp x9, _str_10
    add  x9, x9, :lo12:_str_10
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_9
    bl   print_string_inline
    b    _pok_9
_pnil_9:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_9:
    add  x11, x29, #296
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    add  x11, x29, #296
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    add  x11, x29, #296
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #2
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    adrp x9, _str_11
    add  x9, x9, :lo12:_str_11
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    cbz  x0, _pnil_10
    bl   print_string_inline
    b    _pok_10
_pnil_10:
    adrp x0, _nil_str
    add  x0, x0, :lo12:_nil_str
    bl   print_string_inline
_pok_10:
    add  x11, x29, #296
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    add  x11, x29, #296
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int_inline
    add  x11, x29, #296
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #2
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    str  x9, [x29, #16]
    bl   print_space
    ldr  x9, [x29, #16]
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_int
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
_ret_main:
    ldp x29, x30, [sp], #304
    ret

indiceInestabilidad:
    stp x29, x30, [sp, #-64]!
    mov x29, sp
    str  x0, [x29, #24]
    mov  x9, #0
    str  x9, [x29, #32]
    mov  x9, #0
    str  x9, [x29, #40]
for_start_13:
    ldr  x9, [x29, #40]
    mov  x10, #3
    cmp  x9, x10
    b.lt rel_t_16
    mov  x9, #0
    b    rel_e_17
rel_t_16:
    mov  x9, #1
rel_e_17:
    cmp  x9, #0
    b.eq for_end_14
    mov  x9, #1
    str  x9, [x29, #48]
for_start_18:
    ldr  x9, [x29, #48]
    mov  x10, #4
    cmp  x9, x10
    b.lt rel_t_21
    mov  x9, #0
    b    rel_e_22
rel_t_21:
    mov  x9, #1
rel_e_22:
    cmp  x9, #0
    b.eq for_end_19
    add  x11, x29, #24
    ldr  x12, [x29, #40]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x12, [x29, #48]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    add  x11, x29, #24
    ldr  x12, [x29, #40]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x12, [x29, #48]
    mov  x10, #1
    sub  x12, x12, x10
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x10, [x11]
    sub  x9, x9, x10
    str  x9, [x29, #56]
    ldr  x9, [x29, #56]
    mov  x10, #0
    cmp  x9, x10
    b.lt rel_t_25
    mov  x9, #0
    b    rel_e_26
rel_t_25:
    mov  x9, #1
rel_e_26:
    cmp  x9, #0
    b.eq else_23
    ldr  x9, [x29, #56]
    neg  x9, x9
    str  x9, [x29, #56]
    b    end_if_24
else_23:
end_if_24:
    ldr  x9, [x29, #56]
    ldr  x10, [x29, #32]
    add  x9, x10, x9
    str  x9, [x29, #32]
for_cont_20:
    ldr  x9, [x29, #48]
    add  x9, x9, #1
    str  x9, [x29, #48]
    b    for_start_18
for_end_19:
for_cont_15:
    ldr  x9, [x29, #40]
    add  x9, x9, #1
    str  x9, [x29, #40]
    b    for_start_13
for_end_14:
    ldr  x9, [x29, #32]
    mov  x0, x9
    b    _ret_indiceInestabilidad
_ret_indiceInestabilidad:
    ldp x29, x30, [sp], #64
    ret

reglaCramer:
    stp x29, x30, [sp, #-80]!
    mov x29, sp
    str  x0, [x29, #24]
    str  x1, [x29, #32]
    mov  x9, #0
    str  x9, [x29, #40]
    add  x11, x29, #24
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    add  x11, x29, #24
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x10, [x11]
    mul  x9, x9, x10
    add  x11, x29, #24
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x10, [x11]
    add  x11, x29, #24
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x10, [x11]
    mul  x10, x10, x10
    sub  x9, x9, x10
    str  x9, [x29, #48]
    ldr  x9, [x29, #48]
    mov  x10, #0
    cmp  x9, x10
    b.eq eq_t_29
    mov  x9, #0
    b    eq_e_30
eq_t_29:
    mov  x9, #1
eq_e_30:
    cmp  x9, #0
    b.eq else_27
    ldr  x9, [x29, #40]
    mov  x0, x9
    b    _ret_reglaCramer
    b    end_if_28
else_27:
end_if_28:
    add  x11, x29, #32
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    add  x11, x29, #24
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x10, [x11]
    mul  x9, x9, x10
    add  x11, x29, #24
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x10, [x11]
    add  x11, x29, #32
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x10, [x11]
    mul  x10, x10, x10
    sub  x9, x9, x10
    str  x9, [x29, #56]
    add  x11, x29, #24
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    add  x11, x29, #32
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x10, [x11]
    mul  x9, x9, x10
    add  x11, x29, #32
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x10, [x11]
    add  x11, x29, #24
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x10, [x11]
    mul  x10, x10, x10
    sub  x9, x9, x10
    str  x9, [x29, #64]
    add  x11, x29, #40
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x29, #56]
    ldr  x10, [x29, #48]
    sdiv x9, x9, x10
    str  x9, [x11]
    add  x11, x29, #40
    mov  x12, #1
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x29, #64]
    ldr  x10, [x29, #48]
    sdiv x9, x9, x10
    str  x9, [x11]
    ldr  x9, [x29, #40]
    mov  x0, x9
    b    _ret_reglaCramer
_ret_reglaCramer:
    ldp x29, x30, [sp], #80
    ret

promedioCapas:
    stp x29, x30, [sp, #-80]!
    mov x29, sp
    str  x0, [x29, #24]
    mov  x9, #0
    str  x9, [x29, #32]
    mov  x9, #0
    str  x9, [x29, #40]
for_start_31:
    ldr  x9, [x29, #40]
    mov  x10, #2
    cmp  x9, x10
    b.lt rel_t_34
    mov  x9, #0
    b    rel_e_35
rel_t_34:
    mov  x9, #1
rel_e_35:
    cmp  x9, #0
    b.eq for_end_32
    mov  x9, #0
    str  x9, [x29, #48]
for_start_36:
    ldr  x9, [x29, #48]
    mov  x10, #2
    cmp  x9, x10
    b.lt rel_t_39
    mov  x9, #0
    b    rel_e_40
rel_t_39:
    mov  x9, #1
rel_e_40:
    cmp  x9, #0
    b.eq for_end_37
    mov  x9, #0
    str  x9, [x29, #56]
    mov  x9, #0
    str  x9, [x29, #64]
for_start_41:
    ldr  x9, [x29, #64]
    mov  x10, #2
    cmp  x9, x10
    b.lt rel_t_44
    mov  x9, #0
    b    rel_e_45
rel_t_44:
    mov  x9, #1
rel_e_45:
    cmp  x9, #0
    b.eq for_end_42
    add  x11, x29, #24
    ldr  x12, [x29, #40]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x12, [x29, #48]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x12, [x29, #64]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    ldr  x10, [x29, #56]
    add  x9, x10, x9
    str  x9, [x29, #56]
for_cont_43:
    ldr  x9, [x29, #64]
    add  x9, x9, #1
    str  x9, [x29, #64]
    b    for_start_41
for_end_42:
    add  x11, x29, #32
    ldr  x12, [x29, #40]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x12, [x29, #48]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x29, #56]
    mov  x10, #2000
    sdiv x9, x9, x10
    str  x9, [x11]
for_cont_38:
    ldr  x9, [x29, #48]
    add  x9, x9, #1
    str  x9, [x29, #48]
    b    for_start_36
for_end_37:
for_cont_33:
    ldr  x9, [x29, #40]
    add  x9, x9, #1
    str  x9, [x29, #40]
    b    for_start_31
for_end_32:
    ldr  x9, [x29, #32]
    mov  x0, x9
    b    _ret_promedioCapas
_ret_promedioCapas:
    ldp x29, x30, [sp], #80
    ret

softmax:
    stp x29, x30, [sp, #-96]!
    mov x29, sp
    str  x0, [x29, #24]
    mov  x9, #0
    str  x9, [x29, #32]
    mov  x9, #0
    str  x9, [x29, #40]
for_start_46:
    ldr  x9, [x29, #40]
    mov  x10, #2
    cmp  x9, x10
    b.lt rel_t_49
    mov  x9, #0
    b    rel_e_50
rel_t_49:
    mov  x9, #1
rel_e_50:
    cmp  x9, #0
    b.eq for_end_47
    add  x11, x29, #24
    ldr  x12, [x29, #40]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    mov  x12, #0
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    str  x9, [x29, #48]
    mov  x9, #1
    str  x9, [x29, #56]
for_start_51:
    ldr  x9, [x29, #56]
    mov  x10, #3
    cmp  x9, x10
    b.lt rel_t_54
    mov  x9, #0
    b    rel_e_55
rel_t_54:
    mov  x9, #1
rel_e_55:
    cmp  x9, #0
    b.eq for_end_52
    add  x11, x29, #24
    ldr  x12, [x29, #40]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x12, [x29, #56]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    ldr  x10, [x29, #48]
    cmp  x9, x10
    b.gt rel_t_58
    mov  x9, #0
    b    rel_e_59
rel_t_58:
    mov  x9, #1
rel_e_59:
    cmp  x9, #0
    b.eq else_56
    add  x11, x29, #24
    ldr  x12, [x29, #40]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x12, [x29, #56]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    str  x9, [x29, #48]
    b    end_if_57
else_56:
end_if_57:
for_cont_53:
    ldr  x9, [x29, #56]
    add  x9, x9, #1
    str  x9, [x29, #56]
    b    for_start_51
for_end_52:
    mov  x9, #0
    str  x9, [x29, #64]
    mov  x9, #0
    str  x9, [x29, #72]
    mov  x9, #0
    str  x9, [x29, #56]
for_start_60:
    ldr  x9, [x29, #56]
    mov  x10, #3
    cmp  x9, x10
    b.lt rel_t_63
    mov  x9, #0
    b    rel_e_64
rel_t_63:
    mov  x9, #1
rel_e_64:
    cmp  x9, #0
    b.eq for_end_61
    mov  x9, #1000
    add  x11, x29, #24
    ldr  x12, [x29, #40]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x12, [x29, #56]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x10, [x11]
    ldr  x10, [x29, #48]
    sub  x10, x10, x10
    add  x9, x9, x10
    str  x9, [x29, #80]
    ldr  x9, [x29, #80]
    mov  x10, #100
    cmp  x9, x10
    b.lt rel_t_67
    mov  x9, #0
    b    rel_e_68
rel_t_67:
    mov  x9, #1
rel_e_68:
    cmp  x9, #0
    b.eq else_65
    mov  x9, #100
    str  x9, [x29, #80]
    b    end_if_66
else_65:
end_if_66:
    add  x11, x29, #72
    ldr  x12, [x29, #56]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x29, #80]
    str  x9, [x11]
    ldr  x9, [x29, #80]
    ldr  x10, [x29, #64]
    add  x9, x10, x9
    str  x9, [x29, #64]
for_cont_62:
    ldr  x9, [x29, #56]
    add  x9, x9, #1
    str  x9, [x29, #56]
    b    for_start_60
for_end_61:
    mov  x9, #0
    str  x9, [x29, #56]
for_start_69:
    ldr  x9, [x29, #56]
    mov  x10, #3
    cmp  x9, x10
    b.lt rel_t_72
    mov  x9, #0
    b    rel_e_73
rel_t_72:
    mov  x9, #1
rel_e_73:
    cmp  x9, #0
    b.eq for_end_70
    add  x11, x29, #32
    ldr  x12, [x29, #40]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x12, [x29, #56]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    add  x11, x29, #72
    ldr  x12, [x29, #56]
    mov  x13, #8
    mul  x12, x12, x13
    add  x11, x11, x12
    ldr  x9, [x11]
    ldr  x10, [x29, #64]
    sdiv x9, x9, x10
    str  x9, [x11]
for_cont_71:
    ldr  x9, [x29, #56]
    add  x9, x9, #1
    str  x9, [x29, #56]
    b    for_start_69
for_end_70:
for_cont_48:
    ldr  x9, [x29, #40]
    add  x9, x9, #1
    str  x9, [x29, #40]
    b    for_start_46
for_end_47:
    ldr  x9, [x29, #32]
    mov  x0, x9
    b    _ret_softmax
_ret_softmax:
    ldp x29, x30, [sp], #96
    ret


_start:
    bl main
    mov x0, #0
    mov x8, #93
    svc #0
