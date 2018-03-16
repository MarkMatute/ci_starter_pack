<form id="form" action="<?php echo $action ?>">
  <div class="form-group" id="name-group">
    <label for="name" class="control-label">Name:</label>
    <span class="text-danger pull-right err-message" id="name-error"></span>
    <input type="name" class="form-control" id="name" value="<?php echo @$role->name ?>">
  </div>
  <button type="submit" class="btn btn-primary btn-block">
    Save
  </button>
</form>

<script>
  $(document).ready(() => {
    let form = $('#form');
    
    // Save Form
    form.submit((e) => {
      e.preventDefault();
      let action = form.attr('action');
      let data = {
        name: $('#name').val()
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
          toastr.success('Role saved.');
          setTimeout(() => {
            redirect('roles/listing');
          }, 500);
        } else {
          displayErrors(response.errors);
          toastr.error('Check your form for errors.');
        }
      });
    });
  });
</script>