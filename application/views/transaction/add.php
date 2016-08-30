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

                                        <?php echo form_open('transaction/add') ?>

                                        <input type="hidden" name="ID" value="<?php echo (isset($result)) ? $result->TransactionID: ''; ?>">

                                       <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>PYMT DOC./ID.</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="DocNo" value="<?php echo (isset($result)) ? $result->DocNo: $DocNo; ?>" readonly></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Customer</label></div>
                                                <div class="col-lg-9">
                                                    <?php echo $customer_dropdownlist;?>
												</div>
                                            </div>
                                        </div>                                    
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Transaction Date</label></div>
                                                <div class="col-lg-9"><input class="form-control" id="TransactionDate" name="TransactionDate" value="<?php echo (isset($result)) ? $result->TransactionDate: set_value('TransactionDate'); ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Expense Type</label></div>
                                                <div class="col-lg-9">
													<?php echo $expensetype_dropdownlist;?>
												</div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Amount (จำนวนเงิน<br />ที่ต้องจ่าย Excl Vat)</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="NetAmount" id="NetAmount" value="<?php echo (isset($result)) ? $result->NetAmount: set_value('NetAmount'); ?>"></div>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Tax (%)</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="TaxPercent" value="<?php echo (isset($result)) ? $result->TaxPercent: set_value('TaxPercent'); ?>"></div>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>WHT Amount</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="TaxAmount" id="TaxAmount" value="<?php echo (isset($result)) ? $result->TaxAmount: set_value('TaxAmount'); ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Amount (จำนวนเงิน<br />ที่ต้องจ่าย Incl Vat)</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="Amount" id="Amount" value="<?php echo (isset($result)) ? $result->Amount: set_value('Amount'); ?>" readonly></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Condition</label></div>
                                                <div class="col-lg-9">
														<select class="form-control" name="Condition">
														<option value="">Please select
															<?php if(isset($result)){?>
																	<option value="1" <?php echo ((isset($result)) && ($result->Condition == '1')) ? 'selected': ''; ?>>Deducted Witholding Tax
																	<option value="3" <?php echo ((isset($result)) && ($result->Condition == '3')) ? 'selected': ''; ?>>Absorbed Witholding Tax
															<?php }else{?>
																	<option value="1" <?php echo ((isset($Condition)) && ($Condition == '1')) ? 'selected': ''; ?>>Deducted Witholding Tax
																	<option value="3" <?php echo ((isset($Condition)) && ($Condition == '3')) ? 'selected': ''; ?>>Absorbed Witholding Tax
															<?php }?>
														</select>
												</div>
                                            </div>
                                        </div> 

										<div class="form-group">
											<div class="row">
												<div class="col-lg-3"><label>Remark</label></div>
												<div class="col-lg-9">
													<textarea class="form-control" name="Remark" rows="3"><?php echo (isset($result)) ? $result->Remark : set_value('Remark'); ?></textarea>
												</div>
											</div>
										</div> 

                                        <div class="form-group">
                                            <div class="row">
											<div class="col-lg-3"><label>Cancel Status</label></div>
                                            <div class="col-lg-9">
												<label class="radio-inline">
													<input type="radio" name="Status" id="Status1" value="1" checked>No
												</label>
												<label class="radio-inline">
													<input type="radio" name="Status" id="Status2" value="0" <?php 
														echo ((isset($result)) && ($result->Status == 0)) ? "checked": ""; ?>>Yes
												</label>
											</div>
                                        </div>

										<br /><br />

                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-default" onclick="window.history.go(-1);">Back</button>
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

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
	<script>
	  $( function() {
			$( "#TransactionDate" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat : 'yy-mm-dd'
			});
			$( "#AmountExclVat" ).keyup(function() {
					if(this.value != ''){
						var ExpenseTypeID = $( "#ExpenseTypeID" ).val();
						if(ExpenseTypeID != ''){
							var arrExpenseType = ExpenseTypeID.split('|');
							var WHTPercent = parseInt(arrExpenseType[1]);
							var this_val = parseFloat(this.value);
							var amount_incl_vat =  this_val + (this_val * (WHTPercent/(100-WHTPercent)));
							$('#AmountInclVat').val(amount_incl_vat.toFixed(2));
						}
					}
			});
			$( "#ExpenseTypeID" ).change(function() {
						var AmountExclVat = parseFloat($( "#AmountExclVat" ).val());
						if(AmountExclVat != ''){
							var this_val = this.value;
							var arrExpenseType = this_val.split('|');
							var WHTPercent = parseInt(arrExpenseType[1]);
							var amount_incl_vat =  AmountExclVat + (AmountExclVat * (WHTPercent/(100-WHTPercent)));
							$('#AmountInclVat').val(amount_incl_vat.toFixed(2));
						}
			});
	  } );
	</script>


</body>

</html>
