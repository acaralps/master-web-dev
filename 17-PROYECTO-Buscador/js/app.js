const resultado = document.querySelector("#resultado");
const year = document.querySelector("#year");
const max = new Date().getFullYear();
const min = max - 10;

//eventos
document,
  addEventListener("DOMContentLoaded", () => {
    mostrarAutos(); //show cars
    llenarSelect(); //llenar combo de years
  });

//functions
function mostrarAutos() {
  autos.forEach((auto) => {
    const { marca, modelo, puertas, transmision, precio, color } = auto;
    const autoHTML = document.createElement("p");
    autoHTML.textContent = `
        ${marca} - ${modelo} - ${puertas} puertas - ${transmision} - ${precio} - ${color}
        `;

    //insertar en html
    resultado.appendChild(autoHTML);
  });
}

//llena select de los years
function llenarSelect() {  
  for (let i = max; i >= min; i--) {
    console.log(i);
    const opcion = document.createElement("option");
    opcion.value = i;
    opcion.textContent = i;
    year.appendChild(opcion);
  }
}
