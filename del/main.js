

//Chama as funções de validação
    //validateFields();
    //validateEmail(); //verifica se o email é valido e se existe na base de dados 
    //comparePass();
    //validateHandle(); //verifica se o nome de utilizador existe na base de dados 
    //validateAge(); //verifica se o utilizador tem mais do que x anos de idade
    //validateTerms(); //verifica se o utilizador deu check na caixa de termos

//Cria as variáveis que representam os campos do formulário
const form = document.querySelector('#regForm');

form.onsubmit = event => {
    const email = document.querySelector('#email').value;
    const pass = document.querySelector('#pass').value;
    // const cPass = document.querySelector('#cPass').value;
    // const handle = document.querySelector('#handle').value;
    // const profileName = document.querySelector('#name').value;
    // const birthdate = document.querySelector('#birthdate').value;

    //Estrutura condicional que verifica se todos os campos foram preenchidos 
    if(email === "") {
         //Impede que a página seja recarregada
        document.getElementById('msgEmail').innerHTML = "<span>Insira um e-mail válido!</span>" //substituir por aviso ao lado do campo
        return false;
    }

    else if (pass === "") {
        document.getElementById('msgPass').innerHTML = "<span>Insira uma palavra-passe válida!</span>" //substituir por aviso ao lado do campo
        return false;
    }

    // else if (handle == "") {
    //     handle.focus();
    //     return;
    // }

    // else if (profileName == "") {
    //     profileName.focus();
    //     return;
    // }

    // else if (birthdate == "") {
    //     birthdate.focus();
    //     return;
    // }

    //else return true;
}


//Função que verifica se o e-mail é válido
// function validateEmail() {

//     if (!regEmail.test(email)) {
//         window.alert("Por favor, insere um endereço de e-mail válido!");
//         email.focus();
//         return false;
//     }

//     //else return true;
// }


//Função que compara as passwords e só permite que o formulário seja submetido se elas forem iguais
// function comparePass() {

//     if(cPass != pass) {
//         window.alert("As palavras-passe não coincidem!");
//         document.regForm.cPass.focus();
//         return false;
//     }

//     //else return true;
// }


//Função que verifica se o utilizador é maior de idade
// function validateAge() {
//     let birthdate = document.f_reg.birthdate.value; //recebe o valor do input
//     let date = new Date(birthdate); //converte para o formato de data
    
//     //Calcula a diferença em meses com a data atual
//     let month_diff = Date.now() - date.getTime();  
      
//     //Converte a difença em formato de data
//     let age_dt = new Date(month_diff);   
      
//     //Extrai o ano da data
//     let year = age_dt.getUTCFullYear();  
      
//     //Calcula a idade do utilizador  
//     let age = Math.abs(year - 1970);  
      
//     //Verifica se o utilizador tem menos de 18 anos
//     if(age < 18) {
//         window.alert("Tens de ter pelo menos 18 anos para te registares no nosso site!");
//         return false;
//     }

//     //else return true;
// }

//https://www.javatpoint.com/calculate-age-using-javascript