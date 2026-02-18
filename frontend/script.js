/* Utilidades */

function escribirConsola(texto) {
    const consola = document.getElementById("console");
    consola.innerText += "\n" + texto;
    consola.scrollTop = consola.scrollHeight;
}

function limpiarConsola() {
    document.getElementById("console").innerText = "";
}

function nuevo() {
    document.getElementById("editor").value = "";
    limpiarConsola();
    actualizarLineas();
}

/* Cargar archivo */

function cargarArchivo(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById("editor").value = e.target.result;
    };
    reader.readAsText(file);
}

/*Guardar código */

function guardarCodigo() {
    const contenido = document.getElementById("editor").value;
    const blob = new Blob([contenido], { type: "text/plain" });
    const enlace = document.createElement("a");
    enlace.href = URL.createObjectURL(blob);
    enlace.download = "codigo.golampi";
    enlace.click();
}

/* Ejecutar / Analizar */

function ejecutar() {
    limpiarConsola();
    escribirConsola("Enviando código al servidor...");

    const codigo = document.getElementById("editor").value;

    fetch("../backend/Execute.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
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

        // Guardar para reportes
        window.reporteResultado = data.salida || "";
        window.reporteErrores = data.errores || "";
        window.reporteSimbolos = data.simbolos || "";
    })
}

/* Números de línea  */

function sincronizarScroll() {
    const editor = document.getElementById("editor");
    const lineNumbers = document.getElementById("lineNumbers");
    lineNumbers.scrollTop = editor.scrollTop;
}

function actualizarLineas() {
    const editor = document.getElementById("editor");
    const lineNumbers = document.getElementById("lineNumbers");
    const totalLineas = editor.value.split("\n").length;

    let numeros = "";
    for (let i = 1; i <= totalLineas; i++) {
        numeros += i + "\n";
    }

    lineNumbers.textContent = numeros;
}


/*  Descargas */

function descargarTexto(nombre, contenido) {
    const blob = new Blob([contenido], { type: "text/plain" });
    const enlace = document.createElement("a");
    enlace.href = URL.createObjectURL(blob);
    enlace.download = nombre;
    enlace.click();
}

function descargarResultado() {
    descargarTexto("resultado.txt", window.reporteResultado || "");
}

function descargarErrores() {
    descargarTexto("errores.txt", window.reporteErrores || "");
}

function descargarSimbolos() {
    descargarTexto("tabla_simbolos.txt", window.reporteSimbolos || "");
}

window.onload = actualizarLineas;