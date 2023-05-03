import changeFormUrlWithId from '../../../utils/replace-form-url-with-id';

$(function(){
    let defaultEditUrl = $("#form-approval").attr("action");

    $(".btn-approval").on("click", function(){
        const transaction = $(this).data("transaction");
        changeFormUrlWithId(transaction.id, defaultEditUrl, "#form-approval");
    })
});
