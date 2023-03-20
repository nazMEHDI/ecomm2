$(function(){
    $("body").on("click", ".btnAddCategoriestable", function(){
        modalUrl = '/melis/MelisCore/MelisGenericModal/emptyGenericModal';
        melisHelper.createModal("id_categoriestable_modal", "categoriestable_modal", false, {}, modalUrl);
    });

    $("body").on("click", ".btnSaveCategoriestable", function(){
        var btn = $(this);
        var id = $(this).data("id");
        submitForm($("form#categoriestableForm"), id, btn);
    });

    var submitForm  = function(form, id, btn){

        form.unbind("submit");

        form.on("submit", function(e) {

            e.preventDefault();

            btn.attr('disabled', true);

            var formData = new FormData(this);

            formData.append('id', id);



            $.ajax({
                type: 'POST',
                url: '/melis/Categoriestable/Properties/save',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
            }).done(function (data) {
                if(data.success){
                    // Notifications
                    melisHelper.melisOkNotification(data.textTitle, data.textMessage);

                    $("#id_categoriestable_modal_container").modal("hide");
                    melisHelper.zoneReload("id_categoriestable_content", "categoriestable_content");
                }else{
                    melisHelper.melisKoNotification(data.textTitle, data.textMessage, data.errors);
                    melisHelper.highlightMultiErrors(data.success, data.errors, "#id_categoriestable_modal");
                }

                btn.attr('disabled', false);
            }).fail(function () {
                alert(translations.tr_meliscore_error_message);
            });
        });

        form.submit();
    };

    $("body").on("click", ".btnEditCategoriestable", function(){
        var id = $(this).parents("tr").attr("id");
        var modalUrl = '/melis/MelisCore/MelisGenericModal/emptyGenericModal';
        melisHelper.createModal("id_categoriestable_modal", "categoriestable_modal", false, {id : id}, modalUrl);
    });

    $("body").on("click", ".btnDeleteCategoriestable", function(){
        var id = $(this).parents("tr").attr("id");

        melisCoreTool.confirm(
            translations.tr_categoriestable_common_button_yes,
            translations.tr_categoriestable_common_button_no,
            translations.tr_categoriestable_delete_title,
            translations.tr_categoriestable_delete_confirm_msg,
            function(data) {
                $.ajax({
                    type        : 'GET',
                    url         : '/melis/Categoriestable/List/deleteItem?id='+id,
                    dataType    : 'json',
                    encode		: true,
                    success		: function(data){
                        // refresh the table after deleting an item
                        melisHelper.zoneReload("id_categoriestable_content", "categoriestable_content");

                        // Notifications
                        melisHelper.melisOkNotification(data.textTitle, data.textMessage);

                        
                    }
                });
            });
    });
});