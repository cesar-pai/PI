//Mutliple Step Form

$(function() {

//jQuery time
    var current_fs, next_fs, previous_fs; //div.pages
    var left, opacity, scale; //div.page properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $("div.page").each(function() {

        $(this).find("button.submit").click(function(){
            $(this).parent().parent().find('input,textarea').each(function(event){
                if($(this).prop('required')){
                    if(!$(this).val() ) {
                        var label = $('label[for="' + this.id + '"]').html();
                        if (label == 'undefined') {
                            alert("Veuillez remplir le champs requis (ou effacer la ligne si possible");
                        } else {
                            alert("Veuillez remplir le champ \"" + label +"\"");
                        }
                        $(this).focus();
                        event.preventDefault();
                        return false;
                    }
                }
            });
        });

        $(this).find("input.next").click(function(){
            $(this).parent().parent().find('input,textarea').each(function(event){
                if($(this).prop('required')){
                    if(!$(this).val() ) {
                        var label = $('label[for="' + this.id + '"]').html();
                        if (label == 'undefined') {
                            alert("Veuillez remplir le champs requis (ou effacer la ligne si possible");
                        } else {
                            alert("Veuillez remplir le champ \"" + label +"\"");
                        }
                        $(this).focus();
                        event.preventDefault();
                    }
                }
            });

        if(animating) return false;
        animating = true;

        current_fs = $(this).parent().parent();
        next_fs = $(this).parent().parent().next();

//activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("div.page").index(next_fs)).addClass("active");

//show the next div.page
        next_fs.show();
//hide the current div.page with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
//as the opacity of current_fs reduces to 0 - stored in "now"
//1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
//2. bring next_fs from the right(50%)
                left = (now * 50)+"%";
//3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'transform': 'scale('+scale+')'});
                next_fs.css({'left': left, 'opacity': opacity});
            },
            duration: 0,
            complete: function(){
                current_fs.hide();
                animating = false;
            },
//this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(this).find("input.previous").click(function(){

        $(this).parent().parent().find('input,textarea').each(function(event){
            if($(this).prop('required')){
                if(!$(this).val() ) {
                    var label = $('label[for="' + this.id + '"]').html();
                    if (label == 'undefined') {
                        alert("Veuillez remplir le champs requis (ou effacer la ligne si possible");
                    } else {
                        alert("Veuillez remplir le champ \"" + label +"\"");
                    }
                    $(this).focus();
                    event.preventDefault();
                }
            }
        });

        if(animating) return false;
        animating = true;

        current_fs = $(this).parent().parent();
        previous_fs = $(this).parent().parent().prev();

//de-activate current step on progressbar
        $("#progressbar li").eq($("div.page").index(current_fs)).removeClass("active");

//show the previous div.page
        previous_fs.show();
//hide the current div.page with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
//as the opacity of current_fs reduces to 0 - stored in "now"
//1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
//2. take current_fs to the right(50%) - from 0%
                left = ((1-now) * 50)+"%";
//3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
            },
            duration: 0,
            complete: function(){
                current_fs.hide();
                animating = false;
            },
//this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });


    $(".submit").click(function(){
        return false;
    });

    });

});




