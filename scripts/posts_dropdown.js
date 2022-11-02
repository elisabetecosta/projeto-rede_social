// Permite fechar os dropdown menus dos posts com um clique
const target = document.querySelectorAll('.target');
document.addEventListener('click', (event) => {
    for(let i = 0; i < target.length; i++){
        const withinBoundaries = event.composedPath().includes(target[i]);
        if (!withinBoundaries) {
            target[i].checked = false;
        } 
    }
})