localStorage.removeItem('nombre');


const mesesArrayy = JSON.parse(localStorage.getItem('meses'))
console.log(mesesArrayy)
mesesArrayy.push('nuevo mes')
console.log(mesesArrayy)

localStorage.setItem('meses', JSON.stringify(mesesArrayy))

//localStorage.clear();