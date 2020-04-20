(function ($) {
  const urlLogin = "http://127.0.0.1:8000/login";


  if($('#success').length) {
    setTimeout((document.location.href = urlLogin), 5000);
  }
  
  
})(jQuery);
