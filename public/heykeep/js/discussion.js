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
  console.log("coucou fonction discussionFormCallback");
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
        url: "/space/usersBySpace",
        data: { id: id_space },
        success: function (data) {
          if (data.success) {
            showModal(data.success, "success", "Success");
            console.log(data);
          }
          if (data.error) {
            showModal(datas.error, "error", "Erreur");
          }
        },
      });
    });
}
