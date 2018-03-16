<div class="col-lg-4 col-lg-offset-4">
  <h1 class="page-header">
    Login
  </h1>
  <form id="loginForm">
    <div class="form-group" id="email-group">
      <label for="email" class="control-label">
        E-mail
      </label>
      <span class="text-danger pull-right err-message" id="email-error"></span>
      <input type="email" class="form-control" id="email" value="markernest.matute@gmail.com">
    </div>
    <div class="form-group" id="password-group">
      <label for="password" class="control-label">
        Password
      </label>
      <span class="text-danger pull-right err-message" id="password-error"></span>
      <input type="password" class="form-control"  id="password" value="Password"> 
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">
        Login
      </button>
    </div>
    <hr>
    <div class="row">
      <center>
        <a href="<?php echo base_url('pages/forgot_pass') ?>" class="text-center">Forgot Password?</a>
      </center>
    </div>
    <br>
  </form>
</div>

<script>
  $(document).ready(function() {
    const loginForm = $("#loginForm");
    loginForm.submit((e) => {
      e.preventDefault();
      let formData = {
        email: $("#email").val(),
        password: $("#password").val()
      };
      showLoading();
      $.ajax({
        "method": "POST",
        "url": base_url + "auth/api_login",
        "data": formData,
        "dataType:": "json"
      })
      .done((response) => {
        hideLoading()
          .then((z) => {
            if (response.status) {
              toastr.success('You will be redirected.');
              setTimeout(() => {
                redirect('users/dashboard');
              }, 500);
            } else {
              toastr.error('Login failed.');
              displayErrors(response.errors);
            }
          });
        
      });
    });
  });
</script>