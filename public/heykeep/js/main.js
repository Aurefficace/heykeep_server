
(function ($) {
    "use strict";

    

     /*===========[ notification ]=========================*/

     function showModal(message, type, titre) {
        if (type === success) {
            $(".toast").addClass("alert alert-success");
            $("#notifTitle").append(titre);
            $("#notifContent").append(message);
            $('.toast').toast('show');
        }
        else if (type === error) {
            $(".toast").addClass("alert alert-danger");
            $("#notifTitle").append(titre);
            $("#notifContent").append(message);
            $('.toast').toast('show');
        }
     }

})(jQuery);