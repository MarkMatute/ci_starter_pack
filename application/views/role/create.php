<div class="row">
  <div class="col-lg-12">
    <div class="row">
      <div class="col-lg-6">
        <h4>
          New Role
        </h4>
      </div>
      <div class="col-lg-6">
        <div class="btn-group pull-right">
          <a href="<?php echo base_url('roles/listing') ?>" class="btn btn-primary">Role List</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('role/form'); ?>