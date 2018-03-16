<form id="form" action="<?php echo $action ?>">
  <div class="form-group" id="email-group">
    <label for="email" class="control-label">E-mail:</label>
    <span class="text-danger pull-right err-message" id="email-error"></span>
    <input type="email" class="form-control" id="email" value="<?php echo @$user->email ?>">
  </div>
  <div class="form-group" id="role-group">
    <label for="role" class="control-label">Role:</label>
    <span class="text-danger pull-right err-message" id="role-error"></span>
    <select class="form-control" multiple="multiple" id="role">
      <?php foreach($roles as $role): ?>
        <option value="<?php echo $role->id ?>" selected="selected">
          <?php echo $role->name ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <?php if(isset($user)): ?>
    <div class="form-group" id="password-group">
      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#passwordModal">Change Password</a>
    </div>
  <?php else: ?>
    <div class="form-group" id="password-group">
      <label for="password" class="control-label">Password:</label>
      <span class="text-danger pull-right err-message" id="password-error"></span>
      <input type="password" class="form-control" id="password">
    </div>
    <div class="form-group" id="cpassword-group">
      <label for="cpassword" class="control-label">Confirm Password:</label>
      <span class="text-danger pull-right err-message" id="cpassword-error"></span>
      <input type="password" class="form-control" id="cpassword">
    </div>
  <?php endif; ?>

  <button type="submit" class="btn btn-primary btn-block">
    Save
  </button>
</form>

<!-- Password Modal -->
<?php if(isset($user)): ?>
  <div id="passwordModal" class="modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Password</h4>
        </div>
        <div class="modal-body">
          <div class="form-group" id="newPassword-group">
            <label for="newPassword" class="control-label">New Password:</label>
            <span class="text-danger pull-right err-message" id="newPassword-error"></span>
            <input type="password" class="form-control" id="newPassword" required>
          </div>
          <div class="form-group" id="cNewPassword-group">
            <label for="cNewPassword" class="control-label">Confirm New Password:</label>
            <span class="text-danger pull-right err-message" id="cNewPassword-error"></span>
            <input type="password" class="form-control" id="cNewPassword" required>
          </div>
          <div class="form-group">
            <button type="button" id="btnChangePassword" class="btn btn-primary btn-block">Change Password</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif;  ?>

<script>
  $(document).ready(() => {
    let form = $('#form');
    let btnChangePassword = $('#btnChangePassword');
    
    // Save Form
    form.submit((e) => {
      e.preventDefault();
      let action = form.attr('action');
      let data = {
        email: $('#email').val(),
        role: $('#role').val(),
        password: $('#password').val(),
        cpassword: $('#cpassword').val()
      };

      showLoading();
      $.ajax({
        "method": "POST",
        "url": action,
        "data": data,
        "dataType:": "json"
      })
      .then((response) => {
        hideLoading();
        if (response.status) {
          toastr.success('User saved.');
          setTimeout(() => {
            redirect('users/listing');
          }, 500);
        } else {
          displayErrors(response.errors);
          toastr.error('Check your form for errors.');
        }
      });
    });
    
    // Change Password
    btnChangePassword.on('click', ()=>{
      let data = {
        newPassword: $('#newPassword').val(),
        cNewPassword: $('#cNewPassword').val()
      };
      showLoading();
      $.ajax({
        "method": "POST",
        "url": base_url + 'users/updatePassword/<?php echo @$user->id ?>',
        "data": data,
        "dataType:": "json"
      })
      .done((response) => {
        hideLoading();
        if (response.status) {
          toastr.success('Password saved.');
          $('#newPassword').val('');
          $('#cNewPassword').val('');
          $('#passwordModal').modal('hide');
        } else {
          displayErrors(response.errors);
          toastr.error('Check your form for errors.');
        }
      });
    });
  });
</script>