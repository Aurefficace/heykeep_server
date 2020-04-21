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

function displayFadeIn(target) {
    console.log(target)
    $(target).fadeToggle();
}
