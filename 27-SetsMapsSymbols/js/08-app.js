//iteradores
var ciudades = ['londres', 'ny', 'bcn'];
var ordenes = new Set([ 123, 123, 123, 345, 1234]);
var datos = new Map();

datos.set('nombre', 'juan');
datos.set('prodfesion', 'des web');


//entries iterator 
for (let entry of ciudades.entries()){
    console.log(entry)
}

for (let entry of ordenes.entries()){
    console.log(entry)
}

for (let entry of datos.entries()){
    console.log(entry)
}


//values iterator
for (let value of ciudades.values()){
    console.log(entry)
}

//keys iterator
for (let keys of ciudades.keys()){
    console.log(entry)
}

//default
for (let ciudad of ciudades()){
    console.log(ciudad)
}