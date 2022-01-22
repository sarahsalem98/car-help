$("#cancel_form").on("submit", function(event) {


    event.preventDefault();

    console.log(new FormData(this));
    $.ajax({

        type: "POST",
        url: "/provider/service/send/cancel/reasons",
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: new FormData(this),
        success: function(result) {
            // console.log('dfs');
            $('#cancelModal').modal("hide");
            $('#confirmModal').modal("show");
            $('#price_form').trigger("reset");

        },
        error: function(result) {
            // console.log('df555555s');
            $('#cancelReasonError').text(result.responseJSON.errors.cancel_id);
            // console.log(result.responseJSON.errors);
        }
    });
})

$('#confirmModal').on('hidden.bs.modal', function() {
    window.location.href = "/provider/services";
});



$("#cancel_form2").on("submit", function(event) {


    event.preventDefault();

    console.log(new FormData(this));
    $.ajax({

        type: "POST",
        url: "/provider/service/send/cancel/reasons",
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: new FormData(this),
        success: function(result) {
            console.log('dfs');
            // setTimeout(function() { // wait for 5 secs(2)
            //     window.location.href = "/provider/orders"; // then reload the page.(3)
            // }, 5000);
            $('#cancelModal2').modal("hide");
            $('#confirmModal2').modal("show");

            // previewImages();
        },
        error: function(result) {
            console.log('df555555s');
            alert(result.responseJSON.errors.details);
        }
    });
})

$('#confirmModal2').on('hidden.bs.modal', function() {
    window.location.href = "/provider/orders";
});



$("#complete_form").on("submit", function(event) {
    event.preventDefault();
    console.log(new FormData(this));
    $.ajax({

        type: "POST",
        url: "/provider/complete/service",
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: new FormData(this),
        success: function(result) {
            // console.log('dfs');
            // setTimeout(function() { // wait for 5 secs(2)
            //     window.location.href = "/provider/services"; // then reload the page.(3)
            // }, 5000);
            $('#completModal').modal("show");
        },
        error: function(result) {
            // console.log('df555555s');
            alert(result.responseJSON.errors.details);
        }
    });
})

$('#completModal').on('hidden.bs.modal', function() {
    window.location.href = "/provider/services";
});

$("#isDeliverdForm").on("submit", function(event) {

    event.preventDefault();

    console.log(new FormData(this));
    $.ajax({

        type: "POST",
        url: "/provider/deliverd/order",
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: new FormData(this),
        success: function(result) {
            // console.log('dfs');
            // setTimeout(function() { // wait for 5 secs(2)
            //     window.location.href = "/provider/orders"; // then reload the page.(3)
            // }, 5000);
            $('#isDeliveredModal').modal("show");
        },
        error: function(result) {
            // console.log('df555555s');
            alert(result.responseJSON.errors.details);
        }
    });
})
$('#isDeliveredModal').on('hidden.bs.modal', function() {
    window.location.href = "/provider/orders";
});