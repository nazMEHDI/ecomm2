$(function(){
    $("body").on("click", ".btnAddOrdertable", function(){
        modalUrl = '/melis/MelisCore/MelisGenericModal/emptyGenericModal';
        melisHelper.createModal("id_ordertable_modal", "ordertable_modal", false, {}, modalUrl);
    });

    $("body").on("click", ".btnSaveOrdertable", function(){
        var btn = $(this);
        var id = $(this).data("id");
        submitForm($("form#ordertableForm"), id, btn);
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
                url: '/melis/Ordertable/Properties/save',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
            }).done(function (data) {
                if(data.success){
                    // Notifications
                    melisHelper.melisOkNotification(data.textTitle, data.textMessage);

                    $("#id_ordertable_modal_container").modal("hide");
                    melisHelper.zoneReload("id_ordertable_content", "ordertable_content");
                }else{
                    melisHelper.melisKoNotification(data.textTitle, data.textMessage, data.errors);
                    melisHelper.highlightMultiErrors(data.success, data.errors, "#id_ordertable_modal");
                }

                btn.attr('disabled', false);
            }).fail(function () {
                alert(translations.tr_meliscore_error_message);
            });
        });

        form.submit();
    };

    $("body").on("click", ".btnEditOrdertable", function(){
        var id = $(this).parents("tr").attr("id");
        var modalUrl = '/melis/MelisCore/MelisGenericModal/emptyGenericModal';
        melisHelper.createModal("id_ordertable_modal", "ordertable_modal", false, {id : id}, modalUrl);
    });

    $("body").on("click", ".btnDeleteOrdertable", function(){
        var id = $(this).parents("tr").attr("id");

        melisCoreTool.confirm(
            translations.tr_ordertable_common_button_yes,
            translations.tr_ordertable_common_button_no,
            translations.tr_ordertable_delete_title,
            translations.tr_ordertable_delete_confirm_msg,
            function(data) {
                $.ajax({
                    type        : 'GET',
                    url         : '/melis/Ordertable/List/deleteItem?id='+id,
                    dataType    : 'json',
                    encode		: true,
                    success		: function(data){
                        // refresh the table after deleting an item
                        melisHelper.zoneReload("id_ordertable_content", "ordertable_content");

                        // Notifications
                        melisHelper.melisOkNotification(data.textTitle, data.textMessage);

                        
                    }
                });
            });
    });
});