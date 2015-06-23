/////////////////////////////////////////////////
/////////////////////////////////////////////////
//////////*   SMARTMONKEY CT SCRIPT   *//////////
//////////* No copyright what so ever *//////////
//////////*  Just go nuts, kind sir   *//////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
var $ = jQuery; // Unstupify jQuery for this

/* ligner mail */
function looksLikeMail(str) {
   
    var lastAtPos = str.lastIndexOf('@');
    var lastDotPos = str.lastIndexOf('.');
    return (lastAtPos < lastDotPos && lastAtPos > 0 && str.indexOf('@@') == -1 && lastDotPos > 2 && (str.length - lastDotPos) > 2);
    
}

/* Håndtér fejl fra ajax eller fra klient */
function handleError(dir,message){

    $(dir).html(message).css({
        'color':'#f77',
    });
    setTimeout(function(){
        $(dir).css({
            'color':'#333',
            'transition':'color .4s',
            '-moz-transition':'color .4s',
            '-webkit-transition':'color .4s',
            '-ms-transition':'color .4s',
            '-o-transition':'color .4s'
        });
    },800);

};


/* Håndtér succes fra ajax */
function handleSuccess(response){
    
    var msg = $('<h1></h1>');
    p = $('<p></p>');
    msg.html('Tak for din henvendelse!');
    p.html('Beskeden er sendt og du modtager inden længe en kopi til den indtastede emailadresse.');
    $('#smamo-ct').html(msg).append(p);

};


/* AJAX kald til mail.php */
function sendMail(vars){
    $.ajax({
        method:'POST',
        data:vars,
        dataType:'json',
        url:smamo_ct_root +'/mail.php',
        success:function(response){
            if(response.error){
                console.log(response.error);     
            }
            
            else{
            
                console.log(vars);
                console.log(response);
                handleSuccess(response);

            }
        },
    });
};


/* READY HANDLERS */
$(function(){
    
    disabled = false;
    $('#ct-submit').click(function(event){
        
        if(!disabled){
            disabled = true;
            
        
            var vars = {
                name    : $('#ct-name').val(),
                email   : $('#ct-email').val(),
                message : $('#ct-message').val(),
                auth    : $('#ct-auth').val(),
                to      : $('#ct-to').val(),
            }

            var ready = true;

            if($('#ct-name').val() ===''){ready = false;handleError('#lbl-name','Du skal udfylde navn');}
            if($('#ct-to').val() ===''){ready = false;handleError('#lbl-besked','Der opstod en fejl, prøv at genindlæse siden.');}
            if(!looksLikeMail($('#ct-email').val())){ready = false;handleError('#lbl-email','Ret email');}
            if($('#ct-message').val() === ''){ready = false;handleError('#lbl-message','Tilføj besked');}


            if (ready){

                sendMail(vars);
                $('#ct-submit').addClass('loading');

            } 
            
            else{
                disabled = false;
            }
            
        }
    });
    

}); // END ready