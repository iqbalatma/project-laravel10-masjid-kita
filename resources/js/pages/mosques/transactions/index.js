import changeFormUrlWithId from '../../../utils/replace-form-url-with-id';

$(function () {
    let defaultEditUrl = $("#form-approval").attr("action");

    $(".btn-approval").on("click", function () {
        const transaction = $(this).data("transaction");
        changeFormUrlWithId(transaction.id, defaultEditUrl, "#form-approval");
    })

    $(".btn-detail-image").on("click", function () {
        const transactions = $(this).data("transaction");
        const imageRow = $("#modal-image-detail");
        imageRow.empty();
        console.log(transactions.transaction_images)
        transactions.transaction_images.forEach((image) => {
            let url = window.location.origin + "/images/" + image.image.replace("/", "_");
            console.log(url)
            const col = $("<div>", {
                class: "col-md-4"
            });

            const a = $("<a>", {
                attr: {
                    href: url
                }
            });

            const imageEl = $("<img>", {
                class: "img-thumbnail",
                attr: {
                    alt: "gambar-transaksi",
                    src: url
                }
            });
            imageEl.appendTo(a)
            a.appendTo(col)

            imageRow.append(col);
        });
    })
});
