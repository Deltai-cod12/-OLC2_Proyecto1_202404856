/**
 * script.js — Frontend del Golampi Compiler (ARM64)
 * Comunica con backend/ExecuteArm.php
 */

// ── Estado global ─────────────────────────────────────────────────────────────
const state = {
    assembly : '',
    errors   : [],
    symbols  : [],
};

// ── Referencias DOM ───────────────────────────────────────────────────────────
const codeEditor     = document.getElementById('code-editor');
const lineNumbers    = document.getElementById('line-numbers');
const consoleOutput  = document.getElementById('console-output');
const statusIndicator= document.getElementById('status-indicator');

const btnNew         = document.getElementById('btn-new');
const btnLoad        = document.getElementById('btn-load');
const fileInput      = document.getElementById('file-input');
const btnSave        = document.getElementById('btn-save');
const btnCompile     = document.getElementById('btn-compile');
const btnClearConsole= document.getElementById('btn-clear-console');

const btnErrors      = document.getElementById('btn-errors');
const btnSymbols     = document.getElementById('btn-symbols');
const btnDownloadAsm = document.getElementById('btn-download-asm');

const modalOverlay   = document.getElementById('modal-overlay');
const modalTitle     = document.getElementById('modal-title');
const modalBody      = document.getElementById('modal-body');
const modalClose     = document.getElementById('modal-close');

// ── Números de línea ──────────────────────────────────────────────────────────
function updateLineNumbers() {
    const lines = codeEditor.value.split('\n').length;
    lineNumbers.textContent = Array.from({length: lines}, (_, i) => i + 1).join('\n');
}

codeEditor.addEventListener('input', updateLineNumbers);
codeEditor.addEventListener('scroll', () => {
    lineNumbers.scrollTop = codeEditor.scrollTop;
});

// Tab → 4 espacios
codeEditor.addEventListener('keydown', (e) => {
    if (e.key === 'Tab') {
        e.preventDefault();
        const start = codeEditor.selectionStart;
        const end   = codeEditor.selectionEnd;
        codeEditor.value = codeEditor.value.substring(0, start) + '    ' + codeEditor.value.substring(end);
        codeEditor.selectionStart = codeEditor.selectionEnd = start + 4;
        updateLineNumbers();
    }
});

updateLineNumbers();

// ── Botón: Nuevo ─────────────────────────────────────────────────────────────
btnNew.addEventListener('click', () => {
    if (codeEditor.value.trim() !== '' &&
        !confirm('¿Limpiar el editor y la consola?')) return;
    codeEditor.value = '';
    clearConsole();
    resetReportButtons();
    updateLineNumbers();
    setStatus('idle');
});

// ── Botón: Cargar ─────────────────────────────────────────────────────────────
btnLoad.addEventListener('click', () => fileInput.click());
fileInput.addEventListener('change', () => {
    const file = fileInput.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        codeEditor.value = e.target.result;
        updateLineNumbers();
        clearConsole();
        resetReportButtons();
    };
    reader.readAsText(file);
    fileInput.value = '';
});

// ── Botón: Guardar ────────────────────────────────────────────────────────────
btnSave.addEventListener('click', () => {
    downloadText(codeEditor.value, 'programa.s', 'text/plain');
});

// ── Botón: Compilar ───────────────────────────────────────────────────────────
btnCompile.addEventListener('click', async () => {
    const code = codeEditor.value.trim();
    if (!code) {
        showConsoleMessage('// Error: El editor está vacío.', 'error');
        return;
    }

    setStatus('loading');
    clearConsole();
    resetReportButtons();
    btnCompile.disabled = true;
    showConsoleMessage('// Compilando a ARM64...', 'info');

    try {
        const response = await fetch('../backend/ExecuteArm.php', {
            method : 'POST',
            headers: { 'Content-Type': 'application/json' },
            body   : JSON.stringify({ code }),
        });

        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }

        const result = await response.json();

        state.assembly = result.assembly  || '';
        state.errors   = result.errors    || [];
        state.symbols  = result.symbols   || [];

        // Mostrar código ARM64 en consola
        consoleOutput.textContent = state.assembly
            ? state.assembly
            : '// No se generó código ARM64.';

        // Habilitar reportes
        enableReportButtons();

        // Estado visual
        if (result.success) {
            setStatus('ok');
            consoleOutput.style.color = '#8be9fd';
        } else {
            setStatus('error');
            consoleOutput.style.color = '#f8d7da';
            if (state.errors.length > 0 && !state.assembly) {
                consoleOutput.textContent =
                    `// Compilación fallida con ${state.errors.length} error(es).\n` +
                    `// Revise el Reporte de Errores para más detalles.\n\n` +
                    (result.assembly || '');
            }
        }

    } catch (err) {
        setStatus('error');
        showConsoleMessage(`// Error de conexión: ${err.message}`, 'error');
    } finally {
        btnCompile.disabled = false;
    }
});

