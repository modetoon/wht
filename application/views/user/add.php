
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

                                        <?php echo form_open('user/add') ?>

                                        <input type="hidden" name="ID" value="<?php echo (isset($result)) ? $result->UserID: ''; ?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>User Type</label></div>
                                                <div class="col-lg-9">
                                                    <select class="form-control" name="UserType">
														<option value="">Please select
														<option value="admin" <?php echo ((isset($result)) && ($result->UserType == 'admin')) ? 'selected': ''; ?>>Administrator
														<option value="user" <?php echo ((isset($result)) && ($result->UserType == 'user')) ? 'selected': ''; ?>>Normal User (View only)
													</select>
												</div>
                                            </div>
                                        </div>                                    
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>FullName</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="FullName" value="<?php echo (isset($result)) ? $result->FullName: set_value('FullName'); ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Email</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="Email" value="<?php echo (isset($result)) ? $result->Email: set_value('Email'); ?>"></div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>UserName</label></div>
                                                <div class="col-lg-9">
													<?php 
													$val = (isset($result)) ? $result->UserName: set_value('UserName');
													echo (isset($result)) ? $result->UserName.'<input type="hidden" name="UserName" value="'.$val.'">': '<input class="form-control" name="UserName" value="'.$val.'">'; ?>
													</div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Password</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="Password" value="<?php 
                                                    echo (isset($result)) ? $result->Password: set_value('Password'); ?>"></div>
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label>Status</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="Status" id="Status1" value="1" checked>Active
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="Status" id="Status2" value="0" <?php 
                                                    echo ((isset($result)) && ($result->Status == 0)) ? "checked": ""; ?>>UnActive
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
    <script src="<?php echo base_url();?>resource/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>resource/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>resource/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>resource/dist/js/sb-admin-2.js"></script>



</body>

</html>
