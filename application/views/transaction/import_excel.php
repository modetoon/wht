<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $title; ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-12 right">
        </div>
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
		    <?php echo $title; ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form enctype="multipart/form-data" method="post" action="<?php echo base_url('Transaction/processImport') ?>">
			<!--                        <label class="custom-file-upload" for="file-upload" syle="border: 1px;">
						    <i>
							<img width="25" src="<?php echo base_url('/assets/images') ?>/upload.png">
						    </i>
						    Upload your excel file here
						</label>-->
                        <input style="display: inline;" id="file-upload" type="file" name="file">
                        <input class="btn btn-primary" type="submit" value="Import" id="submit" name="submit">
			<span id="waiting" style="color: red;"></span>
                    </form>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>resource/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>resource/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>resource/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>resource/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>resource/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>resource/dist/js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
        $(document).ready(function () {

            $('#ListTable').DataTable({
                responsive : true
            });
            $('#submit').click(function () {
                $('#waiting').html("<strong>Please wait...</strong>");
            });
        });
</script>

</body>

</html>


