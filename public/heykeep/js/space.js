// function callAjaxMasterDetail(path, target, parent){
//     $.ajax({
//         method: "GET",
//         url: path,
//         success: function(data){
//            $(parent).fadeOut();
//            $(target).html(data).fadeIn();
//         }
//     });
// }

// function displayFadeIn(target, parentone, parenttwo) {
//     $(target).fadeIn();
//     $(parentone).fadeOut();
//     $(parenttwo).fadeOut();
// }

function readURL(input) { // TODO mat à mutualiser car c'est utilisé ailleurs
    if (input.files && input.files[0]) {
        var reader = new FileReader();
    
        reader.onload = function (e) {
            $('#imagePreview').attr('src', e.target.result);
        }
    
        reader.readAsDataURL(input.files[0]);
    }
}

function spaceFormCallback(){
    console.log("spaceFormCallback");

    $("#space_tmpUser").autocompleter({
        url_list: $usefullTargets.data("target-search-user-autocomplete"),
        url_get: $usefullTargets.data("target-get-user-autocomplete"),
        otherOptions: { // TODO mat changer les phrases en anglais et les autres paramètres en fonction de vos besoins
            minimumInputLength: 3,
            formatNoMatches: 'No author found.',
            formatSearching: 'Looking authors...',
            formatInputTooShort: 'Insert at least 3 characters'
        }
    });
}