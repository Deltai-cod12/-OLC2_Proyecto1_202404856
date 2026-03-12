/* =========================================================
   Utilidades de consola
   ========================================================= */

function escribirConsola(texto) {
    const consola = document.getElementById("console");
    consola.innerText += "\n" + texto;
    consola.scrollTop = consola.scrollHeight;
}

function limpiarConsola() {
    document.getElementById("console").innerText = "";
}

/* =========================================================
   Editor
   ========================================================= */

function nuevo() {
    document.getElementById("editor").value = "";
    limpiarConsola();
    actualizarLineas();
}

function cargarArchivo(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById("editor").value = e.target.result;
        actualizarLineas();
    };
    reader.readAsText(file);
}

function guardarCodigo() {
    const contenido = document.getElementById("editor").value;
    descargarTexto("codigo.golampi", contenido);
}

/* =========================================================
   Ejecutar
   ========================================================= */

function ejecutar() {
    limpiarConsola();
    escribirConsola("Enviando código al servidor...");

    const codigo = document.getElementById("editor").value;

    fetch("../backend/Execute.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ codigo: codigo })
    })
    .then(response => response.json())
    .then(data => {

        escribirConsola("=== Salida ===");
        escribirConsola(data.salida || "Sin salida");

        if (data.errores && data.errores.trim() !== "") {
            escribirConsola("=== Error ===");
            escribirConsola(data.errores);
        }

        // Guardar para descargas
        window.reporteResultado  = data.salida        || "";
        window.reporteErrores    = data.errores        || "";
        window.reporteErroresTabla = data.erroresTabla || [];
        window.reporteSimbolos   = data.simbolos       || [];
        window.reporteTokens     = data.tokens         || [];
    })
    .catch(err => {
        escribirConsola("=== Error de conexión ===");
        escribirConsola(err.toString());
    });
}

/* =========================================================
   Números de línea
   ========================================================= */

function sincronizarScroll() {
    const editor      = document.getElementById("editor");
    const lineNumbers = document.getElementById("lineNumbers");
    lineNumbers.scrollTop = editor.scrollTop;
}

function actualizarLineas() {
    const editor      = document.getElementById("editor");
    const lineNumbers = document.getElementById("lineNumbers");
    const totalLineas = editor.value.split("\n").length;
    let numeros = "";
    for (let i = 1; i <= totalLineas; i++) numeros += i + "\n";
    lineNumbers.textContent = numeros;
}

/* =========================================================
   Helper genérico de descarga
   ========================================================= */

function descargarTexto(nombre, contenido) {
    const blob   = new Blob([contenido], { type: "text/plain" });
    const url    = URL.createObjectURL(blob);
    const enlace = document.createElement("a");
    enlace.href     = url;
    enlace.download = nombre;
    enlace.click();
    URL.revokeObjectURL(url);
}

/* =========================================================
   Descargar resultado
   ========================================================= */

function descargarResultado() {
    descargarTexto("resultado.txt", window.reporteResultado || "");
}

/* =========================================================
   Descargar tabla de errores
   ========================================================= */

function descargarErrores() {

    const errores = window.reporteErroresTabla || [];

    if (errores.length === 0) {
        descargarTexto("errores.txt", "No hay errores registrados.");
        return;
    }

    // Anchos fijos por columna
    const anchos = [14, 40, 8, 8];
    const cabeceras = ["Tipo", "Mensaje", "Línea", "Columna"];

    const col = (str, len) => String(str ?? "").padEnd(len).substring(0, len);
    const sep = anchos.map(n => "-".repeat(n)).join("+-") + "\n";

    let txt = "===== TABLA DE ERRORES =====\n\n";

    txt += sep;
    txt += cabeceras.map((h, i) => col(h, anchos[i])).join("| ") + "\n";
    txt += sep;

    errores.forEach(e => {
        txt +=
            col(e.type,    anchos[0]) + "| " +
            col(e.message, anchos[1]) + "| " +
            col(e.line,    anchos[2]) + "| " +
            col(e.column,  anchos[3]) + "\n";
    });

    txt += sep;
    txt += `Total: ${errores.length} error(es)\n`;

    descargarTexto("errores.txt", txt);
}

/* =========================================================
   Descargar tabla de símbolos
   ========================================================= */

function descargarSimbolos() {

    const simbolos = window.reporteSimbolos || [];

    if (simbolos.length === 0) {
        descargarTexto("tabla_simbolos.txt", "No hay símbolos registrados.");
        return;
    }

    // Anchos fijos por columna
    const anchos = [20, 14, 14, 22, 8, 8];
    const cabeceras = ["Identificador", "Tipo", "Ámbito", "Valor", "Línea", "Columna"];

    // Rellena/trunca un string al ancho dado
    const col = (str, len) => String(str ?? "").padEnd(len).substring(0, len);

    // Línea separadora
    const sep = anchos.map(n => "-".repeat(n)).join("+-") + "\n";

    let txt = "===== TABLA DE SÍMBOLOS =====\n\n";

    // Encabezado
    txt += sep;
    txt += cabeceras.map((h, i) => col(h, anchos[i])).join("| ") + "\n";
    txt += sep;

    // Filas
    simbolos.forEach(s => {
        txt +=
            col(s.identificador, anchos[0]) + "| " +
            col(s.tipo,          anchos[1]) + "| " +
            col(s.ambito,        anchos[2]) + "| " +
            col(s.valor,         anchos[3]) + "| " +
            col(s.linea,         anchos[4]) + "| " +
            col(s.columna,       anchos[5]) + "\n";
    });

    txt += sep;
    txt += `Total: ${simbolos.length} símbolo(s)\n`;

    descargarTexto("tabla_simbolos.txt", txt);
}

/* =========================================================
   Init
   ========================================================= */

window.onload = actualizarLineas;