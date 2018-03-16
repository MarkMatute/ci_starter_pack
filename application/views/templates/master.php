<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript">
        let base_url = "<?php echo base_url() ?>";
    </script>

    <title>CI - Starter</title>

    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/sb-admin.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/toastr.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/DataTables/datatables.min.css') ?>"/>

    <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/lodash.js') ?>"></script>
</head>

<body>
    <?php $this->load->view('templates/loading') ?>
    <div id="wrapper" class="<?php echo $sidebar_class ?>">
	
        <!-- Navigation -->
				<?php 
					if ($has_side_nav == TRUE) {
						$this->load->view('templates/navbar');
					}
				?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
											<?php $this->load->view($subview) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/toastr.js') ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url('assets/DataTables/datatables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/libs/app.js') ?>"></script>

</body>
</html>
