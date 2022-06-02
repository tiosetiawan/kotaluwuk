$(document).ready(function () {
    var table = $('#tableuser').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/user/json",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'perusahaan', name: 'perusahaan'},
            {data: 'divisi', name: 'divisi'},
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ],
        columnDefs: [
            { targets: [0, 1, 2,3,4,5,6], className: "text-center" },
          ],
    });

    $(document).on('click','#add_btn',function(e){
		e.preventDefault();
		$.ajax({
			method:"GET",
			cache:false,
			url: '/user/create'
		})
		.done(function(view) {
			$('#MyModalTitle').html('<b>Add</b>');
			$('div.modal-dialog').addClass('modal-lg');
			$("div#MyModalContent").html(view);
            $("#username").keyup(function (e) {
                e.preventDefault();
                username = $("#username").val();
                if (username.length >= 8) {
                  $.ajax({
                    method: "GET",
                    cache: false,
                    url: "/user/cherry",
                    data: {
                      username: username,
                    },
                  })
                    .done(function (result) {
                      if (result.data !== null) {
                        $("#name").val(result.data[0].Name);
                        $("#perusahaan").val(result.data[0].Company);
                        $("#email").val(result.data[0].OfficeEmailAddress);
                        $("#divisi").val(result.data[0].Department);
                      } else {
                        $("#name").val("");
                        $("#perusahaan").val("");
                        $("#divisi").val("");
                        $("#email").val("");
                      }
                    })
                    .fail(function (res) {
                      alert("Error Response !");
                      console.log("responseText", res.responseText);
                    });
                }
                e.stopPropagation();
              });
			$("div#MyModalFooter").html('<button type="submit" class="btn btn-outline-success btn-sm center-block" id="save_add_btn"><i class="bi bi-file-earmark-plus"></i> Save</button>');
			$("div#MyModal").modal('show');
		})
		.fail(function(res){
			alert('Error Response !');
			console.log("responseText", res.responseText);
		});
	});

    $(document).on("click", "#save_add_btn", function (e) {
    	e.preventDefault();
        var username   = $("#username").val();
        var name       = $("#name").val();
        var email      = $("#email").val();
        var perusahaan = $("#perusahaan").val();
        var divisi     = $("#divisi").val();
        var token      = $("meta[name='csrf-token']").attr("content");
	    $.ajax({
		    method: "POST",
		    url: '/user',
		    cache: false,
		    data: {
		        username  : $("#username").val(),
		        name      : $("#name").val(),
		        email     : $("#email").val(),
		        perusahaan: $("#perusahaan").val(),
		        divisi    : $("#divisi").val(),
		        _token    : token,
		      },
	    })
      	.done(function (response) {
	        if (response.success) {
	          $("div#MyModal").modal("hide");
	          notifYesAuto(response.message);
	          table.ajax.reload();
	        }else{
                notifNo(response.message);
            }
      	})
      	.fail(function (res) {
        	alert("Error Response !");
        	console.log("responseText", res.responseText);
      	});
  	});


    $(document).on("click", "#delete_btn", function (e) {
    e.preventDefault();
    var id    = $(this).attr("data-id");
    var name  = $(this).attr("data-name");
    var token = $("meta[name='csrf-token']").attr("content");
    swal({
        title: "Anda yakin ?",
        text: "User data " + name + " akan dihapus ?",
        type: "question",
        showCancelButton: true,
        confirmButtonText: "Ya, hapus !",
        cancelButtonText: "Tidak, batalkan !",
    }).then((result) => {
        if (result.value) {
        $.ajax({
          type: "post",
            url: "/user/"+ id,
            data: {
            id_user: id,
            name   : name,
            _token    : token,
           '_method': 'delete'
            },
        })
            .done(function (response) {
            if (response.success) {
                $("div#MyModal").modal("hide");
                notifYesAuto(response.message);
                table.ajax.reload();
              }else{
                  notifNo(response.message);
              }
            })
            .fail(function (res) {
            alert("Error Response !");
            console.log("responseText", res.responseText);
            });
        }
    });
    });


});