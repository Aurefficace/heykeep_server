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
