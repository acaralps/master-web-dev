//event bubling
//cuanod presionas en un evento pero ese evento se propaga por muchos otros lugares y no es lo esperado

const cardDiv = document.querySelector('.card');

cardDiv.addEventListener('click', (e) => {
    e.stopPropagation()
    console.log('click en card')
})
