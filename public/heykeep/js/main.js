(function ($) {
  "use strict";
})(jQuery);
/*===========[ notification ]=========================*/

function showModal(message, type, titre) {
  if (type === "success") {
    $(".toast").addClass("alert btn-success");
    $("#closeButton").addClass(" btn-success");
    $("#notifTitle").append(titre);
    $("#notifContent").append(message);
    $(".toast").toast("show");
    setTimeout(() => $(".toast").toast("hide"), 3000); // temps avant la disparition du modal < à la redirection 5s
  } else if (type === "error") {
    $(".toast").addClass("alert btn-danger");
    $("#closeButton").addClass(" btn-danger");
    $("#notifTitle").append(titre);
    $("#notifContent").append(message);
    $(".toast").toast("show");
    setTimeout(() => $(".toast").toast("hide"), 3000);
  } else if (type === "warning") {
    $(".toast").addClass("alert btn-warning");
    $("#closeButton").addClass(" btn-warning");
    $("#notifTitle").append(titre);
    $("#notifContent").append(message);
    $(".toast").toast("show");
    setTimeout(() => $(".toast").toast("hide"), 3000);
  }
}
