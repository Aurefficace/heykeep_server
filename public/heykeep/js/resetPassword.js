(function ($) {
  const form = $("#reset_password");
  const forgottenForm = $("#forgotten_password");

  form.validate({
    errorPlacement: function errorPlacement(error, element) {
      element.before(error);
    },
    rules: {
      passwordConfirmation: {
        equalTo: "#inputPassword",
      },
    },
  });

  form.ajaxForm({
    success: function (datas) {
      if (datas.success) {
        $("#messages").append(datas.success);
        $("#messages").addClass("alert alert-success");
        setTimeout((document.location.href = "/"), 10000);
      }
      else if (datas.error) {
        $("#messages").append(datas.error);
        $("#messages").addClass("alert alert-danger");
      }
    },
    error: function (xhr, status, error) {

     },
  });

  forgottenForm.ajaxForm({
    success: function (datas) {
      if (datas.success) {
        jQuery('<a/>', {
          "href": datas.success,
          text: 'clique ici'
      }).appendTo('#messages');
        // $("#messages").append(datas.success);
        $("#messages").addClass("alert alert-success");
      }
      else if (datas.error) {
        $("#messages").append(datas.error);
        $("#messages").addClass("alert alert-danger");
      }
    },
    error: function (xhr, status, error) {
      alert(datas);
     },
  });
  
})(jQuery);
