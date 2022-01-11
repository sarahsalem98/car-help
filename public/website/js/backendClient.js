$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '<?= csrf_token() ?>'
    }
});
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