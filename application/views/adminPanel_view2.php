<div class="container">
<div class="row">
<div class="tabbable tabs-left"> <!-- required for floating -->
<!-- Nav tabs -->
<div class="col-xs-2">
	<ul class="nav nav-tabs tabs-left" id="tabPanel">
		<li><a href="#submeters" data-toggle="tab"><img src="<?=base_url()?>public/img/icons/png/submeter.png" height="100" width="100" class="displayed"/></a></li>
	    <li><a href="#ebill" data-toggle="tab"><img src="<?=base_url()?>public/img/icons/png/Light-Bulb.png" height="100" width="100" class="displayed"/></a></li>
	    <li><a href="#wbill" data-toggle="tab"><img src="<?=base_url()?>public/img/icons/png/Water-Tap.png" height="100" width="100"  class="displayed"/></a></li>
	</ul>
	<a href="<?=site_url('adminPanel/main')?>"><img src="<?=base_url()?>public/img/icons/png/backbtn.png" onmouseover="this.src='<?=base_url()?>public/img/icons/png/backhover.png'" onmouseout="this.src='<?=base_url()?>public/img/icons/png/backbtn.png'" class="displayed"/></a>
</div><!--col xs 2-->

<div class="col-xs-10">
<!-- Tab panes -->
<div class="tab-content">
	<div class="tab-pane active" id="submeters">
    <div class="tab-container">
    <div class="page-header">
    	<h4>Submeters: </h4>
    </div><br/><!-- page-header -->
	<div class="row">
    <div class="col-md-12">    
	</div><!--col-md-12-->
    </div> <!--row-->
	<div class="row">
    	<table class="table table-hover table-responsive" data-toggle="table"  data-select-item-name="myRadioName" id="submeters_table" name="submeters_table">
        <thead>
        <tr class="info">                        
        	<th>Submeter Name</th>
        </tr>
        </thead>
        <tbody id="s_table_body">        
        	<?php foreach ($submeterList as $submeter): ?>       
	          <?php echo "<tr><td>"?>
	          <?php echo $submeter['submeterName']?>
	          <?php echo "</td></tr>"?>
      		<?php endforeach ?>
		</tbody>
       	</table>
		
		<div class="pull-right">			
			<input class= "btn btn-info" type="button" id="addSubmeter" name="addSubmeter" value="Add Submeter" data-toggle="modal" data-target="#addSubmeterModal"> </button>				
			<input class= "btn btn-info" type="button" id="editSubmeter" name="editSubmeter" value="Edit Selected" data-toggle="modal" data-target="#editSubmeterModal"> </button>				
		</div><!-- pull-right -->
	</div> <!--row-->
	
	<!-- Add submeter modal start-->
    <div id="addSubmeterModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
    <div class="modal-content">
	    <div class="modal-header modal-header-info">
	    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Add Submeter</h4>
		</div><!-- modal-header -->
		<?php echo form_open('adminPanel/addSubmeter'); ?>
		<div class="modal-body">
	    	<p>Submeter Name:</p>	  		
	        <input required="required" type="text" class="form-control" value="" placeholder="Submeter Name" name="submeterName" id="submeterName" />         
	    </div><!-- modal body -->
        	<div class="modal-footer">
        	<input required="required" type="submit" class="btn btn-info pull-right" value="Add" name="addSubmeter" id="addSubmeter" />	                                            	
		</div><!-- modal footer -->
        </form>	
	</div><!-- modal content -->
    </div><!-- modal dialog -->
    </div><!-- modal -->

    <!-- Edit submeter modal start-->
    <div id="editSubmeterModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
    <div class="modal-content">
	    <div class="modal-header modal-header-info">
	    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Edit Submeter</h4>
		</div><!-- modal-header -->
		<?php echo form_open('adminPanel/editSubmeter'); ?>
		<div class="modal-body">
	    	<p>Submeter Name:</p>	  		
	        <input required="required" type="text" class="form-control" value="" placeholder="Submeter Name" name="submeterName" id="submeterName" />         
	        <input required="required" type="hidden" name="sName" id="sName" />         
	    </div><!-- modal body -->
        	<div class="modal-footer">
        	<input required="required" type="submit" class="btn btn-info pull-right" value="Save" name="editSubmeter" id="editSubmeter" />	                                            	
		</div><!-- modal footer -->
        </form>	
	</div><!-- modal content -->
    </div><!-- modal dialog -->
    </div><!-- modal -->

	</div> <!--tab container -->
	</div> <!--tab pane-->                               

    <div class="tab-pane" id="ebill">
    <div class="tab-container">
		<div class="page-header">
        	<h4>Electric Bills</h4>
        </div><br/><!-- page-header -->
		<div id="tabs1">
			<ul>
				<li><a href="#tabs1-1">View</a></li>
				<li><a href="#tabs1-2">Add input</a></li>
			</ul>
			
			<div  id="tabs1-1">
				<table class="table table-hover table-responsive eTable" data-toggle="table"  data-select-item-name="myRadioName"  id="e_table" name="e_table">
                <thead>
                <tr class="info">
                	<th>service ID</th>
                    <th>Submeter</th>
                    <th>Start Date</th>
					<th>End Date</th>
                    <th>kWh</th>
                    <th>Cost</th>
                    <th>Gen Charge</th>
                    <th>Tran Charge</th>
                    <th>Dist Charge</th>
					<th>Image</th>
                </tr>
                </thead>
				<tbody id="e_table_body" name="e_table_body">                
					<?php foreach ($ebillList as $ebill): ?>       
				        <?php echo "<tr>"?>       
				        <?php echo "<td>" . $ebill['serviceID'] . "</td>"; ?>
				        <?php echo "<td>" . $ebill['submeterName'] . "</td>"; ?>
				        <?php echo "<td>" . $ebill['startDate'] . "</td>"; ?>
				        <?php echo "<td>" . $ebill['endDate'] . "</td>"; ?>
				        <?php echo "<td>" . $ebill['totalKwh'] . "</td>"; ?>
				        <?php echo "<td>" . $ebill['totalCost'] . "</td>"; ?>
				        <?php echo "<td>" . $ebill['genCharge'] . "</td>"; ?>
				        <?php echo "<td>" . $ebill['transCharge'] . "</td>"; ?>
				        <?php echo "<td>" . $ebill['distCharge'] . "</td>"; ?>
				        <?php echo "<td>" . "<a target='_blank' href=" . base_url() . "public/db_img/ebill/" . $ebill['imgDest'] . ">" . "View" . "</a>" . "</td>"; ?>
				        <?php echo "</tr>"?>
				    <?php endforeach ?>
				</tbody>								
				</table>
	            
			</div><!-- tabs1-1 -->
			<div id="tabs1-2">
				<div class="page-header">
					<h6>Electricity Consumption Form</h6>						
					<p></p>					
				</div><br/><!-- page-header -->								 
				<?php 
			      	$attributes = array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data');
			      	echo form_open_multipart('adminPanel/addEbill', $attributes);
			    ?>	
					<div class="form-group">
						<label for="serviceID" class="col-xs-3 control-label">Service ID</label>
						<div class="col-xs-6">
							<input required="required" type="text" class="form-control" id="serviceID" name="serviceID" placeholder="Service ID">
						</div><!-- col-xs-6 -->
					</div><!-- form-group -->
					<div class="form-group">
						<label for="submeter" class="col-xs-3 control-label">Submeter</label>
						<div class="col-xs-6">									
						<select required="required" class="form-control select select-info" data-toggle="select" id="submeterName" name="submeterName">
							<option value="">Choose submeter</option>	
							<?php foreach ($submeterList as $submeter): ?>       
					          <?php echo "<option value='" . $submeter['submeterName'] . "'>"?>
					          <?php echo $submeter['submeterName']?>
					          <?php echo "</option>"?>
				      		<?php endforeach ?>										
						</select>
						</div><!-- form-group -->
					</div>
					<div class="form-group">
						<label for="startDate1" class="col-xs-3 control-label">Start Date</label>
						<div class="col-xs-6">
							<input required="required" type="text" class="form-control" id="startDate1" name="startDate1" placeholder="YYYY-MM-DD">
						</div><!-- col-xs-6 -->
					</div><!-- form-group -->
					<div class="form-group">
						<label for="endDate1" class="col-xs-3 control-label">End Date</label>
						<div class="col-xs-6">
							<input required="required" type="text" class="form-control" id="endDate1" name="endDate1" placeholder="YYYY-MM-DD">
						</div><!-- col-xs-6 -->
					</div><!-- form-group -->
					<div class="form-group">
						<label for="totalkwh" class="col-xs-3 control-label">Total kwh</label>
						<div class="col-xs-6">
							<input required="required" type="text" class="form-control" id="totalkwh" name="totalKwh" placeholder="Total kwh">
						</div><!-- col-xs-6 -->
					</div>
					<div class="form-group">
						<label for="totalcost" class="col-xs-3 control-label">Total Cost</label>
						<div class="col-xs-6">
							<input required="required" type="text" class="form-control" id="totalCost" name="totalCost" placeholder="Total Cost">
						</div><!-- col-xs-6 -->
					</div><!-- form-group -->
					<div class="form-group">
						<label for="gcharge" class="col-xs-3 control-label">Generation Charge</label>
						<div class="col-xs-6">
							<input required="required" type="text" class="form-control" id="gcharge" name="gcharge" placeholder="Generation Charge">
						</div><!-- col-xs-6 -->
					</div><!-- form-group -->
					<div class="form-group">
						<label for="tcharge" class="col-xs-3 control-label">Transmission Charge</label>
						<div class="col-xs-6">
							<input required="required" type="text" class="form-control" id="tcharge" name="tcharge" placeholder="Transmission Charge">
						</div><!-- col-xs-6 -->
					</div><!-- form-group -->
					<div class="form-group">
						<label for="dcharge" class="col-xs-3 control-label">Distribution Charge</label>
						<div class="col-xs-6">
							<input required="required" type="text" class="form-control" id="dcharge" name="dcharge" placeholder="Distribution Charge">
						</div><!-- col-xs-6 -->
					</div><!-- form-group -->
					<div class="form-group">
						<label for="fileup" class="col-xs-3 control-label">Upload JPEG file</label>
						<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-btn">
							<span class="btn-file btn btn-primary">
							Browse&hellip; <input required="required" type="file" id="userfile" name="userfile">
							</span>
							</span>
							<input required="required" type="text" class="form-control" readonly/>
						</div><!-- input-group -->
						</div><!-- col-xs-6 -->
					</div><!-- form-group -->
					<div class="form-group">
					<div class="col-xs-offset-8">
						<button type="submit" class="btn btn-info" value="Submit" name="submitElec" id="submitElec" name="submitElec">Submit</button>
					</div><!-- col-offset-8 -->
					</div><!-- form-group -->
				</form>	
			</div><!--tabs1-2-->				
		</div><!-- tabs1 -->
	</div> <!--tab container-->
	</div><!--tab pane-->
               
	<div class="tab-pane" id="wbill">
    <div class="tab-container">
	    <div class="page-header">
	    	<h4>Water Bills</h4>
	    </div><br/>
	    <div id="tabs2">
			<ul>
				<li><a href="#tabs2-1">View</a></li>
				<li><a href="#tabs2-2">Add input</a></li>
			</ul>
			
			<div id="tabs2-1">
				<table class="table table-hover table-responsive wTable" data-toggle="table"  data-select-item-name="myRadioName"  id="w_table" name="w_table">
				<thead>
				<tr class="info">
					<th>Service ID</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Total Cubic Meters</th>
					<th>Total Cost</th>
					<th>Image</th>
				</tr>
				</thead>
				<tbody id="w_table_body" name="w_table_body">
					<?php foreach ($wbillList as $wbill): ?>       
				    	<?php echo "<tr>"?>       
				        <?php echo "<td>" . $wbill['serviceID'] . "</td>"; ?>
				        <?php echo "<td>" . $wbill['startDate'] . "</td>"; ?>
				        <?php echo "<td>" . $wbill['endDate'] . "</td>"; ?>
				        <?php echo "<td>" . $wbill['totalCc'] . "</td>"; ?>
				        <?php echo "<td>" . $wbill['totalCost'] . "</td>"; ?>        
				        <?php echo "<td>" . "<a target='_blank' href=" . base_url() . "public/db_img/wbill/" . $wbill['imgDest'] . ">" . "View" . "</a>" . "</td>"; ?>
				        <?php echo "</tr>"?>
				    <?php endforeach ?>
				</tbody>				
				</table>
				
				<form class="small" method="POST" action="">										 
					<input required="required" type="hidden" name="s_v" id="s_v">
				</form>
			</div><!-- tabs2-1 -->
							
			<div id="tabs2-2">
			<div class="page-header">

				<h6>Water Consumption Form</h6>	
			</div><br/><!-- page header -->
			
			<?php 
			      	$attributes = array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data');
			      	echo form_open_multipart('adminPanel/addWbill', $attributes);
			    ?>	

				<div class="form-group">
					<label for="serviceID" class="col-xs-3 control-label">Service ID</label>
					<div class="col-xs-6">
						<input required="required" type="text" class="form-control" id="serviceID" name="serviceID" placeholder="Service ID">
					</div><!-- col-xs-6 -->
				</div><!--form-group-->		
				<div class="form-group">
					<label for="startDate2" class="col-xs-3 control-label">Start Date</label>
					<div class="col-xs-6">
						<input required="required" type="text" class="form-control" id="startDate2" name="startDate2" placeholder="YYYY-MM-DD">
					</div><!-- col-xs-6 -->
				</div><!--form-group-->
				<div class="form-group">
					<label for="endDate2" class="col-xs-3 control-label">End Date</label>
					<div class="col-xs-6">
						<input required="required" type="text" class="form-control" id="endDate2" name="endDate2" placeholder="YYYY-MM-DD">
					</div><!-- col-xs-6 -->
				</div><!-- form-group -->
				<div class="form-group">
					<label for="totalcc" class="col-xs-3 control-label">Total Cc</label>
					<div class="col-xs-6">
						<input required="required" type="text" class="form-control" id="totalCc" name="totalCc" placeholder="Total Cc">
					</div><!-- col-xs-6 -->
				</div><!-- form-group -->
				<div class="form-group">
					<label for="totalcost" class="col-xs-3 control-label">Total Cost</label>
					<div class="col-xs-6">
						<input required="required" type="text" class="form-control" id="totalCost" name="totalCost" placeholder="Total Cost">
					</div><!-- col-xs-6 -->
				</div><!-- form-group -->
				<div class="form-group">
					<label for="fileup" class="col-xs-3 control-label">Upload JPEG file</label>
					<div class="col-xs-6">
					<div class="input-group">
						<span class="input-group-btn">
						<span class="btn btn-primary btn-file">
							Browse&hellip; <input required="required" type="file" id="userfile" name="userfile">
						</span>
						</span>
						<input required="required" type="text" class="form-control" readonly>
					</div><!-- input-group -->
					</div><!-- col-xs-6 -->
				</div><!-- form-group -->
				<div class="form-group">
				<div class="col-xs-offset-8">
					<button type="submit" class="btn btn-info" value="Submit" name="submitWater" id="submitWater" name="submitWater">Submit</button>
				</div><!-- ol-xs-offset-8 -->
				</div><!-- form-group -->
			</form>
			</div><!-- tabs-2-2 -->
		</div><!-- tab2 -->
	</div><!--tab container-->
    </div> <!--tab content-->
           
