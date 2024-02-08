export var nombreCliente = 'Juan'; 
export var ahorro = 200;

export function mostrarInformacion(nombre, ahorro) {
    return `Cliente: ${nombre} - Ahorro: ${ahorro}`;
}

export class Cliente {
    constructor (nombre, ahorro){
        this.nombre = nombre;
        this.ahorro = ahorro;
    }
    mostrarInformacion(){
        return `Cliente: ${this.nombre} - Ahorro: ${this.ahorro}`;
    }
}

//solo puedes tener un export default
export default function nuevaFuncion(){
    console.log('este es el export defautl')
}