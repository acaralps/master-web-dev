
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

class Empresa extends Cliente {
    constructor(nombre, saldo, telefono, categoria){ 
        super(nombre, saldo); 
        this.telefono = telefono;
        this.categoria = categoria;
    }
//al ya existir lo va a sobreescribir
    static bienvenida(){
        return `Bienvenido al cajero de empresas`
    }
}

const juan = new Cliente('juan', 300);
const empresa = new Empresa('code con abel', 100, 987987978, 'informativos');