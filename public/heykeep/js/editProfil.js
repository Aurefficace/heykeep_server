  $(document).ready(function(){     
    $("#buttonChangePassword").click(function(){
      $("#formResetPassword").show();
      $("#buttonChangePassword").hide();
    });
    $("#buttonResetPassword").click(function(){
      $("#formResetPassword").hide();
      $("#buttonChangePassword").show();
    });
    const form = $("#formResetPassword");
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
          
        }
        else if (datas.error) {
          showModal(datas.success, 'error', 'Erreur');
        }
      },
      error: function (xhr, status, error) {
        
      },
    });
      $("#buttonChangeAvatar").click(function(){
      const formAvatar =$("#formChangeAvatar");
      formAvatar.show();   
      formAvatar.on('change', function(){
        formAvatar.submit();
        formAvatar.hide();
      });
      
      formAvatar.ajaxForm({
        success: function (datas) {
          if (datas.success) {
            showModal(datas.success, 'success', 'Success');
            
          }
          else if (datas.error) {
            showModal(datas.success, 'error', 'Erreur');
          }
        },
        error: function (xhr, status, error) {
          
        },
      });
      
    });
    
  });
