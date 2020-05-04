  $(document).ready(function () {
    const form = $("#formResetPassword");
      $("#buttonChangePassword").click(function () {
      $("#formResetPassword").show();
      $("#buttonChangePassword").hide();
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
    });
    //contrôle les champs vides
   /* $('#buttonResetPassword').click(function () {
      if ($('#inputPassword' || '#inputPasswordConfirmation').val() == '') {
        alert('Veuillez remplir les champs vides')
        return false
      }
    });*/
    
   
    form.ajaxForm({
      success: function (datas) {
        if (datas.success) {
          showModal(datas.success, 'success', 'Success');
          $('#inputPassword' || '#inputPasswordConfirmation').val() == ''
            $("input[type=password]").val("");
            $("#formResetPassword").hide();
            $("#buttonChangePassword").show();
        } else if (datas.error) {
          showModal(datas.success, 'error', 'Erreur');
        }
      },
      error: function (xhr, status, error) {

      },
    });
    $("#buttonChangeAvatar").click(function () {
      const formAvatar = $("#formChangeAvatar");
      formAvatar.show();
      formAvatar.on('change', function () {
        formAvatar.submit();
        formAvatar.hide();
      });
      formAvatar.ajaxForm({
        success: function (datas) {
          if (datas.success) {
            showModal(datas.success, 'success', 'Success');
            location.reload(true);

          } else if (datas.error) {
            showModal(datas.success, 'error', 'Erreur');
          }
        },
        error: function (xhr, status, error) {

        },
      });

    });

  });