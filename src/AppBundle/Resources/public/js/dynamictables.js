/**
 * Created by Antoine on 10/29/2015.
 */
$(document).ready(function(){
    // setup links
    var $addMBLink = $('<a href="#" class="add_mb_link btn btn-default btn-block pull-left">Ajouter une ligne</a>');
    var $addMCLink = $('<a href="#" class="add_mc_link btn btn-default btn-block pull-left">Ajouter une ligne</a>');
    var $addIALink = $('<a href="#" class="add_ia_link btn btn-default btn-block pull-left">Ajouter une ligne</a>');
    var $addSUBLink = $('<a href="#" class="add_sub_link btn btn-default btn-block pull-left">Ajouter une ligne</a>');
    var $addFMLink = $('<a href="#" class="add_fm_link btn btn-default btn-block pull-left">Ajouter une ligne</a>');
    var $addMANLink = $('<a href="#" class="add_man_link btn btn-default btn-block pull-left">Ajouter une ligne</a>');
    var $addACTLink = $('<a href="#" class="add_act_link btn btn-default btn-block pull-left">Ajouter une ligne</a>');
    var $addMADLink = $('<a href="#" class="add_mad_link btn btn-default btn-block pull-left">Ajouter une ligne</a>');

    // Collections holders
    var $collectionHolderMB = $('tbody.membrebureau');
    var $collectionHolderMC = $('tbody.membreconseiladministration');
    var $collectionHolderIA = $('tbody.categorieadherent');
    var $collectionHolderSUB = $('tbody.subventions');
    var $collectionHolderFM = $('tbody.faitsmarquants');
    var $collectionHolderMAN = $('tbody.manifestations');
    var $collectionHolderACT = $('tbody.actions');
    var $collectionHolderMAD = $('tbody.miseadispo');

    // Add links
    $collectionHolderMB.append($addMBLink);
    $collectionHolderMC.append($addMCLink);
    $collectionHolderIA.append($addIALink);
    $collectionHolderSUB.append($addSUBLink);
    $collectionHolderFM.append($addFMLink);
    $collectionHolderMAN.append($addMANLink);
    $collectionHolderACT.append($addACTLink);
    $collectionHolderMAD.append($addMADLink);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolderMB.data('index', $collectionHolderMB.find(':input').length);
    $collectionHolderMC.data('index', $collectionHolderMC.find(':input').length);
    $collectionHolderIA.data('index', $collectionHolderIA.find(':input').length);
    $collectionHolderSUB.data('index', $collectionHolderSUB.find(':input').length);
    $collectionHolderFM.data('index', $collectionHolderFM.find(':input').length);
    $collectionHolderMAN.data('index', $collectionHolderMAN.find(':input').length);
    $collectionHolderACT.data('index', $collectionHolderACT.find(':input').length);
    $collectionHolderMAD.data('index', $collectionHolderMAD.find(':input').length);

    $addMBLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addForm($collectionHolderMB, $addMBLink);
    });

    $addMCLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addForm($collectionHolderMC, $addMCLink);
    });

    $addIALink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addForm($collectionHolderIA, $addIALink);
    });

    $addSUBLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addForm($collectionHolderSUB, $addSUBLink);
    });

    $addFMLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addForm($collectionHolderFM, $addFMLink);
    });

    $addMANLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addForm($collectionHolderMAN, $addMANLink);
    });

    $addACTLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addForm($collectionHolderACT, $addACTLink);
    });

    $addMADLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addForm($collectionHolderMAD, $addMADLink);
    });

    function addForm($collectionHolder, $addLink) {
        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');

        // get the new index
        var index = $collectionHolder.data('index');

        // Replace '$$name$$' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in an tr, before the "Add a tag" link tr
        var $newFormLi = $('<tr></tr>').append(newForm);

        // also add a remove button, just for this example
        $newFormLi.append('<td><a class="remove-tag btn btn-lg btn-default"><i class="fa fa-times"></i></a></td>');

        $addLink.before($newFormLi);

        // handle the removal, just for this example
        $('.remove-tag').click(function(event) {
            event.preventDefault();
            $(this).parent().parent().remove();
            return false;
        });

    }

    // handle the removal, just for this example
    $('.remove-tag').click(function(event) {
        event.preventDefault();
        $(this).parent().parent().remove();
        return false;
    });
});


