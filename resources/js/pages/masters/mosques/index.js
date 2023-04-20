import { alertConfirm } from '../../../utils/alert';
import changeFormUrlWithId from '../../../utils/replace-form-url-with-id';

$(function(){
    let defaultEditUrl = $("#form-edit").attr("action");
    let defaultDeleteUrl = $("#form-delete").attr("action");

    $(".btn-edit").on("click", function(){
        const mosque = $(this).data("mosque");

        $("#edit-name").val(mosque.name);
        $("#edit-latitude").val(mosque.latitude);
        $("#edit-longitude").val(mosque.longitude);
        $("#edit-village").val(mosque.village_id);

        changeFormUrlWithId(mosque.id, defaultEditUrl, "#form-edit");
    })

    $(".btn-delete").on("click", function(){
        changeFormUrlWithId($(this).data("id"), defaultDeleteUrl, "#form-delete");

        alertConfirm(()=>{
            $("#form-delete").trigger("submit");
        })
    });
});
