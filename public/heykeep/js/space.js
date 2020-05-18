//prévisualisation image espace
function readURL(input) { // TODO mat à mutualiser car c'est utilisé ailleurs
    if (input.files && input.files[0]) {
        var reader = new FileReader();
    
        reader.onload = function (e) {
            $('#imagePreview').attr('src', e.target.result);
        }
    
        reader.readAsDataURL(input.files[0]);
    }
}

// setup an "add a categorie" link
var $addCatLink = $('<a href="#" class="add_cat_link">Ajouter une catégorie</a>');
var $newLinkLi = $('<li></li>').append($addCatLink);

function spaceFormCallback(){

    // Get the ul that holds the collection of categories
    var $collectionHolder = $('ul.categories');

    // add the "add a categorie" anchor and li to the categories ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addCatLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new categorie form (see code block below)
        addCatForm($collectionHolder, $newLinkLi);
    });


};

function addCatForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a categorie" link li
    var $newFormLi = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormLi.append('<a href="#" class="remove-categorie">x</a>');

    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    $('.remove-categorie').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

// Essai d'autocompletion, non fonctionnelle pour l'instant
// function spaceFormCallback(){
//     console.log("spaceFormCallback");
//
//     $("#space_tmpUser").autocompleter({
//         url_list: $usefullTargets.data("target-search-user-autocomplete"),
//         url_get: $usefullTargets.data("target-get-user-autocomplete"),
//         otherOptions: {
//             minimumInputLength: 2,
//             formatNoMatches: 'Aucun utilisateur.',
//             formatSearching: 'Recherche utilisateur...',
//             formatInputTooShort: 'Ecrire au min trois caractères'
//         }
//     });
// }