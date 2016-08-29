
         <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $title;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo $title;?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-8">

                                        <?php $error =  validation_errors(); 
                                            if($error){
                                                echo '<div class="alert alert-danger">'.$error.'</div>';
                                            }
                                        ?>


                                        <?php echo form_open('expensetype/add') ?>

                                        <input type="hidden" name="ID" value="<?php echo (isset($result)) ? $result->ExpenseTypeID: ''; ?>">
                             
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Category Name (EN)</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="ExpenseTypeName" value="<?php echo (isset($result)) ? $result->ExpenseTypeName: set_value('ExpenseTypeName'); ?>"><?php //echo form_error('menuname_en'); ?></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>WHT Type</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="Wht_Type" value="<?php echo (isset($result)) ? $result->Wht_Type: set_value('Wht_Type'); ?>"><?php //echo form_error('menuname_en'); ?></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Percent</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="Percent" value="<?php 
                                                    echo (isset($result)) ? $result->Percent: set_value('Percent'); ?>"></div>
                                            </div>
                                        </div> 

                                        <div class="form-group">
											<div class="row">
                                            <div class="col-lg-3"><label>Active Status</label></div>
                                            <div class="col-lg-9"><label class="radio-inline">
														<input type="radio" name="Status" id="Status1" value="1" checked>Active
													</label>
													<label class="radio-inline">
														<input type="radio" name="Status" id="Status2" value="0" <?php 
															echo ((isset($result)) && ($result->Status == 0)) ? "checked": ""; ?>>InActive
													</label>
											</div>
                                        </div>
										<br />

                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-default" onclick="window.location.href='<?php echo site_url('expensetype/lists');?>';">Back</button>
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
    <script src="<?php echo base_url();?>resource/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>resource/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>resource/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>resource/dist/js/sb-admin-2.js"></script>


</body>

</html>
