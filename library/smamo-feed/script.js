jQuery(function($){ 
    
    setTimeout(function(){
    $('.smamo_feedback:first-child').addClass('active').css('opacity','0').delay(500).animate({opacity:1},200);
    $('#smamo-feedback-loop').animate({'height':$('.smamo_feedback.active').height() + 40},500);

    },1000);
    
    setInterval(function(){
        
        var tot = $('.smamo_feedback').length;
        var num = $('.smamo_feedback.active').index() + 1;
        
        var new_num = num + 1;
        if (new_num > tot){
            new_num = 1;
        }
        
        
        var elem_old = $('.smamo_feedback:nth-child('+num+')');
        var elem_new = $('.smamo_feedback:nth-child('+new_num+')');
        
        
        $('#smamo-feedback-loop').animate({'height' : elem_new.height() + 40},500);
        
        elem_old.fadeOut(500);
        elem_new.fadeIn(500);
        
        setTimeout(function(){
        
            elem_old.removeClass('active').removeAttr('style');
            elem_new.addClass('active').removeAttr('style');
            
        },500);
    
    },15000);

});