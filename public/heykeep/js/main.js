function callAjaxMasterDetail(path, target, parent) {
  showSpinner($(parent).parent());
  $.ajax({
    method: "GET",
    url: path,
    success: function (data) {
      $(parent).fadeOut();
      $(target).html(data).fadeIn();
      hideSpinner($(parent).parent());
      if (
        typeof afterCallAjaxMasterDetail != null &&
        $.isFunction(afterCallAjaxMasterDetail)
      ) {
        afterCallAjaxMasterDetail();
      }
    },
  });
}

function displayFadeIn(target) {
  console.log(target);
  $(target).fadeToggle();
}
/*===========[ notification ]=========================*/

function showModal(message, type, titre) {
  const $toast = $(".toast");
  $toast.removeClass(" btn-success btn-danger btn-warning");

  if (type === "success") {
    $toast.addClass(" btn-success");
    $("#notifTitle").html(titre);
    $("#notifContent").html(message);
    $toast.toast({ delay: 7000 }).toast("show");
  } else if (type === "error") {
    $toast.addClass("btn-danger");
    $("#notifTitle").html(titre);
    $("#notifContent").html(message);
    $toast.toast("show");
  } else if (type === "warning") {
    $toast.addClass("btn-warning");
    $("#notifTitle").html(titre);
    $("#notifContent").html(message);
    $toast.toast({ delay: 7000 }).toast("show");
  }
}

/*===========[ spinner ]=========================*/

function showSpinner($zone) {
  let $spinner = $(".spinner-border", $zone);
  if (typeof $zone === "undefined" || $spinner.length === 0) {
    $spinner = $("#spinner-master");
  }
  $spinner.show();
}
function hideSpinner($zone) {
  let $spinner = $(".spinner-border", $zone);
  if (typeof $zone === "undefined" || $spinner.length === 0) {
    $spinner = $("#spinner-master");
  }
  $spinner.hide();
}


function initForm($form) {
    //region Initialisation du validator
    // $form.validate({
    //     errorPlacement: function errorPlacement(error, element) {
    //         element.before(error);
    //     },
    //     rules: {
    //         nom_de_champs: {
    //             regle: detail,
    //         },
    //     },
    // });
    //endregion Initialisation du validator

    //region initialisation des composants
    //Chosen
    $("select", $form).each(function(){
          $(this).chosen({width: "100%", search_contains:true});
    });
    //endregion initialisation des composants
}