localStorage.setItem('nombre', 'Abel');

const producto = {
    nombre: 'monitor 24 ulg',
    precio: 300
}

//en local storage solo pueden guardarse strings, por eso hacemos la conversion json stringify
const productoString = JSON.stringify(producto);
localStorage.setItem('producto', productoString);

const meses = [ 'Enero', 'Febrero'];
const mesesString = JSON.stringify(meses);
localStorage.setItem('meses', mesesString);

