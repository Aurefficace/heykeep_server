$(document).ready(function () {
    initForm($(".formBloc"));
})
function BlocFormCallback() {
    $("#bloc_idSpace")
      .chosen()
      .change(function () {
          const id_space = $(this).chosen().val();
        $.ajax({
          method: "POST",
          url: $("#bloc-targets").data("target-categories-by-space"),
          data: { id: id_space },
          success: function (data) {
            if (data.success) {
              const myNewvalue = data.success;
              $("#bloc_categorie_id").empty();
              for (let data in myNewvalue) {
                $("#bloc_categorie_id").append(
                  $("<option></option>")
                    .attr("value", data)
                    .text(myNewvalue[data])
                );
              }
              $("#bloc_categorie_id").trigger("chosen:updated");
  
            }
           
          },
        });
      });
      $("#bloc_element_type")
      .chosen()
      .change(function () {
          const elementType = $(this).chosen().val();
          const $blocType = $("#blocType");
          console.log(elementType);
          if (elementType == 0) {
            console.log(elementType)
            $blocType.empty();
            $blocType.append(  $("<textarea name='contentElement'  class='form-control'></textarea>"));
          }
          if (elementType == 1) {
            $blocType.empty();
            $blocType.append(  $("<input name='contentElement' type='file'  class='form-control' />"));          }
          if (elementType == 2) {
            $blocType.empty();
            $blocType.append(  $("<input name='contentElement' type='url'  class='form-control' />"));
          }
        
      });
  
}

function newBloc(target) {

}