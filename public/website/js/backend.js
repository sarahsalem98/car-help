$(document).ready(function(e) {
    $('#fileUploader').change(function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
});

function previewImages() {

    var $preview = $('.preview').empty();
    if (this.files) $.each(this.files, readAndPreview);

    function readAndPreview(i, file) {

        if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
            return alert(file.name + " is not an image");
        } // else...

        var reader = new FileReader();

        $(reader).on("load", function() {
            $preview.append($("<img/>", {
                src: this.result,
                height: 100,
                width: 100

            }));
            // $('#mg').remove();
        });

        reader.readAsDataURL(file);

    }

}

$('#file-input').on("change", previewImages);
$('#file-input2').on("change", previewImages);

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '<?= csrf_token() ?>'
    }
});
$("#form_order").on("submit", function(event) {


    event.preventDefault();

    console.log(new FormData(this));
    $.ajax({

        type: "POST",
        url: "/client/order",
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: new FormData(this),
        success: function(result) {
            console.log(result.result);
            $('#ordersentModal').modal("show");
            $('#form_order').trigger("reset");
            previewImages();
        },
        error: function(result) {

            alert(result.responseJSON.errors.details);
        }
    });
})


$("#form_car_order").on("submit", function(event) {


    event.preventDefault();

    console.log(new FormData(this));
    $.ajax({

        type: "POST",
        url: "/client/car/order",
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: new FormData(this),
        success: function(result) {
            console.log(result.result);
            $('#ordersentModal').modal("show");
            $('#form_order').trigger("reset");
            previewImages();
        },
        error: function(result) {

            alert(result.responseJSON.errors.details);
        }
    });
})