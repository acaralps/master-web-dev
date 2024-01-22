//crear nuestro propio iterador
//asi es como estaria construido un for po ejemplo

function crearIterador(carrito){
    let i = 0;
    return{
        siguiente: () => {
            var fin = ( i >= carrito.length );
            var valor =  !fin ? carrito[i++] : undefined;
            return {
                fin, 
                valor
            }
        }
    }
}

const carrito = ['producto 1', 'producto 2', 'producto 3'];

//utilizar el iterador
const recorrerCarrito = crearIterador(carrito);
console.log(recorrerCarrito.siguiente())
console.log(recorrerCarrito.siguiente())
console.log(recorrerCarrito.siguiente())
console.log(recorrerCarrito.siguiente())