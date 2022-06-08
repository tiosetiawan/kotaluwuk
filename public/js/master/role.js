$(document).ready(function () {
    var table = $('#tableuser').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/configuration/roles/json",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'guard_name', name: 'guard_name'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ],
        columnDefs: [
            { targets: [0, 1, 2,3], className: "text-center" },
          ],
    });

    $(document).on('click','#add_btn',function(e){
		e.preventDefault();
		$.ajax({
			method:"GET",
			cache:false,
			url: '/configuration/roles/create'
		})
		.done(function(view) {
			$('#MyModalTitle').html('<b>Add</b>');
			$('div.modal-dialog').addClass('modal-md');
			$("div#MyModalContent").html(view);
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
        var name        = $("#name").val();
        var guard_name  = $("#guard_name").val();
        var description = $("#description").val();
        var token       = $("meta[name='csrf-token']").attr("content");
	    $.ajax({
		    method: "POST",
		    url: '/configuration/roles',
		    cache: false,
		    data: {
		        name       : name,
		        guard_name : guard_name,
		        description: description,
		        _token     : token,
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
                values += value + "<br>"
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
          url   : "/configuration/roles/"+ id + "/edit",
          cache : false,
          data  : { id_role: id },
        })
          .done(function (view) {
            $("#MyModalTitle").html("<b>Edit</b>");
            $("div.modal-dialog").addClass("modal-md");
            $("div#MyModalContent").html(view);
            $("div#MyModalFooter").html(
              '<button type="submit" class="btn btn-outline-success btn-sm center-block" id="save_edit_btn">Ubah</button>'
            );
            $("div#MyModal").modal("show");
           
            $(".autocomplete").chosen();
          })
          .fail(function (response) {
            if(response.responseJSON.errors){
              var values = '';
              jQuery.each(response.responseJSON.errors, function (key, value) {
                  values += value + "<br>"
              });
              notifNo(values);
            }
            console.log("responseText", response.responseText);
          });
      });

      $(document).on("click", "#save_edit_btn", function (e) {
        e.preventDefault();
        var id          = $("#id").val();
        var name_old    = $("#name_old").val();
        var name        = $("#name").val();
        var guard_name  = $("#guard_name").val();
        var description = $("#description").val();
        var token       = $("meta[name='csrf-token']").attr("content");
    
        $.ajax({
          method: "PUT",
          url: "/configuration/roles/" + id,
          data: {
            id         : id,
            name_old   : name_old,
            name       : name,
            guard_name : guard_name,
            description: description,
            name       : name,
            _token     : token
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
                  values += value + "<br>"
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
              url : "/configuration/roles/"+ id,
              data: {
                id_user: id,
                name   : name,
                _token : token,
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
                .fail(function (response) {
                  if(response.responseJSON.errors){
                    var values = '';
                    jQuery.each(response.responseJSON.errors, function (key, value) {
                        values += value + "<br>"
                    });
                    notifNo(values);
                  }
                  console.log("responseText", response.responseText);
                });
            }
        });
        });
});