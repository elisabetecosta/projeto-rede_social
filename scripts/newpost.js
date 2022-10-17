$('#newpost_box').submit(function(e){
    e.preventDefault();
    
    var u_post = $('#newpost_text').val();
    console.log(u_post);

    $.ajax({
        url: 'http://localhost/xata/server/publish.php',
        method: 'POST',
        data: {post: u_post},
        dataType: 'json'   
        //json é uma linguagem que pode receber e enviar dados do PHP para Javascript e viceversa; por isso usamo-la aqui
    }).done(function(result){
        console.log(result);
    });
});
