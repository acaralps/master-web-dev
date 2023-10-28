// Función para calcular los totales
function calcularTotales() {
    const ingresosTable = document.getElementById("ingresosTable");
    const gastosTable = document.getElementById("gastosTable");

    let totalIngresos = 0;
    let totalGastos = 0;

    // Calcular los totales de ingresos
    for (let i = 1; i < ingresosTable.rows.length; i++) {
        const monto = parseFloat(ingresosTable.rows[i].cells[1].textContent.replace("$", "").trim()) || 0;
        totalIngresos += monto;
    }

    // Calcular los totales de gastos
    for (let i = 1; i < gastosTable.rows.length; i++) {
        const monto = parseFloat(gastosTable.rows[i].cells[1].textContent.replace("$", "").trim()) || 0;
        totalGastos += monto;
    }

    // Actualizar los campos de total gastos, total ingresos y saldo
    document.getElementById("totalGastos").textContent = "$" + totalGastos.toFixed(2);
    document.getElementById("totalIngresos").textContent = "$" + totalIngresos.toFixed(2);
    document.getElementById("saldo").textContent = "$" + (totalIngresos - totalGastos).toFixed(2);
}

// Agregar un escuchador de eventos input a las celdas de monto que no son editables
const montoCells = document.querySelectorAll("td[contenteditable='true']:not(.monto-editable)");
montoCells.forEach(function(cell) {
    cell.addEventListener("input", calcularTotales);
});

// Agregar un escuchador de eventos al elemento body
document.body.addEventListener("click", function(event) {
    if (event.target.classList.contains("eliminar-fila-ingreso")) {
        const ingresosTable = document.getElementById("ingresosTable");
        const row = event.target.closest("tr");
        ingresosTable.deleteRow(row.rowIndex);
        calcularTotales();
    }

    if (event.target.classList.contains("eliminar-fila-gasto")) {
        const gastosTable = document.getElementById("gastosTable");
        const row = event.target.closest("tr");
        gastosTable.deleteRow(row.rowIndex);
        calcularTotales();
    }
});

// Agregar fila a la tabla de ingresos
document.getElementById("agregarIngreso").addEventListener("click", function() {
    const ingresosTable = document.getElementById("ingresosTable");
    const newRow = ingresosTable.insertRow(ingresosTable.rows.length);

    const descripcionCell = newRow.insertCell(0);
    const montoCell = newRow.insertCell(1);
    const accionCell = newRow.insertCell(2);

    descripcionCell.innerHTML = "Nueva fila";
    montoCell.innerHTML = "$0";
    montoCell.setAttribute("contenteditable", "true");
    accionCell.innerHTML = '<button class="eliminar-fila-ingreso">Eliminar</button>';

    // Añadir el escuchador de eventos input a la nueva celda de monto
    montoCell.addEventListener("input", calcularTotales);
});

// Agregar fila a la tabla de gastos
document.getElementById("agregarGasto").addEventListener("click", function() {
    const gastosTable = document.getElementById("gastosTable");
    const newRow = gastosTable.insertRow(gastosTable.rows.length);

    const descripcionCell = newRow.insertCell(0);
    const montoCell = newRow.insertCell(1);
    const accionCell = newRow.insertCell(2);

    descripcionCell.innerHTML = "Nueva fila";
    montoCell.innerHTML = "$0";
    montoCell.setAttribute("contenteditable", "true");
    accionCell.innerHTML = '<button class="eliminar-fila-gasto">Eliminar</button>';

    // Añadir el escuchador de eventos input a la nueva celda de monto
    montoCell.addEventListener("input", calcularTotales);
});
