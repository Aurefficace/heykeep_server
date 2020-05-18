$(document).ready(function () {
    console.log('symfony c"est nase')
 
})
function BlocFormCallback() {
    $("#categories_id_space")
      .chosen()
      .change(function () {
        const id_space = $(this).chosen().val();
        $.ajax({
          method: "POST",
          url: $("#bloc_new").data("target-categories-by-space"),
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