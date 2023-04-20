import { alertConfirm } from '../../../utils/alert';
import changeFormUrlWithId from '../../../utils/replace-form-url-with-id';

$(function(){
    let defaultEditUrl = $("#form-edit").attr("action");
    let defaultDeleteUrl = $("#form-delete").attr("action");

    $(".btn-edit").on("click", function(){
        const user = $(this).data("user");

        console.log(user.roles);

        $("#edit-name").val(user.name);
        $("#edit-email").val(user.email);
        $("#edit-phone").val(user.phone);
        $("#edit-address").val(user.address);

        user.roles.forEach(role => {
            $(`#edit-roles-${role.id}`).attr("checked", true);
        });

        changeFormUrlWithId(user.id, defaultEditUrl, "#form-edit");
    })

    // $(".btn-delete").on("click", function(){
    //     changeFormUrlWithId($(this).data("id"), defaultDeleteUrl, "#form-delete");

    //     alertConfirm(()=>{
    //         $("#form-delete").trigger("submit");
    //     })
    // });
});
