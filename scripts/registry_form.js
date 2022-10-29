//Variáveis relativas aos campos do formulário
const form = document.getElementById('regForm');
const email = document.getElementById('email');
const password = document.getElementById('password');
const passwordTwo = document.getElementById('passwordTwo');
const handle = document.getElementById('handle');
const profileName = document.getElementById('profileName');
const birthdate = document.getElementById('birthdate');
const terms = document.getElementById('terms');


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
    const passwordTwoValue = passwordTwo.value.trim();
    const handleValue = handle.value.trim();
    const profileNameValue = profileName.value.trim();
    const birthdateValue = birthdate.value.trim();

    //Javascript regex que valida o formato de e-mail
    const regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g;

    //Javascript regex que valida o formato do nome de utilizador
    const regHandle = /^[A-Za-z][A-Za-z0-9_-]{4,15}$/g;


    //Se o campo estiver vazio ou os dados inseridos não cumprirem com os requisitos chama a função errorValidation, caso contrário chama a função successValidation
    if (emailValue === '') {
        errorValidation(email, 'Este campo não pode ficar vazio!');
        return false;

    } else if (!regEmail.test(emailValue)) {
        errorValidation(email, 'Insira um endereço de e-mail válido!');
        return false;

    } else {
        checkEmail(email, emailValue);
    }

    if (passwordValue === '') {
        errorValidation(password, 'Este campo não pode ficar vazio!');
        return false;

    } else if (passwordValue.length < 8) {
        errorValidation(password, 'A palavra-passe deve ter pelo menos 8 caracteres!');
        return false;

    } else {
        successValidation(password);
    }


    if (passwordTwoValue === '') {
        errorValidation(passwordTwo, 'Este campo não pode ficar vazio!');
        return false;

    } else if (passwordTwoValue != passwordValue) {
        errorValidation(passwordTwo, 'As palavras-passe não são iguais!');
        return false;

    } else {
        successValidation(passwordTwo);
    }


    if (handleValue === '') {
        errorValidation(handle, 'Este campo não pode ficar vazio!');
        return false;

     } else if (!regHandle.test(handleValue)) {
        errorValidation(handle, 'Este campo deve conter entre 5 e 15 caracteres (a-Z, 0-9, _, -)');
         return false;

    } else {
        checkHandle(handle, handleValue);
    }


    if (profileNameValue === '') {
        errorValidation(profileName, 'Este campo não pode ficar vazio!');
        return false;

    } else {
        successValidation(profileName);
    }


    if (birthdateValue === '') {
        errorValidation(birthdate, 'Este campo não pode ficar vazio!');
        return false;

    } else {
        validateAge(birthdateValue);
    }


    if (terms.checked) {
        successValidation(terms);

    } else {
        errorValidation(terms, 'Tem de aceitar os termos para concluir o registo!');
        return false;
    }

    return true;
}


//Função que verifica se o utilizador é maior de idade
function validateAge(input) {
    //Converte o valor do input para o formato de data
    let date = new Date(input);

    //Calcula a diferença em meses com a data atual
    let month_diff = Date.now() - date.getTime();

    //Converte a difença em formato de data
    let age_dt = new Date(month_diff);

    //Extrai o ano da data
    let year = age_dt.getUTCFullYear();

    //Calcula a idade do utilizador  
    let age = Math.abs(year - 1970);

    //Verifica se o utilizador tem menos de 18 anos
    if (age < 18) {
        errorValidation(birthdate, 'Não é permitido o registo de menores de 18!');
        return false;

    } else {
        successValidation(birthdate);
        return true;
    }
}


//Função que verifica se o e-mail inserido já se encontra registado
function checkEmail(input, inputValue) {
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
    let url = "../server/ajax/validate_email.php";

    //Variável que armazena os dados inseridos pelo utilizador para serem enviados para o ficheiro php
    let vars = "email=" + inputValue;

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
                //input.focus();
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


//Função que verifica se o handle inserido já se encontra registado
function checkHandle(input, inputValue) {

    let request;

    try {
        request = new XMLHttpRequest();
    }

    catch (tryMicrosoft) {

        try {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        }

        catch (otherMicrosoft) {
            try {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }

            catch (failed) {
                request = null;
            }
        }
    }

    let url = "../server/ajax/validate_handle.php";
    let vars = "handle=" + inputValue;
    request.open("POST", url, true);

    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            let return_data =  request.responseText;

            if(return_data !== '') {
                errorValidation(input, return_data);
                //input.focus();
                return false;
            } else {
                successValidation(input);
            }
        }
    }

    request.send(vars);

    return true;
}