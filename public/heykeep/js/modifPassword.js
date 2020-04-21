$(document).ready(function(){     
    $("#b1").click(function(){
        $("#form1").show();
        $("#b1").hide();
    });
    $("#b2").click(function(){
        $("#form1").hide();
        $("#b1").show();
    });
    const form = $("#form1");
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
