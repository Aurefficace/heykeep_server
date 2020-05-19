$(document).ready(function () {


  const $discussionList = $("#discussion_list");
  showSpinner($discussionList.parent());
  $.ajax({
    method: "GET",
    url: "discussion",
    success: function (data) {
      $discussionList.html(data);
      hideSpinner($discussionList.parent());
    },
  });
});

function discussionFormCallback() {
  const formDiscussion = $(".formDiscussion");
  const $discussionList = $("#discussion_list");
  const $discussionAdd = $("#discussion_add");

  formDiscussion.ajaxForm({
    success: function (datas) {
      if (datas.success) {
        showModal(datas.success, "success", "Success");
        $.ajax({
          method: "GET",
          url: "discussion",
          success: function (data) {
            $discussionAdd.fadeOut();
            $discussionList.html(data).fadeIn();
          },
        });
      } else if (datas.error) {
        showModal(datas.success, "error", "Erreur");
      }
    },
    error: function (xhr, status, error) {},
  });
  $("#discussion_id_space")
    .chosen()
    .change(function () {
      const id_space = $(this).chosen().val();
      $.ajax({
        method: "POST",
        url: $("#discussion-targets").data("target-users-by-space"),
        data: { id: id_space },
        success: function (data) {
          if (data.success) {
            const myNewvalue = data.success;
            $("#discussion_id_user").empty();
            for (let data in myNewvalue) {
              $("#discussion_id_user").append(
                $("<option></option>")
                  .attr("value", data)
                  .text(myNewvalue[data])
              );
            }
            $("#discussion_id_user").trigger("chosen:updated");
          }
          if (data.error) {
            showModal(datas.error, "error", "Erreur");
          }
        },
      });
    });
}

function addNewMessage() {
  const $form = $("#new_message");
  $form.ajaxForm({
    success: function (datas) {
      if (datas.success) {
        showModal(datas.success, "success", "Success");
        const $newMessage = $("#message-template").contents().clone();
        $("#messageList").append($newMessage);
        $newMessage.find(".message-content").html(datas.success.message);
        $newMessage.find(".date-message").html(datas.success.date.date);
        $newMessage.find(".nameUser-message").html(datas.success.user.name);
        $newMessage
          .find(".img-message")
          .attr(
            "src",
            "user/profile/" +
              datas.success.user.id +
              "/" +
              datas.success.user.avatar
          );
        $newMessage.removeAttr("hidden");
        scrollToBottom();
      } else if (datas.error) {
        console.log('erro new disc.js')
        showModal(datas.success, "error", "Erreur");
      }
    },
    error: function (xhr, status, error) {},
  });
}

function scrollToBottom() {
  var objDiv = document.getElementById("messageList");
  objDiv.scrollTop = 99999999;
}
