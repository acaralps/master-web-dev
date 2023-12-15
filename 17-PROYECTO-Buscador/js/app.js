const marca = document.querySelector("#marca");
const year = document.querySelector("#year");
const minimo = document.querySelector("#minimo");
const maximo = document.querySelector("#maximo");
const puertas = document.querySelector("#puertas");
const transmision = document.querySelector("#transmision");
const color = document.querySelector("#color");


const resultado = document.querySelector("#resultado");


const max = new Date().getFullYear();
const min = max - 10;

const datosBusqueda = {
  marca: '',
  year:'',
  minimo:'',
  maximo:'',
  puertas:'',
  transmision:'',
  color:''
}

//eventos
document,
  addEventListener("DOMContentLoaded", () => {
    mostrarAutos(); //show cars
    llenarSelect(); //llenar combo de years
  });

  //event listeners
  marca.addEventListener('change', e => {
    datosBusqueda.marca = e.target.value;
  })

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
