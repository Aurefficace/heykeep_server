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

function afterCallAjaxMasterDetail() {
  const formDiscussion = $(".formDiscussion");
  const $discussionList = $("#discussion_list");
  const $discussionAdd = $('#discussion_add');
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
}


