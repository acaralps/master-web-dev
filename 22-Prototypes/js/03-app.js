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

const pedro = new Cliente('juan', 500);
console.log(pedro);
console.log(pedro.tipoCliente());