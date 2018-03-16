
/**
 * Display Errors
 * @param { array } errors 
 */
let displayErrors = (errors) => {
  $(".form-group").removeClass("has-error");
  $(".err-message").html("");
  _.each(errors, function (v, key) {
    $("#" + key + "-group").addClass("has-error");
    $("#" + key + "-error").html(errors[key]);
  });
};

/**
 * Redirect user
 * @param { String } url 
 */
let redirect = (url) => {
  window.location.href = base_url + url;
};

/**
 * Show Loading
 */
let showLoading = () => {
  $('#loadingModal').modal('show');
};

/**
 * Hide Loading
 */
let hideLoading = () => {
  return new Promise((resolve, reject) => {
    setTimeout(()=>{
      $('#loadingModal').modal('hide');
      resolve();
    }, 500)
  });
};

/**
 * Custom Confirm Box
 * @param {Function} cb 
 */
let customConfirm = function(cb) {
  swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this imaginary file!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      cb();
    }
  });
};