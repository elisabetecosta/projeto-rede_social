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

//Faz desaparecer o elemento selecionado com uma animação fade-out
function fadeOut(element) {
    var op = 1;  // initial opacity
    var timer = setInterval(function () {
        if (op <= 0.1){
            clearInterval(timer);
            element.style.display = 'none';
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, 30);
}

// Função que detecta o ID do post e executa a Jquery que permite "apagá-lo"
function deletePost(){
    var $id = parseInt(event.target.getAttribute("data-id"));
    //console.log($id);
    $(document).ready(function() {
        //Apaga o post
        $.ajax({
            url: 'http://localhost/projeto-rede_social/server/action.delete.php',
            method: 'POST',
            data: {id: $id}, 
            success: function() {  
                alert("O teu post foi apagado!");
                setTimeout(location.reload, 4000); //Delay do refresh da página
            },
            error: function() {
                console.log(error);
            }
        });
    });
    fadeOut(document.getElementById($id));  //Estamos a adicionar o efeito fade-out
}

// Função que copia o URL direto para o post
const copyURL = async () => {
    var url = window.location.href;
    let postId = event.target.getAttribute("data-id");

    try {
        window.location.href = '../server/posts.php' + "#" + postId;
        await navigator.clipboard.writeText(window.location.href);
        alert('URL copiada com sucesso!');
    } catch (err) {
        console.error('Failed to copy: ', err);
    }
}


// Função que copia o URL direto para o post
const copyFave = async () => {
    var url = window.location.href;
    let postId = event.target.getAttribute("data-id");

    try {
        window.location.href = '../server/favorites.php' + "#" + postId;
        await navigator.clipboard.writeText(window.location.href);
        alert('URL copiada com sucesso!');
    } catch (err) {
        console.error('Failed to copy: ', err);
    }
}

//Função que permite ter uma preview da Média upada
function previewMedia(input) {
    const preview_media = document.querySelector('.preview_media');

    //Se for imagens
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        preview_media.style.display = 'block';      //Passa a div escondida para visivel
        preview_media.classList.add('pics1');       //Acrescenta a classe '.pics1' para mostrar uma imagem
    }
}