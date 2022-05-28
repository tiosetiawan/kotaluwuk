$(document).ready(function() {

    $("#btn_login").click( function() {

       var username = $("#username").val();
       var token = $("meta[name='csrf-token']").attr("content");

       $("#btn_loding").removeClass('d-none');
       $("#btn_login").addClass('d-none');

       var kode = 1;
       $.ajax({

        url: "/tostr",
        type: "POST",
        dataType: "JSON",
        cache: false,
        data: {
            "username": username,
            "_token": token,
            "kode"  : kode
        },

        success:function(response){

            if (response.success) {
                toastr.success(response.message);
            } else {
                toastr.error(response.message);
                $("#btn_loding").addClass('d-none');
                $("#btn_login").removeClass('d-none');
            } 
        },

        error:function(response){
            $("#btn_loding").addClass('d-none');
            $("#btn_login").removeClass('d-none');
            toastr.error(response.responseJSON.errors.username);
            toastr.error(response.responseJSON.errors.password);
        }

        });
    });

});