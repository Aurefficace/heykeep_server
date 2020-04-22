$(document).ready(function(){     
    $("#b1").click(function(){
        $("#formResetPassword").show();
        $("#b1").hide();
    });
    $("#b2").click(function(){
        $("#formResetPassword").hide();
        $("#b1").show();
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
    $("#b3").click(function(){
      $("#formChangeAvatar").show();
      const formAvatar =$("#formChangeAvatar");
      $("#avatar").on('change', function(){
        formAvatar.submit();
        $("#avatar").hide();
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
