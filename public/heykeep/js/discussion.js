$(document).ready(function() {
    let $discussionList = $('#discussion_list');
    showSpinner($discussionList.parent());
    $.ajax({
        method: "GET",
        url: 'discussion',
        success: function(data) {
            $discussionList.html(data);
            hideSpinner($discussionList.parent());
        }
    });
});