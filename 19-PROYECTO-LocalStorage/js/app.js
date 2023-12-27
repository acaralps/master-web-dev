//var
const formulario = document.querySelector("#formulario");
const listaTweets = document.querySelector("#lista-tweets");
let tweets = [];

//event listeners
eventListeners();
function eventListeners() {
  //cuando el usuario agrega nuevo tweet
  formulario.addEventListener("submit", agregarTweet);
  //cuando el documento esta listo
  document.addEventListener('DOMContentLoaded', () => {
    tweets = JSON.parse(localStorage.getItem('tweets')) || [];
    crearHtml();
  });
}

//functions
function agregarTweet(e) {
  e.preventDefault();
  const tweet = document.querySelector("#tweet").value;

  if (tweet == "") {
    mostrarError("Text box is empty");
    return; //evita que se ejecuten mas lineas de codigo
  }
  console.log("return validation"); //al tener return en la validacion anterior, este codigo ya no se ejecuta

  const tweetObj = {
    id: Date.now(),
    tweet, // == tweet: tweet
  };
  tweets = [...tweets, tweetObj];
  console.log(tweets);

  crearHtml();
  formulario.reset();
}

function mostrarError(error) {
  const mensajeError = document.createElement("p");
  mensajeError.textContent = error;
  mensajeError.classList.add("error");

  //insert in html
  const contenido = document.querySelector("#contenido");
  contenido.appendChild(mensajeError);

  setTimeout(() => {
    mensajeError.remove();
  }, 3000);
}

function crearHtml() {
    limpiarHtml()
  if (tweets.length > 0) {
    tweets.forEach((tweet) => {
      //add boton eliminar
      const btnEliminar = document.createElement('a');
      btnEliminar.classList.add('borrar-tweet');
      btnEliminar.innerText = 'X';
      btnEliminar.onclick = () => {
        borrarTweet(tweet.id);
      }

      const li = document.createElement("li");
      li.innerText = tweet.tweet;
      li.appendChild(btnEliminar);
      listaTweets.appendChild(li);
    });
  }

  sincronizarStorage();
}

function limpiarHtml(){
    while(listaTweets.firstChild){
        listaTweets.removeChild(listaTweets.firstChild)
    }
}

function borrarTweet(id){
  tweets = tweets.filter( tweet => tweet.id !== id );
  crearHtml();
}

//add tweets en storage
function sincronizarStorage() {
  localStorage.setItem('tweets', JSON.stringify(tweets));
}
