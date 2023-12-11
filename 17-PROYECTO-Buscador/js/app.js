const resultado = document.querySelector('#resultado')


//eventos
document,addEventListener('DOMContentLoaded', () => {
    mostrarAutos();
})

//functions
function mostrarAutos(){
    autos.forEach( auto => {
        const { marca, modelo, puertas, transmision, precio, color } = auto
        const autoHTML = document.createElement('p')
        autoHTML.textContent =    `
        ${marca} - ${modelo} - ${puertas} puertas - ${transmision} - ${precio} - ${color}
        `;

        //insertar en html
        resultado.appendChild(autoHTML)
    })
}