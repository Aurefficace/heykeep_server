  $(document).ready(function () {
    const $form = $("#formResetPassword");
    const $formChangePassword = $("#buttonChangePassword");
      $formChangePassword.click(function () {
      $form.show();
      $formChangePassword.hide();
      $form.validate({
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
    $form.ajaxForm({
      success: function (datas) {
        if (datas.success) {
          showModal(datas.success, 'success', 'Success');
          $('#inputPassword' || '#inputPasswordConfirmation').val() == ''
            $("input[type=password]").val("");
            $form.hide();
            $formChangePassword.show();
        } else if (datas.error) {
          showModal(datas.success, 'error', 'Erreur');
        }
      },
      error: function (xhr, status, error) {

      },
    });
    $("#buttonChangeAvatar").click(function () {
      const $formAvatar = $("#formChangeAvatar");
      $formAvatar.show();
      $formAvatar.on('change', function () {
        $formAvatar.submit();
        $formAvatar.hide();
      });
      $formAvatar.ajaxForm({
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