//Variáveis relativas aos campos do formulário
const form = document.getElementById('regForm');
const email = document.getElementById('email');
const pass = document.getElementById('pass');
const cPass = document.getElementById('cPass');
const handle = document.getElementById('handle');
const profileName = document.getElementById('profileName');
const birthdate = document.getElementById('birthdate');

//Executa o que está dentro da função quando o formulário for submetido
form.addEventListener('submit', (event) => {
    //Impede que a página recarregue
    event.preventDefault(); 

    checkInputs();
});


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
    const formControl = input.parentElement; 
    formControl.className = 'form-control success';
}


function checkInputs() {
    //O método Trim corta os espaços em branco e devolve apenas o texto
    const emailValue = email.value.trim();
    const passValue = pass.value.trim();
    const cPassValue = cPass.value.trim();
    const handleValue = handle.value.trim();
    const profileNameValue = profileName.value.trim();
    const birthdateValue = birthdate.value.trim();

    //Se o campo estiver vazio ou os dados inseridos não forem válidos chama a função errorValidation, caso contrário chama a função successValidation
    if(emailValue === '') {
        errorValidation(email, 'Este campo não pode ficar vazio!');
        email.focus();

    } else {
        successValidation(email);
    }


    if(passValue === '') {
        errorValidation(pass, 'Este campo não pode ficar vazio!');
        pass.focus();

    } else if(passValue.length < 8) {
        errorValidation(pass, 'A palavra-passe deve ter pelo menos 8 caracteres!');
        pass.focus();

    } else {
        successValidation(pass);
    }


    if(cPassValue === '') {
        errorValidation(cPass, 'Este campo não pode ficar vazio!');
        cPass.focus();

    } else if(cPassValue != passValue) {
        errorValidation(cPass, 'As palavras-passe não são iguais!');
        cPass.focus();

    } else {
        successValidation(cPass);
    }


    if(handleValue === '') {
        errorValidation(handle, 'Este campo não pode ficar vazio!');
        handle.focus();

    } else {
        successValidation(handle);
    }


    if(profileNameValue === '') {
        errorValidation(profileName, 'Este campo não pode ficar vazio!');
        profileName.focus();

    } else {
        successValidation(profileName);
    }


    if(birthdateValue === '') {
        errorValidation(birthdate, 'Este campo não pode ficar vazio!');
        birthdate.focus();

    } else {
        validateAge(birthdateValue);
    }
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
    if(age < 18) {
        errorValidation(birthdate, 'Não é permitido o registo de menores de 18!');

    } else {
        successValidation(birthdate);
    }
}