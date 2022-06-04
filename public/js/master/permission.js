$(document).ready(function () {
    var table = $('#tableuser').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/permissions/json",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'menu_name', name: 'menu_name'},
            {data: 'icon', name: 'icon'},
            {data: 'route_name', name: 'route_name'},
            {data: 'order_line', name: 'order_line'},
            {data: 'index', name: 'index'},
            {data: 'store', name: 'store'},
            {data: 'edits', name: 'edits'},
            {data: 'erase', name: 'erase'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ],
        columnDefs: [
            { targets: [0, 1, 2,3,4,5,6,7,8,9], className: "text-center" },
          ],
    });

    $(document).on('click','#add_btn',function(e){
		e.preventDefault();
		$.ajax({
			method:"GET",
			cache:false,
			url: '/permissions/create'
		})
		.done(function(view) {
			$('#MyModalTitle').html('<b>Add</b>');
			$('div.modal-dialog').addClass('modal-md');
			$("div#MyModalContent").html(view);
            iconpicker();
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
        var menu_name  = $("#menu_name").val();
        var route_name = $("#route_name").val();
        var icon       = $("#icon").val();
        var order_line = $("#order_line").val();
        var role       = $("#role").val();
        var index      = $("#index").is(":checked");
        var create     = $("#create").is(":checked");
        var edit       = $("#edit").is(":checked");
        var erase      = $("#erase").is(":checked");
        var token      = $("meta[name='csrf-token']").attr("content");

	    $.ajax({
		    method: "POST",
		    url: '/permissions',
		    cache: false,
		    data: {
		        menu_name : menu_name,
		        route_name: route_name,
		        icon      : icon,
		        order_line: order_line,
		        role      : role,
		        index     : index,
		        create    : create,
		        edit      : edit,
		        erase     : erase,
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
                values += value + "<br>"
            });
            notifNo(values);
          }
          
        });
  	});

    function iconpicker(){
        $('.iconpicker').iconpicker({
            title: 'My Icon Picker',
            selected: false,
            defaultValue: false,
            placement: "bottom",
            collision: "none",
            animation: true,
            hideOnSelect: true,
            showFooter: true,
            searchInFooter: false,
            mustAccept: false,
            selectedCustomClass: "bg-primary",
            fullClassFormatter: function (e) {
                return e;
            },
            input: "input,.iconpicker-input",
            inputSearch: false,
            container: false,
            component: ".input-group-addon,.iconpicker-component",
            templates: {
                popover: '<div class="iconpicker-popover popover" role="tooltip"><div class="arrow"></div>' + '<div class="popover-title"></div><div class="popover-content"></div></div>',
                footer: '<div class="popover-footer"></div>',
                buttons: '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button>' + ' <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
                search: '<input type="search" class="form-control iconpicker-search" placeholder="Type to filter" />',
                iconpicker: '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
                iconpickerItem: '<a role="button" href="javascript:;" class="iconpicker-item"><i></i></a>'
            }
        });
    }

});