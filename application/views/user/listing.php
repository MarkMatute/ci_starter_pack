 <div class="row">
  <div class="col-lg-12">
    <div class="row">
      <div class="col-lg-6">
        <h4>
          Users
        </h4>
      </div>
      <div class="col-lg-6">
        <div class="btn-group pull-right">
          <a href="<?php echo base_url('users/listing') ?>" class="btn btn-primary">Active List</a>
          <a href="<?php echo base_url('users/listing/archived') ?>" class="btn btn-danger">Archived List</a>          
          <a href="<?php echo base_url('users/create') ?>" class="btn btn-success">New User</a>          
        </div>
      </div>
    </div>
  </div>
</div>
<br/>
<table id="table" cellspacing="0" width="100%" class="display table table-bordered table-hover">
  <thead>
      <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<script type="text/javascript">
  $(document).ready(function() {
    let table;
    let archived = '<?php echo $archived; ?>';
    table = $('#table').DataTable({
      "scrollX": true, 
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": base_url + "users/ajax_list/" + archived,
        "type": "POST"
      },
      "columnDefs": [
        { 
          "targets": [ 0 ], 
          "orderable": true,
          "width": 100,
          "mRender": (data, type, row) => {
            return "<a class='btn btn-primary' href='"+base_url+'users/edit/'+data+"'>Show Details [ID - " + data + "]</a>"
          }
        },
        { 
          "targets": [ 2 ], 
          "orderable": true,
          "width": 200,
          "mRender": (data, type, row) => {
            if (archived  === 'archived') {
              return `<div class="btn-group">
                      <a href="`+base_url+'users/restore/'+ row[0] +`" class="btn btn-success" onclick="return confirm(\'This User will be restored?. Are you sure?\')">Restore</a>
                      <a href="`+base_url+'users/delete/'+ row[0] +`" class="btn btn-danger" onclick="return confirm(\'This User will be permanently deleted. Are you sure?\')">Permanent Delete</a>
                    </div>`;
            } else {
              return `<div class="btn-group">
                      <a href="`+base_url+'users/edit/'+ row[0] +`" class="btn btn-primary">Edit</a>
                      <a href="`+base_url+'users/archive/'+ row[0] +`" class="btn btn-danger" onclick="return confirm(\'This User will now show on any lists. Are you sure?\')">Archive</a>
                    </div>`;
            }
          }
        }
      ]
    });
  });
</script>