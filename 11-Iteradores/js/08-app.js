//fizz buzz - 100 numeros

//multiplo de 3 6 9 12 p    print fizz
//multiplo de 5 10 15 20    print buzz
//multiplo de 15 30 45      print fizz buzz



for (let i = 0; i < 100; i++) {
  if (i % 15 === 0) {
    console.log(i + ': fizz buzz')
  } else if(i % 3 === 0) {
    console.log(i + ": fizz");
  } else if (i % 5 === 0) {
    console.log(i + ": buzz");
  }
}


const meses = new Array("enero", "febreo", "marzo", "abril", "mayo");

for (let mes in meses ) {
    console.log(mes);
}


const auto = {
  marca: 'Audio',
  modelo: 'camaro',
  ano: '2023'
}


for (let [key, value] of Object.entries(auto)) {
  console.log(key +  ": " + value);
}