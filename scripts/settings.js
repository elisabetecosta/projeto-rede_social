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