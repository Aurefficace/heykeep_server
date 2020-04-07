var form = $("#example-form");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password"
        }
    }
});
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    labels: {
        cancel: 'Annuler',
        current: '',
        finish: "C'est parti",
        next: "Suivant",
        previous: "Précédent",
        loading: "Chargement ..."
    },
    onStepChanging: function (event, currentIndex, newIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden";

        var $currentTab = $("#"+$(event.target).attr("id")+"-p-"+currentIndex);
        $("input", $currentTab).each(function(){
            var inputId = $(this).attr("id");
            $("span#recapitulatif-"+inputId).html($(this).val());
        });
        return form.valid();


    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        alert("Submitted!");
    }
});


