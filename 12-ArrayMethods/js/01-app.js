const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'];

const carrito = [
    { nombre: 'Monitor 27 Pulgadas', precio: 500 },
    { nombre: 'Televisión', precio: 100 },
    { nombre: 'Tablet', precio: 200 },
    { nombre: 'Audifonos', precio: 300 },
    { nombre: 'Teclado', precio: 400 },
    { nombre: 'Celular', precio: 700 },
]

const res = meses.includes('Enero');
console.log(res);

const res1 = carrito.some(producto => {
    return producto.nombre ==='Enero';
})
console.log(res1);

const res2 = carrito.some (producto => producto.nombre === 'Televisión');
console.log(res2);

const res3 = meses.some (mes => mes === 'Enero');
console.log(res3);