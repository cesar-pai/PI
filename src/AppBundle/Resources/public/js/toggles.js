/**
 * Created by Antoine on 10/19/2015.
 */

//    Launch modal on loading page

$(window).load(function(){
    $('#infos').modal({
        backdrop: 'static',
        keyboard: false
    });
});

$(document).ready(function() {

    //Checkbox's Bootstrap Switch
    $('input[type="checkbox"].bs').bootstrapSwitch();
    $('input[type="checkbox"].bs').click(function(){
        $(this).next().toggle();
    });


    //Collapsing sidebar
    $('.parent').click(function(e) {
        $(this).find('i:first').toggleClass('fa fa-arrow-right fa fa-arrow-down');
        $(this).children('.submenu').toggle('visible');
        e.stopPropagation();
    });

    //Collpasing fieldset
    $(".fieldset-toggle").click(function(){
        $(this).next('div').toggle();
        $(this).find('i').toggleClass('fa fa-plus fa fa-minus');
    });

    //Show/Hide div agrement
    var divagrement = $('#divAgrement');
    if (!$('#chkAgrement').prop('checked')){
        divagrement.hide();
        divagrement.find(':text').val('');
        divagrement.find(':input').val('');
    }
    $('#chkAgrement').on('switchChange.bootstrapSwitch', function() {
        if (this.checked) {
            divagrement.fadeIn();
        }
        else {
            divagrement.fadeOut();
            divagrement.find(':text').val('');
            divagrement.find(':input').val('');
        }
    });

    //Show/Hide div expert comptable
    var divexpertcompt = $('#divExpertCompt');
    if (!$('#chkExpertCompt').prop('checked')){
        divexpertcompt.hide();
        divexpertcompt.find(':text').val('');
        divexpertcompt.find(':input').val('');
    }
    $('#chkExpertCompt').on('switchChange.bootstrapSwitch', function() {
        if (this.checked) {
            divexpertcompt.fadeIn();
        }
        else {
            divexpertcompt.fadeOut();
            divexpertcompt.find(':text').val('');
            divexpertcompt.find(':input').val('');
        }
    });

    //Show/Hide div Affiliation
    var divaffiliation = $('#divAffiliation');
    if (!$('#chkAffiliation').prop('checked')){
        divaffiliation.hide();
        divaffiliation.find(':text').val('');
        divaffiliation.find(':input').val('');
    }
    $('#chkAffiliation').on('switchChange.bootstrapSwitch', function() {
        if (this.checked) {
            divaffiliation.fadeIn();
        }
        else {
            divaffiliation.fadeOut();
            divaffiliation.find(':text').val('');
            divaffiliation.find(':input').val('');
        }
    });

    //Show/Hide div Travauxinvestissement
    var divtravauxinvestissement = $('#divTravauxinvestissement');
    if (!$('#chkTravauxinvestissement').prop('checked')){
        divtravauxinvestissement.hide();
        divtravauxinvestissement.find(':text').val('');
        divtravauxinvestissement.find(':input').val('');
    }
    $('#chkTravauxinvestissement').on('switchChange.bootstrapSwitch', function() {
        if (this.checked) {
            $('#divTravauxinvestissement').fadeIn();
        }
        else {
            divtravauxinvestissement.fadeOut();
            divtravauxinvestissement.find(':text').val('');
            divtravauxinvestissement.find(':input').val('');
        }
    });

    //Show/Hide div activites payantes
    var divactivitepayantes = $('#divActivitespayantes');
    if (!$('#chkActivitespayantes').prop('checked')){
        divactivitepayantes.hide();
        divactivitepayantes.find(':text').val('');
        divactivitepayantes.find(':input').val('');
    }
    $('#chkActivitespayantes').on('switchChange.bootstrapSwitch', function() {
        if (this.checked) {
            $('#divActivitespayantes').fadeIn();
        }
        else {
            divactivitepayantes.fadeOut();
            divactivitepayantes.find(':text').val('');
            divactivitepayantes.find(':input').val('');
        }
    });

    //Show/Hide div taches secretariat
    var divtachessecretariat = $('#divtachesSecretariat');
    if (!$('#chktachesSecretariat').prop('checked')){
        divtachessecretariat.hide();
        divtachessecretariat.find(':text').val('');
        divtachessecretariat.find(':input').val('');
    }
    $('#chktachesSecretariat').on('switchChange.bootstrapSwitch', function() {
        if (this.checked) {
            $('#divtachesSecretariat').fadeIn();
        }
        else {
            divtachessecretariat.fadeOut();
            divtachessecretariat.find(':text').val('');
            divtachessecretariat.find(':input').val('');
        }
    });

    //    Toggle Next/Previous div in modal
    $('#next-modal').click(function() {
        $('.current').removeClass('current').hide()
            .next().show().addClass('current');
        if ($('.current').hasClass('last')) {
            $('#next-modal').attr('disabled', true);
            $('#finish-modal').attr('disabled', false);
        }
        $('#prev-modal').attr('disabled', null);
    });

    $('#prev-modal').click(function() {
        $('.current').removeClass('current').hide()
            .prev().show().addClass('current');
        if ($('.current').hasClass('first')) {
            $('#prev-modal').attr('disabled', true);
        }
        $('#next-modal').attr('disabled', null);
    });

    //Popover functions
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover({container: 'body'});
    });

    $('body').on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });
});