</div> <!--col xs 10-->
</div><!-- tabbable -->
</div> <!--row--> 
</div> <!-- container -->
<div class = "push"></div>
</div>
<script>

$('#tabPanel a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // store the currently selected tab in the hash value
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
  if(hash) {
    $('#tabPanel a[href="' + hash + '"]').tab('show');
  }
  else{
     $('#tabPanel a[data-toggle="tab"]:first').tab('show');
        }


function toggler(divId) {
    $("#" + divId).toggle();
}
</script>


<script>
	 $(function() {
		$( "#startDate1" ).datepicker({
			dateFormat: 'yy-mm-dd'
		});

	});
	$(function() {
		$( "#endDate1" ).datepicker({
			dateFormat: 'yy-mm-dd'
		});
	});
	$(function() {
		$( "#startDate2" ).datepicker({
			dateFormat: 'yy-mm-dd'
		});
	});
	$(function() {
		$( "#endDate2" ).datepicker({
			dateFormat: 'yy-mm-dd'
		});
	});
</script>	

<script type="text/javascript">
	//navbar toggle
	function toggler(divId) {
    	$("#" + divId).toggle();
	}

	//jquery tabs
	$( "#tabs1" ).tabs();	
	$( "#tabs2" ).tabs();		

</script>	

<script type="text/javascript">
  $(document).ready( function () {
    var stable = $('#submeters_table').DataTable();
    var selected;
    
    $('#s_table_body').on( 'click', 'tr', function () {
      if ( $(this).hasClass('selected') ) {
        $(this).removeClass('selected');
      }
      else {
        stable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
      }
      selected = stable.row('.selected').data();
      selected = selected.toString();              
      document.getElementById("sName").value = selected;      
    } );
    
    var etable = $('#e_table').DataTable();
    var selected;
    
    $('#e_table_body').on( 'click', 'tr', function () {
      if ( $(this).hasClass('selected') ) {
        $(this).removeClass('selected');
      }
      else {
        etable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
      }
      selected = etable.row('.selected').data();
      selected = selected.toString();            
      alert(selected);
      document.getElementById("eName").value = selected;      
    } );
    
    var wtable = $('#w_table').DataTable();
    var selected;
    
    $('#w_table_body').on( 'click', 'tr', function () {
      if ( $(this).hasClass('selected') ) {
        $(this).removeClass('selected');
      }
      else {
        wtable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
      }
      selected = wtable.row('.selected').data();
      selected = selected.toString();            
      alert(selected);
      document.getElementById("sName").value = selected;      
    } );
  } );
</script>
