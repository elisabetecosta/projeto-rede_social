//Função principal que chama todas as funções de validação
function validate() {
    validateFields();
    //validateEmail(); //verifica se o email é valido e se existe na base de dados 
    confirmPassword();
    //validateHandle(); //verifica se o nome de utilizador existe na base de dados 
    validateAge(); //verifica se o utilizador tem mais do que x anos de idade
    //validateTerms(); //verifica se o utilizador deu check na caixa de termos
}



//Função que verifica se todos campos foram preenchidos
function validateFields() {
    //Cria as variáveis dos respetivos campos
    let email = document.f_reg.email.value;
    let password = document.f_reg.password.value;
    

    //Estrutura condicional que verifica se todos os campos foram preenchidos 
    if(email == "") {
        window.alert("Deve inserir um email válido!"); //substituir por aviso ao lado do campo
        email.focus();
        return false;
    }

    else if (password == "") {
        password.focus();
        return false;
    }

    else {
        return true;
    }
}



//Função que compara as passwords e só permite que o formulário seja submetido se elas forem iguais
function confirmPassword() {
    if(document.f_reg.cpassword != document.f_reg.password) {
        window.alert("As passwords não coincidem!");
        document.f_reg.cpassword.focus();
    }

    else {
        return true;
    }
}



//Função que verifica se o utilizador é maior de idade
function validateAge() {
    let birthdate = document.f_reg.birthdate.value; //recebe o valor do input
    let date = new Date(birthdate); //converte para o formato de data
    
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
        window.alert("Tens de ter pelo menos 18 anos para te registares no nosso site!");
        return false;
    }
    else {
        return true;
    }


    //https://www.javatpoint.com/calculate-age-using-javascript
}