(function ($) {
  "use strict";
})(jQuery);
/*===========[ notification ]=========================*/

function showModal(message, type, titre) {
    const toast = $(".toast");
    toast.removeClass(" btn-success btn-danger btn-warning");
    
  if (type === "success") {
    toast.addClass(" btn-success");
    $("#notifTitle").append(titre);
    $("#notifContent").append(message);
    toast.toast({delay: 7000}).toast("show");
    
  } else if (type === "error") {
    toast.addClass("btn-danger");
    $("#notifTitle").append(titre);
    $("#notifContent").append(message);
    $(".toast").toast("show");

  } else if (type === "warning") {
    toast.addClass("btn-warning");
    $("#notifTitle").append(titre);
    $("#notifContent").append(message);
    toast.toast({delay: 7000}).toast("show");
 
  }
}
