
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $title;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-12 right">
                    <p class="text-right"><button type="button" class="btn btn-success text-right" onclick="window.location.href='<?php echo site_url('expensetype/add');?>';">Add Expense Type</button></p>
                </div>
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo $title;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">

                                <table class="table table-striped table-bordered table-hover" id="ListTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Expense Type Name</th>
                                            <th>WHT Type</th>
                                            <th>Percent</th>
                                            <th style="text-align:center;width:13%;">Active Status</th>
                                            <th style="text-align:center;width:13%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach($result as $r){
											$Status = ($r->Status == 1) ? '<button type="button" class="btn btn-info btn-circle"><i class="fa fa-check"></i> </button>': '<button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i></button>';
                                            echo '<tr>
                                                <td><input type="checkbox" value="'.$r->ExpenseTypeID.'"></td>
                                                <td>'.$r->ExpenseTypeName.'</td>
                                                <td>'.$r->Wht_Type.'</td>
                                                <td>'.$r->Percent.' %</td>
                                                <td style="text-align:center;">'.$Status.'</td>
                                                <td  style="text-align:center;">
                                                    <a href="'.site_url("expensetype/edit/$r->ExpenseTypeID").'" class="btn btn-warning btn-xs">Edit</a>&nbsp;
                                                    <a href="'.site_url("expensetype/delete/$r->ExpenseTypeID").'" class="btn btn-danger btn-xs">Delete</a>
                                                </td>
                                            </tr>';                                       
                                        }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
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

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>resource/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>resource/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>resource/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {

        $('#ListTable').DataTable({
                responsive: true,
				"iDisplayLength": 20
        });
        
    });
    </script>

</body>

</html>
