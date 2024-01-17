function Seguro(marca, year, tipo) {
  this.marca = marca;
  this.year = year;
  this.tipo = tipo;
}

//realiza cotizacion con los datos
Seguro.prototype.cotizarSeguro = function () {
  /*
  1 = americano = 1.15
  2 = asiatico = 1.05
  3 = europeo = 1.35
  */
  let cantidad;
  const base = 2000;

  console.log(this.marca);
  switch (this.marca) {
    case "1":
      cantidad = base * 1.15;
      break;
    case "2":
      cantidad = base * 1.05;
      break;
    case "3":
      cantidad = base * 1.35;
      break;
    default:
      break;
  }

  //leer año, cada anyo la diferencia es mayor, por cada año restamos 3% al valor
  const diferencia = new Date().getFullYear() - this.year;
  cantidad -= (diferencia * 3 * cantidad) / 100;

  /*
si el seguro es basico se ultiplica por un 30% mas
si el seguro es completo se multiplica por un 50% mas
 */
  if (this.tipo == "basico") {
    cantidad *= 1.3;
  } else {
    cantidad *= 1.5;
  }
  return cantidad;
};

function UI() {}

//genera los años del combo
UI.prototype.llenarOpciones = () => {
  const max = new Date().getFullYear();
  const min = max - 20;
  const selectYear = document.querySelector("#year");

  for (let i = max; i > min; i--) {
    let option = document.createElement("option");
    option.value = i;
    option.textContent = i;
    selectYear.appendChild(option);
  }
};

UI.prototype.mostrarMensaje = (mensaje, tipo) => {
  const div = document.createElement("div");
  if (tipo === "error") {
    div.classList.add("error");
  } else {
    div.classList.add("correcto");
  }

  div.classList.add("mensaje", "mt-10");
  div.textContent = mensaje;
  const formulario = document.querySelector("#cotizar-seguro");
  formulario.insertBefore(div, document.querySelector("#resultado"));
  setTimeout(() => {
    div.remove();
  }, 3000);
};
UI.prototype.mostrarResultado = (total, seguro) => {
  const { marca, year, tipo } = seguro;
  let textoMarca;
  switch (marca) {
    case '1':
      textoMarca = "Americano";
      break;
    case '2':
      textoMarca = "Asiatico";
      break;
    case '3':
      textoMarca = "Europeo";
      break;
    default:
      break;
  }

  //crear el resultado
  const div = document.createElement("div");
  div.classList.add("mt-10");

  div.innerHTML = `
  <p class="header"Tu resumen</p>
  <p class="font-bold">Marca:  <span class= "font-normal"> ${textoMarca} </span></p>
  <p class="font-bold">Año:  <span class= "font-normal"> ${year} </span> </p>
  <p class="font-bold">Tipo:  <span class= "font-normal capitalize"> ${tipo} </span> </p>
  <p class="font-bold">Total:  <span class= "font-normal">$ ${total} </span> </p>

  `;
  const resultadoDiv = document.querySelector("#resultado");

  //mostrar spinner
  const spinner = document.querySelector("#cargando");
  spinner.style.display = "block";

  setTimeout(() => {
    spinner.style.display = "none";
    resultadoDiv.appendChild(div);
  }, 1500);
};

const ui = new UI();
console.log(ui);
document.addEventListener("DOMContentLoaded", () => {
  ui.llenarOpciones();
});

eventListeners();

function eventListeners() {
  const formulario = document.querySelector("#cotizar-seguro");
  formulario.addEventListener("submit", cotizarSeguro);
}

function cotizarSeguro(e) {
  //como es un submit tomamos el evento como arg = e
  e.preventDefault();

  const marca = document.querySelector("#marca").value;
  const year = document.querySelector("#year").value;
  const tipo = document.querySelector('input[name = "tipo"]:checked').value;

  if (marca == "" || year == "" || tipo == "") {
    ui.mostrarMensaje("Todos los campos son obligatios", "error");
    return;
  }
  ui.mostrarMensaje("Cotizando...", "exito");

  //ocultar cotizaciones previas
  const resultados = document.querySelector("#resultado div");
  if (resultados != null) {
    resultados.remove();
  }

  //instanciar el seguro
  const seguro = new Seguro(marca, year, tipo);
  const total = seguro.cotizarSeguro();

  //utilizar el prototype que va a cotizar
  ui.mostrarResultado(total, seguro);
}
