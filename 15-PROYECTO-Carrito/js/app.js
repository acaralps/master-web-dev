// const carrito = document.querySelector('#carrito');
const contenedorCarrito = document.querySelector("#lista-carrito tbody");
// const vaciarCarritoBtn = document.querySelector('#vaciar-carrito');
const listaCursos = document.querySelector("#lista-cursos");
let articulosCarrito = [];

cargarEventListeners();

function cargarEventListeners() {
  //agregar al carrito
  listaCursos.addEventListener("click", agregarCurso);
}

function agregarCurso(e) {
  e.preventDefault();

  if (e.target.classList.contains("agregar-carrito")) {
    const cursoSeleccionado = e.target.parentElement.parentElement;
    leerDatosCurso(cursoSeleccionado);
  }
}

//lee contenido y extrae info del curso
function leerDatosCurso(curso) {
  console.log(curso);

  //creacion del objeto
  const infoCurso = {
    imagen: curso.querySelector("img").src,
    titulo: curso.querySelector("h4").textContent,
    precio: curso.querySelector("span").textContent,
    id: curso.querySelector("a").getAttribute("data-id"),
    cantidad: 1,
  };

  //add elements in carrito array
  articulosCarrito = [...articulosCarrito, infoCurso];
  console.log(articulosCarrito);
  carritoHTML();
}

//mostrar elementos en carrito

function carritoHTML() {
  limpiarHTML();
  articulosCarrito.forEach((curso) => { 
    console.log(curso);
    const { imagen, titulo, precio, cantidad, id } = curso;
    const row = document.createElement("tr");
    row.innerHTML = `
    <td>
      <img src = "${imagen}" width="100">
    </td>
<td>${titulo}</td>
  <td>${precio}</td>
  <td>${cantidad}</td>
  <td>
<a href="#" class="borrar-curso" data-id="${id}"> X </a>
  </td>

  `;
    contenedorCarrito.appendChild(row);
  });
}

//eliminar cursos del table body limpiar html
function limpiarHTML() {
  while (contenedorCarrito.firstChild) {
    contenedorCarrito.removeChild(contenedorCarrito.firstChild);
  }
}
