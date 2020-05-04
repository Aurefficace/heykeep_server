function callAjaxMasterDetail(path, target, parent){
    $.ajax({
        method: "GET",
        url: path,
        success: function(data){
           $(parent).fadeOut();
           $(target).html(data).fadeIn();
        }
    });
}

function displayFadeIn(target, parentone, parenttwo) {
    $(target).fadeIn();
    $(parentone).fadeOut();
    $(parenttwo).fadeOut();
}
//prévisualisation image espace
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
    
        reader.onload = function (e) {
            $('#imagePreview').attr('src', e.target.result);
        }
    
        reader.readAsDataURL(input.files[0]);
    }
    }