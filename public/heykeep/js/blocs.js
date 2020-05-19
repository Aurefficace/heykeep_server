$(document).ready(function () {
    console.log('symfony c"est nase')
    initForm($(".formBloc"));
})
function BlocFormCallback() {
    console.log("BlocFormCallback");
    $("#bloc_idSpace")
      .chosen()
      .change(function () {
          const id_space = $(this).chosen().val();
          console.log(id_space);
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
}

function newBloc(target) {

}