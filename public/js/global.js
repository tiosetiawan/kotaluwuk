function notifNoAuto(data) {
    swal({
      type: "error",
      title: "Warning !",
      html: data,
      showConfirmButton: false,
      timer: 2000,
    });
  }
  
  function notifYesAuto(data) {
    swal({
      type: "success",
      title: "Success",
      html: data,
      showConfirmButton: false,
      timer: 2000,
    });
  }
  
  function notifNo(data) {
    swal({
      type: "error",
      title: "Warning !",
      html: data,
    });
  }
  
  function notifYes(data) {
    swal({
      type: "success",
      title: "Success",
      html: data,
    });
  }
  
  function notifCancle(data) {
    swal({
      type: "warning",
      title: "Canceled",
      text: data,
      showConfirmButton: false,
      timer: 2000,
    });
  }
  
  function notifCancelAuto(data) {
    swal({
      type: "success",
      title: "Cancellation",
      html: data,
      showConfirmButton: false,
      timer: 2000,
    });
  }

  console.log(localStorage.getItem('token'))