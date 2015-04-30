<div class="container">
<div class="row">
<div class="tabbable tabs-left"> <!-- required for floating -->

	<div class="col-xs-2">
		<ul class="nav nav-tabs tabs-left" id="tabPanel">
      <li class="active"><a href="#buildings" data-toggle="tab"><img src="<?=base_url()?>public/img/icons/png/buildings.png" height="100" width="100" class="displayed"/></a></li>
	    <li><a href="#stat" data-toggle="tab"><img src="<?=base_url()?>public/img/icons/png/stat.png" height="100" width="100" class="displayed"/></a></li>
			<li><a href="#download" data-toggle="tab"><img src="<?=base_url()?>public/img/icons/png/Download.png" height="100" width="100"  class="displayed"/></a></li>
	    <li><a href="#updateProfile" data-toggle="tab"><img src="<?=base_url()?>public/img/icons/png/User-Modify.png" height="100" width="100" class="displayed"/></a></li>
		</ul>
	</div><!--col xs 2-->
	
	<div class="col-xs-10">    
  <div class="tab-content">
  <div class="tab-pane active" active id="buildings">
  <div class="tab-container">
        
    <div class="page-header">
      <h4>Buildings</h4>
    </div><br/>

    <div class="row">
    <div class="col-md-12">                
    </div><!--col-md-12-->
    </div> <!--row-->
		
		<div class="row">
		<table class="table table-hover table-responsive" data-toggle="table"  data-select-item-name="myRadioName" id="buildings_table">
      <thead>
      <tr class="info">
        <th data-radio="true" id="selected"></th>
        <th>Building Name</th>
      </tr>
      </thead>
      <tbody id="b_table_body">
        <?php foreach ($buildingList as $building): ?>       
          <?php echo "<tr><td></td><td>"?>
          <?php echo $building['buildingName']?>
          <?php echo "</td></tr>"?>
      <?php endforeach ?>
      </tbody>
    </table>
		
    
		  <div class="pull-right">					
        <?php echo form_open('adminPanel/buildingView'); ?>
          <input class= "btn btn-info" type="button" id="add_button" value="Add Building" data-toggle="modal" data-target="#addBuildingModal">					        
          <input type="hidden" id="viewBuilding" name="viewBuilding">
  				<input class= "btn btn-info" type="submit" id="view_button"  name="view_button" value="View Selected"	/>  				
        </form>
			</div> <!-- pull-right -->							    
    </div> <!--row-->
                     
		<!--modal start-->
    <div id="addBuildingModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php echo form_open('adminPanel/addBuilding'); ?>
        <div class="modal-header modal-header-info">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Building TO DO: fit text</h4>
        </div><!-- modal-header -->
        <div class="modal-body">        		
  			  <P>Username</P>	
          <input type="text" class="form-control" value="" placeholder="Username (Default: lowercase of Building Name)" name="username" id="username" />
          <P>Password</P> 
          <input type="password" class="form-control" value="" placeholder="Password (Default: same as username)" name="password" id="password" />
          <p>Building Name:</p>
        	<input required="required" type="text" class="form-control" value="" placeholder="Building Name" name="buildingName" id="buildingName" />
          <p>Email:</p>
          <input required="required" type="text" class="form-control" value="" placeholder="Email" name="email" id="email" />
        	<p>Address:</p>
        	<input required="required" type="text" class="form-control" value="" placeholder="Address" name="address" id="address" />
       	</div><!-- modal-body -->
        <div class="modal-footer">
          <input type="submit" class="btn btn-info pull-right" value="Add" name="addBldg" id="addBldg" />		                 
 			  </div><!-- modal-footer -->
      </form>  	
    </div><!-- modal-content -->
    </div><!-- modal-dialog -->
    </div><!-- modal -->
    
    
  </div> <!--tab-container -->
  </div> <!--tab-pane -->        
                
  <div class="tab-pane" id="stat">
  <div class="tab-container">
    <div class="page-header">
      <h4>Statistics</h4>	
    </div><br/><!-- page-header -->		
    <?php 
      $attributes = array('class' => 'form-horizontal', 'role' => 'form');
      echo form_open('adminPanel/statistics', $attributes);
    ?>	 
		  <div class="form-group">
			  <label for="s_month" class="col-xs-3 control-label">Starting Month</label>
				<div class="col-xs-6">									
				<select class="form-control select select-info" data-toggle="select" id="s_month" name="s_month">
				  <option value="">Starting month (Default: January)</option>
					<option value="1">January</option>
					<option value="2">February</option>
					<option value="3">March</option>
					<option value="4">April</option>
					<option value="5">May</option>
					<option value="6">June</option>
					<option value="7">July</option>
					<option value="8">August</option>
					<option value="9">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
				</div><!-- col-xs-6 -->
			</div> <!-- form-group -->
			<div class="form-group">
				<label for="e_month" class="col-xs-3 control-label">Ending Month</label>
				<div class="col-xs-6">									
					<select class="form-control select select-info" data-toggle="select" id="e_month" name="e_month">
						<option value="">Ending month (Default: Current Month)</option>
						<option value="1">January</option>
						<option value="2">February</option>
						<option value="3">March</option>
						<option value="4">April</option>
						<option value="5">May</option>
						<option value="6">June</option>
						<option value="7">July</option>
						<option value="8">August</option>
						<option value="9">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
					</select>
				</div><!-- col-xs-6 -->
			</div><!-- form-group -->
			<div class="form-group">
				<label for="s_year" class="col-xs-3 control-label">Starting Year</label>
				<div class="col-xs-6">									
					<input type="text" class="form-control" id="s_year" name="s_year" placeholder="Starting year (Default: 2010)" >
				</div><!-- col-xs-6 -->
			</div><!-- form-group -->
			<div class="form-group">
				<label for="e_year" class="col-xs-3 control-label">Ending Year</label>
				<div class="col-xs-6">									
					<input type="text" class="form-control" id="e_year" name="e_year" placeholder="Ending year (Default: Current Year)" >
				</div><!-- col-xs-6 -->
			</div> <!-- form-group -->
			<div class="form-group">
				<div class="col-xs-offset-8">
					<button type="submit" class="btn btn-info" value="Submit" name="submitStat" id="submitStat">Submit</button>
				</div> <!-- col-cs-offset-8 -->
			</div>	<!-- form-group -->
		</form>
  </div> <!--tab-container-->
  </div><!--tab-pane-->
               
  <div class="tab-pane"id="download">
  <div class="tab-container">
    <div class="page-header">
      <h4>Downloads</h4>
    </div><br/> <!-- page-header -->
  	<div class="row">
    <div class="col-xs-4">
      <img src="<?=base_url()?>public/img/icons/png/csv.png" class="displayed"/>
      <br/>
      <div class="text-center">
        <a data-toggle="modal" data-target="#report" class="btn btn-info btn-lg">Download</a>
        <br/>
        <p>Consumption Report</p>
      </div><!-- text-center -->
		</div> <!--col-xs-4-->                           
		<div class="col-xs-4">
			<img src="<?=base_url()?>public/img/icons/png/csv.png" class="displayed"/>
      <br/>
      <div class="text-center">
        <a href="eDatabase.php" class="btn btn-info btn-lg">Download</a>
        <br/>
        <p>Electricity Database</p>
      </div><!-- text-center -->   
    </div> <!--col-xs-4-->
		<div class="col-xs-4">
      <img src="<?=base_url()?>public/img/icons/png/csv.png" class="displayed"/>
      <br/>
      <div class="text-center">
        <a href="wDatabase.php" class="btn btn-info btn-lg">Download</a>
        <br/>
        <p>Water Database</p>
      </div> <!-- text-center -->
		</div> <!--col-xs-4-->
		</div> <!--row-->

	  <div id="report" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header modal-header-info">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h5 class="modal-title">Download Report</h5>
		</div><!-- modal-header -->
    <div class="modal-body">
      <form id="form1" name="form1" method="post" action="">
			  <P>Report Type</P>
        <select required="required" class="form-control select select-info" data-toggle="select" id="r_type" name="r_type">
          <option value="">Report Type</option>
          <option value="1">Electricity Report</option>
          <option value="2">Water Report</option>
        </select>
        <P>Building Name</P>
        <select required="required" class="form-control select select-info" data-toggle="select" id="b_name" name="b_name">
          <option value="">Building Name</option>        
        </select> 
        <p>Year</p>
        <input required="required" type="text" class="form-control" value="" placeholder="Year" name="year" id="year" />
        <p>Starting Month</p>
        <select required="required" class="form-control select select-info" data-toggle="select" id="s_month" name="s_month">
          <option value="">Starting month</option>
          <option value="1">January</option>
          <option value="2">February</option>
          <option value="3">March</option>
          <option value="4">April</option>
          <option value="5">May</option>
          <option value="6">June</option>
          <option value="7">July</option>
          <option value="8">August</option>
          <option value="9">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
        <p>Prepared by</p>
        <input required="required" type="text" class="form-control" value="" placeholder="Prepared by" name="p_name" id="p_name" />
        <p>Title</p>
        <input required="required" type="text" class="form-control" value="" placeholder="Title" name="p_title" id="p_title" />
        <p>Noted by</p>
        <input required="required" type="text" class="form-control" value="" placeholder="Noted by" name="n_name" id="n_name" />
        <p>Title</p>
        <input required="required" type="text" class="form-control" value="" placeholder="Title" name="n_title" id="n_title" />
    </div><!-- modal-body -->
    <div class="modal-footer">
      <input type="submit" class="btn btn-info pull-right" value="Download" name="dl_report" id="dl_report" />                                        
    </div><!-- modal-footer -->
    </form>   
  </div><!-- modal-content -->
  </div><!-- modal-dialog -->
  </div><!-- modal -->
  </div><!--tab container-->
  </div> <!--tab pane-->
	<div class="tab-pane" id="updateProfile">
  <div class="tab-container">
  <div class="page-header">
    <h4>Update Profile</h4>
    </div><br/><!-- page-header -->
		<div class="row">
    <div class="col-md-12">
      <br/>
			<h6>Change Email Address</h6>
      <form class="form-horizontal" role="form" method="POST" action="">                                
			  <div class="form-group">
          <label for="new_email" class="col-xs-3 control-label">New Email address</label>
          <div class="col-lg-6">
            <input required="required" type="email" class="form-control" id="new_email" name="new_email" placeholder="New email">
          </div> <!-- col-lg-6 -->
				</div><!-- form-group -->
        <div class="form-group">
        <div class="col-xs-offset-2 col-xs-5 pull-right">
          <button type="submit" class="btn btn-info" id="change_email" name="change_email">Save Changes</button>
        </div><!-- col-lg-2 -->
        </div><!-- form-group -->
			</form>
    </div><!-- col-md-12 -->
		</div><!-- row -->
                              
		<div class="row">
    <div class="col-md-12"><br/>
      <h6>Change Password</h6>
      <form class="form-horizontal" role="form" method="POST" action="">
        <div class="form-group">
          <label for="current_pw" class="col-xs-3 control-label">Current Password</label>
          <div class="col-lg-6">
            <input required="required" type="password" class="form-control" id="current_p" name="current_p" placeholder="Current Password">
				  </div> <!-- col-lg-6 -->
				</div> <!-- form-group -->
				<div class="form-group">
					<label for="new_p" class="col-xs-3 control-label">New Password</label>
          <div class="col-lg-6">
            <input required="required" type="password" class="form-control" id="new_p" name="new_p" placeholder="New Password">
				  </div><!-- col-lg-6 -->
				</div> <!-- form-group -->
        <div class="form-group">
          <label for="retype_p" class="col-xs-3 control-label">Retype Password</label>
          <div class="col-lg-6">
            <input required="required" type="password" class="form-control" id="retype_p" name="retype_p" placeholder="Retype Password">
				  </div> <!-- col-lg-6 -->
				</div> <!--  form-group -->
				<div class="form-group">
        <div class="col-xs-offset-2 col-xs-5 pull-right">
          <button type="submit" id="change_p" name="change_p" class="btn btn-info">Save Changes</button>
        </div><!-- col=xs.offset-2 -->
        </div><!-- form-group -->
		  </form>
		</div><!-- col-md-12 -->
    </div><!-- row -->
  </div> <!--tab container-->
  </div><!--tab pane-->
</div> <!--col xs 10-->
</div><!-- tabbable -->
</div> <!--row--> 
</div> <!-- container -->
<div class = "push"></div>

<script type="text/javascript">
  $(document).ready( function () {
    var table = $('#buildings_table').DataTable();
    var selected;
    
    $('#b_table_body').on( 'click', 'tr', function () {
      if ( $(this).hasClass('selected') ) {
        $(this).removeClass('selected');
      }
      else {
        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
      }
      selected = table.row('.selected').data();
      selected = selected.toString();
      selected = selected.split(',')[1];      
      alert(selected);
      document.getElementById("viewBuilding").value = selected;      
    } );
    
    
    
  } );
</script>