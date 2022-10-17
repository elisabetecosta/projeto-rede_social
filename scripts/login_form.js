//Variáveis relativas aos campos do formulário
const form = document.getElementById('loginForm');
const email = document.getElementById('email');
const password = document.getElementById('password');


//Executa o que está dentro da função quando um input perde o foco
form.addEventListener('focusout', (event) => {
    //Impede que a página recarregue
    event.preventDefault();

    checkInputs();
}, true);


//Função que atribui a classe error e exibe a mensagem de erro
function errorValidation(input, message) {
    //O parentElement retorna o pai do input, que é a div com a classe form-control
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');

    //Substitui a mensagem por default pela passada como parâmetro na função
    small.innerText = message;

    //Reatribui a classe form-control error à variável formControl
    formControl.className = 'form-control error';
}


//Função que atribui a classe de success
function successValidation(input) {
    //O parentElement retorna o pai do input, que é a div com a classe form-control
    const formControl = input.parentElement;

    //Reatribui a classe form-control success à variável formControl
    formControl.className = 'form-control success';
}


//Função que faz a validação dos campos do formulário
function checkInputs() {
    //O método Trim corta os espaços em branco e devolve apenas o texto
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();

    //Javascript regex que valida o formato de e-mail
    const regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g;


    //Se o campo estiver vazio ou os dados inseridos não cumprirem com os requisitos chama a função errorValidation, caso contrário chama a função successValidation
    if (emailValue === '') {
        errorValidation(email, 'Este campo não pode ficar vazio!');
        return false;

    } else if (!regEmail.test(emailValue)) {
        errorValidation(email, 'Insira um endereço de e-mail válido!');
        return false;
    } 


    if (passwordValue === '') {
        errorValidation(password, 'Este campo não pode ficar vazio!');
        return false;

    } else {
        checkUser(password, emailValue, passwordValue);
    }

    return true;
}


//Função que verifica se o utilizador se encontra registado
function checkUser(input, inputValue1, inputValue2) {
    //Variável que permite que o browser comunique com o servidor
    let request;

    //Cria um novo pedido de comunicação entre o browser e o servidor
    try {
        request = new XMLHttpRequest(); 
    }

    //Tenta métodos diferentes de criar o pedido se o primeiro não funcionar
    catch (tryMicrosoft) {

        try {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        }

        catch (otherMicrosoft) {
            try {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }

            //Se todos os métodos falharem, o objeto recebe o valor de null, impedindo a comunicação assíncrona
            catch (failed) {
                request = null;
            }
        }
    }

    //Variável que contém o endereço do ficheiro php responsável pelo processamento dos dados
    let url = "includes/validate_user.php";

    //Variável que armazena os dados inseridos pelo utilizador para serem enviados para o ficheiro php
    let vars = "email=" + inputValue1 + "&password=" + inputValue2;

    //Função que define o método (post ou get), o url e o tipo de pedido (true para pedidos assíncronos)
    request.open("POST", url, true);

    //Para fins de codificação de caractéres, impedindo erros no caso da variável conter símbolos
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //Conforme o servidor processa o pedido, verifica a mudança de estado do mesmo e executa a função
    request.onreadystatechange = function () {

        //Verifica o estado do pedido, sendo que 4 = pedido pronto | 200 = tudo OK do lado do servidor
        if (request.readyState == 4 && request.status == 200) {

            //Variável que recebe o texto de resposta do servidor
            let return_data =  request.responseText;

            //Se a resposta não estiver vazia, significa que recebeu uma mensagem de erro
            if(return_data !== '') {
                errorValidation(input, return_data);
                return false;

            //Caso contrário, pode chamar a função successValidation
            } else {
                successValidation(input);
            }
        }
    }

    //Envia os dados para serem processados pelo ficheiro php
    request.send(vars);

    return true;
}