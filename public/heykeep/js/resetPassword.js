$( document ).ready(function()  {
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
        showModal(datas.success, 'success', 'Success');
        setTimeout(() => (document.location.href = "/"), 5000);
      }
      else if (datas.error) {
        showModal(datas.success, 'error', 'Erreur');
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
        $("#messages").addClass("alert alert-success");
      }
      else if (datas.error) {
        showModal(datas.error, 'error', 'Erreur');
      }
    },
    error: function (xhr, status, error) {

    },
  });
  
})(jQuery);
