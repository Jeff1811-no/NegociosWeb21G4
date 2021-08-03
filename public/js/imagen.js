

function imagen(usuario) {
    var formData = new FormData();
    var image = $('#uploadImage')[0].files;
    if(image.length != 0){
        formData.append('image',image[0]);
        formData.append('id',usuario);

        $.ajax({
            url: `uploads/?id=${usuario}`,
            data:formData,
            type: 'post',
            contentType: false,
            processData:false,

            success: function(data){
                if(data != 'invalid'){
                    var stamp = Math.random();
                    $('.imagen').fadeOut();
                    $(".imagen").attr("src",`uploads/${data}?s=${stamp}`);
                    $(".imagen").fadeIn();
                }
            }        
        });
        return false;
    }
    
}

