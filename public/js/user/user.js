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
                    .fail(function (response) {
                      if(response.responseJSON.errors){
                        var values = '';
                        jQuery.each(response.responseJSON.errors, function (key, value) {
                            values += value
                        });
                        notifNo(values);
                      }
                      console.log("responseText", response.responseText);
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
		        username  : username,
		        name      : name,
		        email     : email,
		        perusahaan: perusahaan,
		        divisi    : divisi,
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
        .fail(function (response) {
          if(response.responseJSON.errors){
            var values = '';
            jQuery.each(response.responseJSON.errors, function (key, value) {
                values += value
            });
            notifNo(values);
          }
          console.log("responseText", response.responseText);
        });
  	});

    $(document).on("click", "#edit_btn", function (e) {
      e.preventDefault();
      var id = $(this).attr("data-id");
      $.ajax({
        method: "GET",
        url   : "/user/"+ id + "/edit",
        cache : false,
        data  : { id_user: id },
      })
        .done(function (view) {
          $("#MyModalTitle").html("<b>Ubah</b>");
          $("div.modal-dialog").addClass("modal-lg");
          $("div#MyModalContent").html(view);
          $("div#MyModalFooter").html(
            '<button type="submit" class="btn btn-outline-success btn-sm center-block" id="save_edit_btn">Ubah</button>'
          );
          $("div#MyModal").modal("show");
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
          $(".autocomplete").chosen();
        })
        .fail(function (response) {
          if(response.responseJSON.errors){
            var values = '';
            jQuery.each(response.responseJSON.errors, function (key, value) {
                values += value
            });
            notifNo(values);
          }
          console.log("responseText", response.responseText);
        });
    });
  
    $(document).on("click", "#save_edit_btn", function (e) {
      e.preventDefault();
      var id           = $("#id").val();
      var username_old = $("#username_old").val();
      var username     = $("#username").val();
      var name         = $("#name").val();
      var email        = $("#email").val();
      var perusahaan   = $("#perusahaan").val();
      var divisi       = $("#divisi").val();
      var token        = $("meta[name='csrf-token']").attr("content");
  
      $.ajax({
        method: "PUT",
        url: "/user/" + id,
        data: {
          id          : id,
          username    : username,
          username_old: username_old,
          name        : name,
          email       : email,
          perusahaan  : perusahaan,
          divisi      : divisi,
          _token      : token
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
        .fail(function (response) {
          if(response.responseJSON.errors){
            var values = '';
            jQuery.each(response.responseJSON.errors, function (key, value) {
                values += value
            });
            notifNo(values);
          }
          console.log("responseText", response.responseText);
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
          url : "/user/"+ id,
          data: {
            id_user: id,
            name   : name,
            _token : token,
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
            .fail(function (response) {
              if(response.responseJSON.errors){
                var values = '';
                jQuery.each(response.responseJSON.errors, function (key, value) {
                    values += value
                });
                notifNo(values);
              }
              console.log("responseText", response.responseText);
            });
        }
    });
    });


});