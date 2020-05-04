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