// ── Botón: Limpiar consola ────────────────────────────────────────────────────
btnClearConsole.addEventListener('click', clearConsole);

// ── Botones de reporte ────────────────────────────────────────────────────────
btnErrors.addEventListener('click', () => {
    const html = buildErrorTable(state.errors);
    openModal('⚠ Reporte de Errores', html);
});

btnSymbols.addEventListener('click', () => {
    const html = buildSymbolTable(state.symbols);
    openModal('☰ Tabla de Símbolos', html);
});

btnDownloadAsm.addEventListener('click', () => {
    if (state.assembly) {
        downloadText(state.assembly, 'programa.s', 'text/plain');
    }
});

// ── Modal ─────────────────────────────────────────────────────────────────────
modalClose.addEventListener('click', closeModal);
modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay) closeModal();
});
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
});

function openModal(title, html) {
    modalTitle.textContent = title;
    modalBody.innerHTML    = html;
    modalOverlay.classList.remove('hidden');
}

function closeModal() {
    modalOverlay.classList.add('hidden');
}

// ── Tablas de reporte ─────────────────────────────────────────────────────────
function buildErrorTable(errors) {
    if (!errors || errors.length === 0) {
        return '<p style="color:var(--accent-2);padding:12px">✓ No se encontraron errores.</p>';
    }
    let html = '<table><thead><tr>'
        + '<th>#</th><th>Tipo</th><th>Descripción</th><th>Línea</th><th>Columna</th>'
        + '</tr></thead><tbody>';
    errors.forEach((e, i) => {
        const color = e.type === 'Léxico' ? '#f85149'
                    : e.type === 'Sintáctico' ? '#d29922'
                    : '#8be9fd';
        html += `<tr>
            <td>${i + 1}</td>
            <td style="color:${color};font-weight:700">${esc(e.type)}</td>
            <td>${esc(e.description)}</td>
            <td>${e.line}</td>
            <td>${e.column}</td>
        </tr>`;
    });
    html += '</tbody></table>';
    return html;
}

function buildSymbolTable(symbols) {
    if (!symbols || symbols.length === 0) {
        return '<p style="color:var(--text-muted);padding:12px">La tabla de símbolos está vacía.</p>';
    }
    let html = '<table><thead><tr>'
        + '<th>Identificador</th><th>Tipo</th><th>Ámbito</th><th>Valor</th><th>Línea</th><th>Columna</th>'
        + '</tr></thead><tbody>';
    symbols.forEach((s) => {
        html += `<tr>
            <td style="color:var(--accent)">${esc(s.identifier)}</td>
            <td style="color:var(--accent-2)">${esc(s.type)}</td>
            <td>${esc(s.scope)}</td>
            <td>${esc(s.value)}</td>
            <td>${s.line}</td>
            <td>${s.column}</td>
        </tr>`;
    });
    html += '</tbody></table>';
    return html;
}

// ── Utilidades ────────────────────────────────────────────────────────────────
function clearConsole() {
    consoleOutput.textContent = '// El código ARM64 generado aparecerá aquí después de compilar...';
    consoleOutput.style.color = '#8be9fd';
}

function showConsoleMessage(msg, type = 'info') {
    consoleOutput.textContent = msg;
    consoleOutput.style.color = type === 'error' ? 'var(--accent-err)' : 'var(--text-muted)';
}

function setStatus(status) {
    statusIndicator.className = 'status-' + status;
    statusIndicator.textContent = '●';
}

function enableReportButtons() {
    btnErrors.disabled      = false;
    btnSymbols.disabled     = false;
    btnDownloadAsm.disabled = !state.assembly;
}

function resetReportButtons() {
    btnErrors.disabled      = true;
    btnSymbols.disabled     = true;
    btnDownloadAsm.disabled = true;
    state.assembly = '';
    state.errors   = [];
    state.symbols  = [];
}

function downloadText(content, filename, mime) {
    const blob = new Blob([content], { type: mime });
    const url  = URL.createObjectURL(blob);
    const a    = document.createElement('a');
    a.href     = url;
    a.download = filename;
    a.click();
    URL.revokeObjectURL(url);
}

function esc(str) {
    if (str == null) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}