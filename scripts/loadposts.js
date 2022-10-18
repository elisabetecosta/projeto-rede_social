/* $(document).ready(function() {
    $(window).scroll(function() {
        var lastID = $('.load-more').attr('lastID');
        if(($(window).scrollTop() == $(document).height() - $(window).height()) && (lastID !=0)) { */

            // colocar aqui a chamada em ajax que obtém os dados do servidor e coloca-os na(s) div(s)


            // 1) se o tipo de post for texto: ( ou seja: posts sem nenhum registo no media.id )
/*                     $.ajax({
                        url: 'http://localhost/xata/load_posts.php',
                        method: 'POST',
                        data: {name: u_name, handle: u_handle, timestamp: p_timestamp, text: p_text},
                        //dataType: 'json',
                        beforeSend:function(){
                            $('.load-more').show();
                        },
                        success:function(html){
                            $('.load-more').remove();
                            $('#postList').append(html);
                        }
                    }); */

            // se o tipo de post for imagem: media.type = 'pic'
                    //1 imagem
                    //2 imagens
                    //3 imagens
                    //4 imagens

            // se o tipo de post for código: media.type = 'txt'

            // se o tipo de post for vídeo: media.type = 'vid'

            // se o tipo de post for URL: media.type = 'lnk'
/*         }
    });
}); */