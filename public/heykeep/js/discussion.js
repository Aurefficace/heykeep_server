
    showSpinner();
    $.ajax({
    method: "GET",
    url: 'discussion',
    success: function(data) {
        $('#discussion_list').html(data);
        hideSpinner();
    }
})


 function afterCallAjaxMasterDetail() {
     console.log('fuck');
 }
 
