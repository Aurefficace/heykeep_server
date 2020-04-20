(function ($) {
const form = $('#reset_password')
  form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      passwordConfirmation: {
            equalTo: "#inputPassword"
        }
    }
});


  if($('#success').length) {
    setTimeout((document.location.href = '/'), 5000);
  }
  
  
})(jQuery);
