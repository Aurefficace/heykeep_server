function callAjaxMasterDetail(path, target, parent) {
  showSpinner($(parent).parent());
  $.ajax({
    method: "GET",
    url: path,
    success: function (data) {
      $(parent).fadeOut();
      $(target).html(data).fadeIn();
      const $dataForm = $(target).find("form");
      if($dataForm.length > 0) {
        initForm($dataForm);
      }
      hideSpinner($(parent).parent());
      if (typeof $dataForm.data('callback') !== 'undefined') {
          runFunctionByName($dataForm.data('callback'));
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


/**
 * Send callback function
 * @param name string function name
 * @param arguments array arguments
 */
function runFunctionByName(name, arguments) {
    var fn = window[name];
    if(typeof fn !== 'function')
        return;
    return fn.apply(window, arguments);
}

function updateImagePreview($input,$target) {
  if ($input.files && $input.files[0]) {
    const reader = new FileReader();

    reader.onload = function (e) {
      $target.attr('src', e.target.result);
    };

    reader.readAsDataURL($input.files[0]); // convert to base64 string
  }
}