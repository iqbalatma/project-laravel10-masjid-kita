import changeFormUrlWithId from '../../../utils/replace-form-url-with-id';

$(function(){
    let defaultEditUrl = $("#form-edit").attr("action");

    $(".btn-edit").on("click", function(){
        const subdistrict = $(this).data("subdistrict");

        $("#edit-code").val(subdistrict.code);
        $("#edit-name").val(subdistrict.name);

        changeFormUrlWithId(subdistrict.id, defaultEditUrl, "#form-edit");
    })
});
