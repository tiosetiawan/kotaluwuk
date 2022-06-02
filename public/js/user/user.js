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


});