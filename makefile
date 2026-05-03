# ==========================================
# Makefile — Compilador Golampi → ARM64
# ==========================================

# Herramientas
AS      = aarch64-linux-gnu-as
LD      = aarch64-linux-gnu-ld
QEMU    = qemu-aarch64-static

# Archivos
SRC     = Pruebas.s
OBJ     = Pruebas.o
TARGET  = programa_arm

# Flags
ASFLAGS = -g

# Regla principal
all: $(TARGET)
	@echo ""
	@echo "Compilacion exitosa"
	@echo "Ejecuta: make run"
	@echo ""

# Ensamblar
$(OBJ): $(SRC)
	$(AS) $(ASFLAGS) -o $(OBJ) $(SRC)

# Enlazar
$(TARGET): $(OBJ)
	$(LD) -o $(TARGET) $(OBJ)

# Ejecutar con QEMU
run: $(TARGET)
	$(QEMU) ./$(TARGET)

# Flujo completo (por si quieres hacerlo en un solo comando)
full:
	make clean
	make all
	make run

# Limpiar
clean:
	rm -f $(OBJ) $(TARGET)
	@echo "Limpieza completada"

.PHONY: all run clean full