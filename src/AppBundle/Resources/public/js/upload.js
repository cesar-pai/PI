/**
 * Created by Antoine on 10/28/2015.
 */
$(document).on('change', '.btn-file :file', function() {
    if ($(this).get(0).files.length > 1) {
        alert("Vous ne pouvez envoyer qu'un seul fichier");
        return false;
    } else {
        var input = $(this), label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', label);
    }

});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });

    $(":button.upload").on('click',(function(event){
        event.preventDefault();
        var progress = $(this).parent().parent().parent().find('progress#progress');
        var formData = new FormData();
        var file = $(this).parent().parent().find('input[type=file]').prop('files')[0];
        formData.append('file',file);
        $.ajax({
            url: 'upload.php', //script qui traitera l'envoi du fichier
            type: 'POST',
            xhr: function() { // xhr qui traite la barre de progression
                myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){ // vérifie si l'upload existe
                    myXhr.upload.addEventListener('progress',afficherAvancement, false); // Pour ajouter l'évènement progress sur l'upload de fichier
                }
                return myXhr;
            },
            //Traitements AJAX
            beforeSend: function()   // A function to be called before sending request
            {
                $("input[type=button]").attr("disabled", "disabled");
                progress.fadeIn();
                progress.next('strong').remove();
                $('<strong style="display: block"></strong>').insertAfter(progress);
            },
            success: function()   // A function to be called if request succeeds
            {
                $("input[type=button]").removeAttr("disabled");
                alert("Envoi du fichier réussi !");
                progress.next('strong').html('Fichier envoyé !');
                progress.fadeOut("slow");
            },
            error: function()   // A function to be called if request fails
            {
                $("input[type=button]").removeAttr("disabled");
                alert("Erreur lors de l'envoi du fichier");
            },
            data: formData,
            //Options signifiant à jQuery de ne pas s'occuper du type de données
            cache: false,
            contentType: false,
            processData: false
        });

        function afficherAvancement(e){
            if(e.lengthComputable){
                var val = Math.round(e.loaded/e.total * 100);
                progress.attr({value:e.loaded,max:e.total});
                progress.next('strong').html('Téléchargement du fichier... '+val+'%');
            }
        }
        return false;
    }));
});