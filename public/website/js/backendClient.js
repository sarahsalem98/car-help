// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': '<?= csrf_token() ?>'
//     }
// });

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });



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

// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': '<?= csrf_token() ?>'
//     }
// });
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
            console.log("fd");
            $('#ordersentModal').modal("show");
            $('#form_order').trigger("reset");
            previewImages();
        },
        error: function(result) {
            console.log("tt");
            alert(result.responseJSON.errors.provider_id);
        }
    });
})
$('#ordersentModal').on('hidden.bs.modal', function() {
    window.location.href = "/";
});


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
$("#form_rate").on("submit", function(event) {


    event.preventDefault();

    console.log(new FormData(this));
    $.ajax({

        type: "POST",
        url: "/client/profile/product/orders/add/comment",
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: new FormData(this),
        success: function(result) {
            console.log('dfs');
            // setTimeout(function() { // wait for 5 secs(2)
            //     window.location.href = "/provider/orders"; // then reload the page.(3)
            // }, 5000);
            $('#rateModal1').modal("hide")
            $('#confirmRateModal').modal("show");
        },
        error: function(result) {
            console.log('df555555s');
            alert(result.responseJSON.errors.details);
        }
    });
})

$('#confirmRateModal').on('hidden.bs.modal', function() {
    window.location.href = "/client/profile/orders";
});



$("#cancel_client_form").on("submit", function(event) {


    event.preventDefault();

    console.log(new FormData(this));
    $.ajax({

        type: "POST",
        url: "/client/profile/cancel/product/orders/new",
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: new FormData(this),
        success: function(result) {
            console.log('dfs');
            // setTimeout(function() { // wait for 5 secs(2)
            //     window.location.href = "/provider/orders"; // then reload the page.(3)
            // }, 5000);
            $('#cancelModal').modal("hide")
            $('#confirmModalCancelClient').modal("show");
        },
        error: function(result) {
            console.log('df555555s');
            alert(result.responseJSON.errors.details);
        }
    });
})

$('#confirmModalCancelClient').on('hidden.bs.modal', function() {
    window.location.href = "/client/profile/orders";
});


$(document).ready(function() {

    $('.changeQuantity').click(function(e) {
        e.preventDefault();

        var quantity = $(this).closest(".media-body").find('.pl-ns-value').val();
        var cart_id = $(this).closest(".media-body").find('.cart_id').val();
        var _token = $('#_token').val();
        console.log(cart_id);
        var data = {
            // '_token': _token,
            'qty': quantity,
            'cart_id': cart_id,
        };

        $.ajax({
            url: '/client/cart',
            type: 'POST',
            async: false,
            cache: false,
            timeout: 30000,
            data: data,
            success: function(result) {
                console.log('rrrr');
                console.log(result);
                // window.location.reload();
                // alertify.set('notifier', 'position', 'top-right');
                // alertify.success(response.status);
            },
            error: function(result) {
                console.log('result');
                // alert(result.responseJSON.errors.details);
            }
        });
        setTimeout(function() { // wait for 5 secs(2)
            document.location.reload(true);
        }, 5000);
    });

});



$("#add_to_cart_form").on("submit", function(event) {


    event.preventDefault();

    console.log(new FormData(this));
    $.ajax({

        type: "POST",
        url: "/client/add/to /cart/product",
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: new FormData(this),
        success: function(result) {
            console.log('dfs');
            $('#addtocartmodal').modal("show");
        },
        error: function(result) {
            console.log('df555555s');
            alert(result.responseJSON.errors.details);
        }
    });
})

map = new google.maps.Map(document.getElementById('map'), {
    center: {
        lat: 30,
        lng: 30
    },
    zoom: 6
});

// console.log(document.getElementById('lat').value);
var marker = new google.maps.Marker({
    position: {
        lat: parseInt(document.getElementById('lat').value) ? parseInt(document.getElementById('lat').value) : 30,
        lng: parseInt(document.getElementById('long').value) ? parseInt(document.getElementById('long').value) : 30
    },
    map: map,
    draggable: true
});
var searchBox = new google.maps.places.SearchBox(document.getElementById('address'));

google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();
    var bounds = new google.maps.LatLngBounds();
    var i, place;
    for (i = 0; place = places[i]; i++) {
        bounds.extend(place.geometry.location);
        marker.setPosition(place.geometry.location);
    }
    map.fitBounds(bounds);
    map.setZoom(15);
});
google.maps.event.addListener(marker, 'position_changed', function() {
    var lat = marker.getPosition().lat();
    var lng = marker.getPosition().lng();
    $('#lat').val(lat);
    $('#long').val(lng);
});

/////////////////////////////////
////////////////////////////////

// map2 = new google.maps.Map(document.getElementById('map2'), {
//     center: {
//         lat: 30,
//         lng: 30
//     },
//     zoom: 6
// });
// var total = parseInt(document.getElementById("total"));
// for (i = 0; i < total; i++) {
//     var lat2 = Number(document.getElementById("lat_" + i));
//     var long2 = Number(document.getElementById("long_" + i));
//     marker2 = new google.maps.Marker({
//         position: new google.maps.LatLng(lat2, long2),
//         map: map2
//     });
// }

// }