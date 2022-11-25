//======================== VALIDAÇÕES =======================

//Variáveis relativas aos campos do formulário
const form = document.getElementById('settingsForm');
const profileName = document.getElementById('profileName');
const password = document.getElementById('passwordCurrent');
const passwordNew = document.getElementById('passwordNew');
const passwordConfirm = document.getElementById('passwordConfirm');
const email = document.getElementById('email');
const emailConfirm = document.getElementById('emailConfirm');
const passwordCurrentTwo = document.getElementById('passwordCurrentTwo');


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
    const profileNameValue = profileName.value.trim();
    const passwordValue = password.value.trim();
    const passwordNewValue = passwordNew.value.trim();
    const passwordConfirmValue = passwordConfirm.value.trim();
    const emailValue = email.value.trim();
    const emailConfirmValue = emailConfirm.value.trim();
    const passwordCurrentTwoValue = passwordCurrentTwo.value.trim();

    //Javascript regex que valida o formato de e-mail
    const regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g;

    //Javascript regex que valida o formato do nome de utilizador
    const regHandle = /^[A-Za-z][A-Za-z0-9_-]{4,15}$/g;


    //Se o campo estiver vazio ou os dados inseridos não cumprirem com os requisitos chama a função errorValidation, caso contrário chama a função successValidation
    // if (emailValue === '') {
    //     errorValidation(email, 'Este campo não pode ficar vazio!');
    //     return false;

    // } else if (!regEmail.test(emailValue)) {
    //     errorValidation(email, 'Insira um endereço de e-mail válido!');
    //     return false;

    // } else {
    //     checkEmail(email, emailValue);
    // }

    // if (passwordValue === '') {
    //     errorValidation(password, 'Este campo não pode ficar vazio!');
    //     return false;

    // } else if (passwordValue.length < 8) {
    //     errorValidation(password, 'A palavra-passe deve ter pelo menos 8 caracteres!');
    //     return false;

    // } else {
    //     successValidation(password);
    // }


    // if (passwordTwoValue === '') {
    //     errorValidation(passwordTwo, 'Este campo não pode ficar vazio!');
    //     return false;

    // } else if (passwordConfirmValue != passwordNewValue) {
    //     errorValidation(passwordTwo, 'As palavras-passe não são iguais!');
    //     return false;

    // } else {
    //     successValidation(passwordTwo);
    // }


    if (passwordConfirmValue === '') {
        errorValidation(passwordConfirm, 'Este campo não pode ficar vazio!');
        return false;

    } else {
        successValidation(passwordConfirm);
    }

    return true;
}






















//======================== SIDEBAR/MAIN =======================
const links = document.querySelectorAll('.links a');
const sections = document.querySelectorAll('.wrapper');

//Itera por todos os links da sidebar
links.forEach(link => {

    //Adiciona um evento 'click' ao link clicado
    link.addEventListener('click', () => {

        //Remove a classe active de todos os links
        links.forEach(link => {
            link.classList.remove('active');
        });

        //Adiciona a classe active ao elemento link clicado
        link.classList.add('active');
    });
});


//Itera por todas as secções
sections.forEach(section => {

    //Adiciona um evento 'focus' à secção atual
    section.addEventListener('click', () => {

        //Remove a classe active de todas as secções
        sections.forEach(section => {
            section.classList.remove('active');
        });

        //Adiciona a classe active à secção atual
        section.classList.add('active');
    });
});

//======================== SELECT =======================
//Seleciona todos os dropdowns do documento
const dropdowns = document.querySelectorAll('.dropdown');

//Itera por todos os elementos do dropdown
dropdowns.forEach(dropdown => {

    //Seleciona os elementos que fazem parte de cada dropdown
    const select = dropdown.querySelector('.select');
    const menu = dropdown.querySelector('.menu');
    const options = dropdown.querySelectorAll('.menu li');
    const selected = dropdown.querySelector('.selected');

    //Adiciona um evento 'click' ao elemento selecionado
    select.addEventListener('click', () => {

        //Adiciona os estilos de menu-open ao elemento menu
        menu.classList.toggle('menu-open');
    });

    //Itera por todos os elementos option
    options.forEach(option => {

        //Adiciona um evento 'click' ao elemento option
        option.addEventListener('click', () => {

            //Altera o texto de selecionado para clicado
            selected.innerText = option.innerText;

            //Remove os estilos de menu-open do elemento menu
            menu.classList.remove('menu-open');

            //Remove a classe active de todos os elementos option
            options.forEach(option => {
                option.classList.remove('option-active');
            });

            //Adiciona a classe active ao elemento option clicado
            option.classList.add('option-active');
        });
    });

    //Fecha o menu se o utilizador clicar fora do menu
    window.addEventListener('click', (e) => {

        //Se o utilizador clicar numa área que não pertença ao select enquanto o menu estiver aberto, o menu é fechado
        if (!e.target.matches('.select') && menu.classList.contains('menu-open')) {

            menu.classList.remove('menu-open');
        }
    });
});