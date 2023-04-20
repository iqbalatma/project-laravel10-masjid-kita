import { alertConfirm } from '../../../utils/alert';
import changeFormUrlWithId from '../../../utils/replace-form-url-with-id';

$(function(){
    let defaultDeleteUrl = $("#form-delete").attr("action");

    $(".btn-delete").on("click", function(){
        changeFormUrlWithId($(this).data("id"), defaultDeleteUrl, "#form-delete");

        alertConfirm(()=>{
            $("#form-delete").trigger("submit");
        })
    })
})
