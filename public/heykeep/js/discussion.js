$.ajax({
    method: "GET",
    url: 'discussion',
    success: function(data) {
        $('#discussion_list').html(data);
    }
})
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
