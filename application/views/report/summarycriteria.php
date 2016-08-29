<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $title; ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Criteria</div>
		<form role="form" accept-charset="utf-8" method="post">		
		    <div class="panel-body">
			<div class="row">
			    <div class="col-lg-offset-1 col-lg-3"><label class="form-control" style="border: 0px; box-shadow: none;">Document Date</label></div>
			    <div class="col-lg-3">
				<div class="input-group">
				    <input class="form-control" id="start_date" name="start_date" placeholder="Start Date">
				    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></i></span>
				</div>
			    </div>
			    <div class="col-lg-3">
				<div class="input-group">
				    <input class="form-control" id="end_date" name="end_date" placeholder="End Date">
				    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></i></span>
				</div>
			    </div>
			</div>
			<div class="row">
			    <div class="col-lg-offset-1 col-lg-3"><label class="form-control" style="border: 0px; box-shadow: none;">Customer</label></div>
			    <div class="col-lg-6">
				<select class="form-control" id="customer_id" name="customer_id">
				    <option value="0">Please select customer</option>
				    <option value="All">All Customers</option>
				    <?php
					foreach($oCustomers as $oCustomer) {
					    echo "<option value='".$oCustomer->CustomerID."'>".$oCustomer->CustomerCode." : ".$oCustomer->FullNameThai."</option>";
					}
				    ?>
				</select>
			    </div>
			</div>
			<div class="row">
			    <?php
				$error = validation_errors();
				if ($error) {
				    echo "<div class='alert alert-danger'>".$error."</div>";
				}
			    ?>
			</div>
			<div class="row">
			    <div class="col-lg-offset-6 col-lg-8">
				<input class="btn btn-primary" type="Reset" id="reset" name="reset" value="&nbsp;&nbsp;Reset&nbsp;">
				<button class="btn btn-primary" type="button" id="search" name="search">&nbsp;&nbsp;&nbsp;&nbsp;Search&nbsp;&nbsp;&nbsp;&nbsp;</button>
				<button class="btn btn-primary" type="button" id="gen_doc" name="gen_doc">&nbsp;Gen Excel&nbsp;&nbsp;</button>
				<span id='progress-bar'></span>
			    </div>
			</div>
		    </div>
		</form>
	    </div>
	</div>
    </div>
    <div class="row" id='displaTable'></div>

</div>

</div>
<!-- /#page-wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>resource/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>resource/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>resource/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>resource/dist/js/sb-admin-2.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
</body>
</html>
<script type="text/javascript">
        $(document).ready(function () {
            $('#start_date').datepicker({
                changeMonth : true,
                changeYear : true,
                dateFormat : 'yy-mm-dd'
            });
            $('#end_date').datepicker({
                changeMonth : true,
                changeYear : true,
                dateFormat : 'yy-mm-dd'
            });
            $('#search').click(function () {
                $.ajax({
                    type : "post",
                    url : "<?php echo base_url('Report/summaryList') ?>",
                    data : {
                        start_date : $("#start_date").val(),
                        end_date : $("#end_date").val(),
                        customer_id : $("#customer_id").val()
                    },
                    dataType : "text",
                    beforeSend : function () {
                        $('#progress-bar').html("<img src='<?php echo base_url('/assets/images/wait-1.gif'); ?>'>");
                    },
                    success : function (result) {
                        $('#progress-bar').html("");
                        $('#displaTable').html(result);
                    }
                });
            });
            $('#gen_doc').click(function () {
                $.ajax({
                    type : "post",
                    url : "<?php echo base_url('Report/processPrintSummary') ?>",
                    data : {
                        start_date : $("#start_date").val(),
                        end_date : $("#end_date").val(),
                        customer_id : $("#customer_id").val()
                    },
                    dataType : "text",
                    beforeSend : function () {
                        $('#progress-bar').html("<img src='<?php echo base_url('/assets/images/wait-1.gif'); ?>'>Generating...");
                        $('#displaTable').html('');
                    },
                    success : function (result) {
                        $('#progress-bar').html("");
                        $('#displaTable').html(result);
                    }
                });
            });
        });
</script>