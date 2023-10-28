console.log("------------- 03-app.js ------------");

const carro = [
    { nombre: 'Monitor 27 Pulgadas', precio: 500 },
    { nombre: 'Televisión', precio: 100 },
    { nombre: 'Tablet', precio: 200 },
    { nombre: 'Audifonos', precio: 300 },
    { nombre: 'Teclado', precio: 400 },
    { nombre: 'Celular', precio: 700 },
]

let total = 0; 
carro.forEach( producto => total += producto.precio);
console.log(total);


let totales = carro.reduce((tot, producto) => tot + producto.precio, 100) //100 = valor de donde inicia
console.log(totales)