
showSpinner()
$.ajax({
    method: "GET",
    url: 'discussion',
    success: function(data) {
        $('#discussion_list').html(data);
        hideSpinner();
    }
})
function callAjaxMasterDetail(path, target, parent){
    showSpinner();
    $.ajax({
        method: "GET",
        url: path,
        success: function(data){
           $(parent).fadeOut();
           $(target).html(data).fadeIn();
           hideSpinner();
        }
    });
}

function displayFadeIn(target) {
    console.log(target)
    $(target).fadeToggle();
}
