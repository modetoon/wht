(isset($result)) ? $result->DocNo: $DocNo; ?>" readonly></div>
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
                                                <div class="col-lg-3"><label>Amount<br />(จำนวนเงินที่ต้องจ่าย Excl Vat)</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="AmountExclVat" id="AmountExclVat" value="<?php echo (isset($result)) ? $result->AmountExclVat: set_value('AmountExclVat'); ?>"></div>
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
                                        <!-- <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Tax (%)</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="TaxPercent" value="<?php echo (isset($result)) ? $result->TaxPercent: set_value('TaxPercent'); ?>"></div>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Amount<br />(จำนวนเงินที่ต้องจ่าย Incl Vat)</label></div>
                                                <div class="col-lg-9"><input class="form-control" name="AmountInclVat" id="AmountInclVat" value="<?php echo (isset($result)) ? $result->AmountInclVat: set_value('AmountInclVat'); ?>" readonly></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-3"><label>Overhead</label></div>
                                                <div class="col-lg-9">
														<select class="form-control" name="Overhead">
														<option value="">Please select
															<?php if(isset($result)){?>
																	<option value="deducted" <?php echo ((isset($result)) && ($result->OverHead == 'deducted')) ? 'selected': ''; ?>>Deducted Witholding Tax
																	<option value="absorbed" <?php echo ((isset($result)) && ($result->OverHead == 'absorbed')) ? 'selected': ''; ?>>Absorbed Witholding Tax
															<?php }else{?>
																	<option value="deducted" <?php echo ((isset($Overhead)) && ($Overhead == 'deducted')) ? 'selected': ''; ?>>Deducted Witholding Tax
																	<option value="absorbed" <?php echo ((isset($Overhead)) && ($Overhead == 'absorbed')) ? 'selected': ''; ?>>Absorbed Witholding Tax
															<?php }?>
														</select>
												</div>
                                            </div>
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
