$(document).ready(function() {
  //   $usefullTargets = $("#usefull-targets");
  // console.log($usefullTargets)
  //     // URL is a built-in JavaScript class to manipulate URLs
  // const url = new URL("http://127.0.0.1:3000/.well-known/mercure");
  // url.searchParams.append("topic", "http://127.0.0.1/instantmessages/" + $usefullTargets.attr("data-idUser"));
  // const eventSource = new EventSource(url, {withCredentials: true} );
  // console.log('ready disc.js', eventSource);
  // eventSource.onopen = function() {
  //   console.log("Connexion au serveur établie.");
  // };
  // eventSource.onmessage = (event) => {
  //   console.log(event.data);
  //   event = JSON.parse('event', event.data)
  //   const $newMessage = $("#message-template").contents().clone();
  //   $("#messageList").append($newMessage);
  //   $newMessage.find(".message-content").html(event.success.message);
  //   $newMessage.find(".date-message").html(event.success.date.date);
  //   $newMessage.find(".nameUser-message").html(event.success.user.name);
  //   $newMessage
  //     .find(".img-message")
  //     .attr(
  //       "src",
  //       "user/profile/" +
  //         event.success.user.id +
  //         "/" +
  //         event.success.user.avatar
  //     );
  //   $newMessage.removeAttr("hidden");
  //   scrollToBottom();
  // };
  // eventSource.onerror = (event) => {
  //   console.log("rror", event);
  // };
});


function callAjaxMasterDetail(path, target, parent, externalBackButton) {
  const $externalBackButton = $(externalBackButton);
  showSpinner($(parent).parent());
  $.ajax({
    method: "GET",
    url: path,
    success: function (data) {
      $(parent).fadeOut();
      $(target).html(data).fadeIn();
      if($externalBackButton.length > 0) {
        $externalBackButton.fadeIn();
      }
      const $dataForm = $(target).find("form");
      if($dataForm.length > 0) {
        initForm($dataForm);
      }
      hideSpinner($(parent).parent());
      $dataForm.each(function() {
          if (typeof $(this).data('callback') !== 'undefined') {
              runFunctionByName($(this).data('callback'));
          }
      })
    }
  });
}

function callAjaxPopup(path) {
  showSpinner();
  $.ajax({
    method: "GET",
    url: path,
    success: function (data) {
      let $modal = $("#centermodal");
      $modal.find(".modal-body").html(data).fadeIn();
      $modal.modal();
      const $dataForm = $modal.find("form");
      if($dataForm.length > 0) {
        initForm($dataForm);
      }
      hideSpinner();
      $dataForm.each(function() {
          if (typeof $(this).data('callback') !== 'undefined') {
              runFunctionByName($(this).data('callback'));
          }
      })
    }
  });
}

function displayFadeToggle(target) {
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

// Ajout global des tooltip Bootstrap info bulle quand on passe la souris sur un élément.
$( function() {
  $('[data-toggle="tooltip"]').tooltip()
} );