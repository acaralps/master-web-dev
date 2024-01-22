//hay dos formas de crear una classe, la primera la mas camun
// class declaration
class Cliente {
    constructor(nombre, saldo){
        this.nombre = nombre;
        this.saldo = saldo;
    }

    mostrarInformacion() {
        return `Cliente: ${this.nombre}, tu saldo es de ${this.saldo}`;
    }
    static bienvenida(){
        return `Bienvenido al cajero`
    }
}

const juan = new Cliente('juan', 300);
console.log(juan)
console.log(juan.mostrarInformacion())
console.log(juan.bienvenida())

//class expresion
const Cliente2  = class {

}

