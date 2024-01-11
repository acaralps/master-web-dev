function Cliente(nombre, saldo){
    this.nombre = nombre;
    this.saldo = saldo;
}

Cliente.prototype.tipoCliente =  function(){
    let tipo;
    if(this.saldo > 400){
        tipo = 'Platinum';
    }else{
        tipo = 'Gold'
    }
    return tipo;
}

Cliente.prototype.nombreClienteSaldo =  function(){
    return `El cliente ${this.nombre} tiene un saldo de ${this.saldo} tipo cliente ${this.tipoCliente()}`;
}

 
//heredar prototype
function Persona(nombre, saldo, telefono){
Cliente.call(this, nombre, saldo);
this.telefono = telefono;
}

const pedro = new Cliente('juan', 500);


//estamos haciendo que el obj persona herede el prototype de cliente (las funciones)

//es importante instanciar antes de crear el obj
Persona.prototype = Object.create(Cliente.prototype)
Persona.prototype.constructor = Cliente;
const juan = new Persona('juan', 5000, 53423562456)

console.log(juan.nombreClienteSaldo)




console.log(pedro);
console.log(juan)
console.log(pedro.tipoCliente());