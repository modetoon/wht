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
                <?php
                $attribute = array(
                    'role' => 'form'
                );

                echo form_open('Report/processPrintWht', $attribute);
                ?>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-offset-1 col-lg-3"><label class="form-control" style="border: 0px; box-shadow: none;">Document Date</label></div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <input class="form-control" id="start_date" name="start_date" placeholder="Start Date" value="<?php echo $startDate ?>">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></i></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <input class="form-control" id="end_date" name="end_date" placeholder="End Date" value="<?php echo $endDate ?>">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-offset-1 col-lg-3"><label class="form-control" style="border: 0px; box-shadow: none;">Document Number</label></div>
                        <div class="col-lg-3">
                            <input class="form-control" id="start_doc_no" name="start_doc_no" placeholder="Start Document Number" value="<?php echo $startDocNo ?>">
                        </div>
                        <div class="col-lg-3">
                            <input class="form-control" id="end_doc_no" name="end_doc_no" placeholder="End Document Number" value="<?php echo $endDocNo ?>">
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $error = validation_errors();
                        if ($error) {
                            echo "<div class='alert alert-danger'>" . $error . "</div>";
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-offset-9 col-lg-2">
                            <input class="btn btn-primary" type="submit" id="submit" name="submit" value="Submit">
                        </div>
                    </div>
                    <?php
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>resource/bower_components/jquery/dist/jquery.min.js"></script>

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
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
        $('#end_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
</script>