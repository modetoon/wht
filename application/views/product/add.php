
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


                                        <?php echo form_open('product/add') ?>

                                        <input type="hidden" name="ID" value="<?php echo (isset($result)) ? $result->ProductID: ''; ?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Main Category</label></div>
                                                <div class="col-lg-9">
                                                    <?php echo $menu_dropdownlist;?>
                                                </div>
                                            </div>
                                        </div>                                    

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Trade Name (TH)</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="TradeName" value="<?php echo (isset($result)) ? $result->TradeName: set_value('TradeName'); ?>"></div>
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Common Name (TH)</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="CommonName" value="<?php echo (isset($result)) ? $result->CommonName: set_value('CommonName'); ?>"></div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Formula</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="Formula" value="<?php 
                                                    echo (isset($result)) ? $result->Formula: set_value('Formula'); ?>"></div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Detail</label></div>
                                                <div class="col-lg-9"><textarea class="form-control" name="Detail" rows="5"><?php 
                                                    echo (isset($result)) ? $result->Detail: set_value('Detail'); ?></textarea></div>
                                            </div>
                                        </div>         
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Contain</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="Contain" value="<?php 
                                                    echo (isset($result)) ? $result->Contain: set_value('Contain'); ?>"></div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Suggestion</label></div>
                                                <div class="col-lg-9"><textarea class="form-control" name="Suggestion" rows="5"><?php 
                                                    echo (isset($result)) ? $result->Suggestion: set_value('Suggestion'); ?></textarea></div>
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
