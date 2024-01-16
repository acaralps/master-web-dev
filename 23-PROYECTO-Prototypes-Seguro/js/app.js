function Seguro(marca, year, tipo) {
  this.marca = marca;
  this.year = year;
  this.tipo = tipo;
}
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
const div = document.createElement('div');
if(tipo === 'error'){
    div.classList.add('error')
}else {
    div.classList.add('correcto')
}

div.classList.add('mensaje', 'mt-10')
div.textContent = mensaje;
const formulario = document.querySelector("#cotizar-seguro");
formulario.insertBefore(div, document.querySelector('#resultado'));
setTimeout(() => {
    div.remove();
}, 3000);



}


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
    ui.mostrarMensaje("Todos los campos son obligatios", 'error');
    return;
  } 
    ui.mostrarMensaje('Cotizando...', 'exito')

    //instanciar el seguro

    //utilizar el prototype que va a cotizar
  
}
