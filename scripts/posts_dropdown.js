// Permite fechar os dropdown menus dos posts com um clique
function dropdown(){
    const target = document.querySelectorAll('.target');
    document.addEventListener('click', (event) => {
        for(let i = 0; i < target.length; i++){
            const withinBoundaries = event.composedPath().includes(target[i]);
            if (!withinBoundaries) {
                target[i].checked = false;
            } 
        }
    })
}

// Função que detecta o ID do post e executa a Jquery que permite "apagá-lo"
function apagar(){
    var $id=parseInt(event.target.getAttribute("data-id"));
    console.log($id);
    $(document).ready(function() {

        //Apaga o post
        $.ajax({
            url: 'http://localhost/projeto-rede_social/server/action.update.php',
            method: 'POST',
            data: {id: $id}, 
            success: function() {  
                alert("O teu post foi apagado!");
                location.reload();
            },
            error: function() {
                console.log(error);
            }
        });
    });
}