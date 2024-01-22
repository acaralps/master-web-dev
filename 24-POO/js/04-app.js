class Cliente {

    #nombre; //privada

    setNombre(nombre){
        this.#nombre = nombre;
    }
    getNombre(){
        return this.#nombre;
    }
}


const juan = new Cliente();
juan.setNombre('Juaniillo');
console.log(juan.getNombre());
