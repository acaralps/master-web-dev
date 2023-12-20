const nombre = localStorage.getItem('nombre')
console.log(nombre)

//parsear de objeto pasado a string A Objeto 
const productoJson = localStorage.getItem('producto')
const productObj = JSON.parse(productoJson)
console.log(productObj)


const meses = localStorage.getItem('meses')
const mesesArray = JSON.parse(meses)
console.log(mesesArray)