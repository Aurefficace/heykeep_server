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
  const form = $(".form");
  const $discussionList = $("#discussion_list");
  const $discussionAdd = $('#discussion_add');
  form.ajaxForm({
    success: function (datas) {
      if (datas.success) {
        showModal(datas.success, "success", "Success");
        $.ajax({
          method: "GET",
          url: "discussion",
          success: function (data) {
            $discussionAdd.fadeOut();
            $discussionList.html(data).fadeIn();
            initForm($discussionList.find("form"));
          },
        });
      } else if (datas.error) {
        showModal(datas.success, "error", "Erreur");
      }
    },
    error: function (xhr, status, error) {},
  });
}
