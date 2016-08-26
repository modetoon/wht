
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
                <div class="panel-heading">
                    <?php echo $title; ?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">

                            <?php
                                $error = validation_errors();
                                if ($error) {
                                    echo '<div class="alert alert-danger">' . $error . '</div>';
                                }
                            ?>

                            <?php echo form_open('customer/add') ?>

                            <input type="hidden" name="ID" value="<?php echo (isset($result)) ? $result->CustomerID : ''; ?>">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3"><label>Customer Type</label></div>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="Type">
                                            <option value="">Please select
                                            <option value="individual" <?php echo ((isset($result)) && ($result->Type == 'individual')) ? 'selected' : ''; ?>>บุคคลธรรมดา
                                            <option value="corporation" <?php echo ((isset($result)) && ($result->Type == 'corporation')) ? 'selected' : ''; ?>>นิติบุคคล
                                        </select>
                                    </div>
                                </div>
                            </div>                                    
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3"><label>FullName Thai</label></div>
                                    <div class="col-lg-9"><input class="form-control" name="FullNameThai" value="<?php echo (isset($result)) ? $result->FullNameThai : set_value('FullNameThai'); ?>"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3"><label>ID Card</label></div>
                                    <div class="col-lg-9"><input class="form-control" name="IDCard" value="<?php echo (isset($result)) ? $result->IDCard : set_value('IDCard'); ?>"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3"><label>TaxNumber</label></div>
                                    <div class="col-lg-9"><input class="form-control" name="TaxNumber" value="<?php echo (isset($result)) ? $result->TaxNumber : set_value('TaxNumber'); ?>"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3"><label>Phone</label></div>
                                    <div class="col-lg-9"><input class="form-control" name="Phone" value="<?php echo (isset($result)) ? $result->Phone : set_value('Phone'); ?>"></div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3"><label>Email</label></div>
                                    <div class="col-lg-9"><input class="form-control" name="Email" value="<?php echo (isset($result)) ? $result->Email : set_value('Email'); ?>"></div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3"><label>Address</label></div>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" name="Address" rows="3"><?php echo (isset($result)) ? $result->Address : set_value('Address'); ?></textarea>
                                    </div>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label>Status</label>
                                <label class="radio-inline">
                                    <input type="radio" name="Status" id="Status1" value="1" checked>Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="Status" id="Status2" value="0" <?php echo ((isset($result)) && ($result->Status == 0)) ? "checked" : ""; ?>>UnActive
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <?php echo form_close(); ?>
                        </div>
                        <!-- /.col-lg-6 (nested) -->



                    </div>
                    <!-- /.row (nested) -->
                </div>
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

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>resource/dist/js/sb-admin-2.js"></script>



</body>

</html>
