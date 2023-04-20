import { alertConfirm } from '../../../utils/alert';
import changeFormUrlWithId from '../../../utils/replace-form-url-with-id';

$(function(){
    let defaultEditUrl = $("#form-edit").attr("action");
    let defaultDeleteUrl = $("#form-delete").attr("action");

    $(".btn-edit").on("click", function(){
        const village = $(this).data("village");

        $("#edit-name").val(village.name);
        $("#edit-postcode").val(village.postcode);
        $("#edit-subdistrict").val(village.subdistrict_id);

        changeFormUrlWithId(village.id, defaultEditUrl, "#form-edit");
    })

    $(".btn-delete").on("click", function(){
        changeFormUrlWithId($(this).data("id"), defaultDeleteUrl, "#form-delete");

        alertConfirm(()=>{
            $("#form-delete").trigger("submit");
        })
    });
});
