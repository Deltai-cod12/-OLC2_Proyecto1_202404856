# Código ARM64 generado por Golampi Compiler
# Arquitectura: AArch64 (ARM64)

.section .data
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
    stp x29, x30, [sp, #-32]!
    mov x29, sp
    mov  x9, #11
    str  x9, [x29, #24]
    str  x19, [x29, #16]
    ldr  x9, [x29, #24]
    mov  x17, x9
    mov  x14, #5
    mov  x15, #10
    cmp  x17, x14
    b.lt in_f_2
    cmp  x17, x15
    b.gt in_f_2
    mov  x9, #1
    b    in_e_3
in_f_2:
    mov  x9, #0
in_e_3:
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool
    ldr  x19, [x29, #16]
    str  x19, [x29, #16]
    ldr  x9, [x29, #24]
    mov  x17, x9
    mov  x14, #11
    mov  x15, #12
    cmp  x17, x14
    b.lt notin_t_4
    cmp  x17, x15
    b.gt notin_t_4
    mov  x9, #0
    b    notin_e_6
notin_t_4:
    mov  x9, #1
notin_e_6:
    str  x9, [x29, #16]
    ldr  x0, [x29, #16]
    bl   print_bool
    ldr  x19, [x29, #16]
_ret_main:
    ldp x29, x30, [sp], #32
    ret


_start:
    bl main
    mov x0, #0
    mov x8, #93
    svc #0
