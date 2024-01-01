//para crear objetos dinamicos y reutilizables

//objeto comun
const cliente = {
    nombre: 'juan',
    saldo: 500
}
console.log(cliente)


//prototype
function Cliente(nombre, saldo){
    this.nombre = nombre;
    this.saldo = saldo;
}

const juan = new Cliente('juan', 500);
console.log(juan)