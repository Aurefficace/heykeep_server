
/*===========[ notification ]=========================*/

function showModal(message, type, titre) {
    const $toast = $(".toast");
    $toast.removeClass(" btn-success btn-danger btn-warning");
    
  if (type === "success") {
    $toast.addClass(" btn-success");
    $("#notifTitle").html(titre);
    $("#notifContent").html(message);
    $toast.toast({delay: 7000}).toast("show");
    
  } else if (type === "error") {
    $toast.addClass("btn-danger");
    $("#notifTitle").html(titre);
    $("#notifContent").html(message);
    $toast.toast("show");

  } else if (type === "warning") {
    $toast.addClass("btn-warning");
    $("#notifTitle").html(titre);
    $("#notifContent").html(message);
    $toast.toast({delay: 7000}).toast("show");
 
  }
}
