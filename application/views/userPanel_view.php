<div class="container">
<div class="row">
<div class="tabbable tabs-left"> <!-- required for floating -->
          <!-- Nav tabs -->
<div class="col-xs-2">
<ul class="nav nav-tabs tabs-left" id="tabPanel">
  <li class="active"><a href="#profile" data-toggle="tab"><img src="<?=base_url()?>public/img/icons/png/User-Profile.png" height="100" width="100" class="displayed"/></a></li>
  <li><a href="#update" data-toggle="tab"><img src="<?=base_url()?>public/img/icons/png/User-Modify.png" height="100" width="100" class="displayed"/></a></li>
	<li><a href="#viewElectric" data-toggle="tab"><img src="<?=base_url()?>public/img/icons/png/Light-Bulb.png" height="100" width="100"  class="displayed"/></a></li>
	<li><a href="#viewWater" data-toggle="tab"><img src="<?=base_url()?>public/img/icons/png/Water-Tap.png" height="100" width="100"  class="displayed"/></a></li>
</ul>
</div><!--col xs 2-->

<div class="col-xs-10">
<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane active" id="profile">
<div class="tab-container">
  <div class="page-header">
    <h4><?=$buildingName?> Profile</h4>
  </div><br/> <!--page-header-->
  <div align="left">
  <table width="867" height="307" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="107"><h6>Building Name: 
        <?php foreach ($userData as $info): ?>             
          <?php echo $info['buildingName']; ?>
        <?php endforeach ?>
      </h6></td>
      <td width="203"><h6>&nbsp;</h6></td>
    </tr>
    <tr>
      <td><h6>Address: 
        <?php foreach ($userData as $info): ?>             
          <?php echo $info['address']; ?>
        <?php endforeach ?>
      </h6></td>
      <td><h6>&nbsp;</h6></td>
    </tr>
    <tr>
      <td><h6>Username: 
        <?php foreach ($userData as $info): ?>             
          <?php echo $info['username']; ?>
        <?php endforeach ?>
      </h6></td>
      <td><h6>&nbsp;</h6></td>
    </tr>
    <tr>
      <td><h6>Email Address: 
        <?php foreach ($userData as $info): ?>             
          <?php echo $info['email']; ?>
        <?php endforeach ?>
      </h6></td>
      <td><h6>&nbsp;</h6></td>
    </tr>
    <tr>
      <td height="59"><h6>&nbsp;</h6></td>
      <td><h6>&nbsp;</h6></td>
    </tr>
    
  </table>
  </div> <!-- align-left -->
</div> <!--tab container -->
</div> <!--tab pane-->
<div class="tab-pane" id="update">
<div class="tab-container">
  <div class="page-header">
    <h6>Update Profile</h6>	
  </div><!-- page-header -->
  <div class="row">
  <div class="col-md-12">
    <br/>
    <h6>Change Email Address</h6>    
      <?php 
        $attributes = array('class' => 'form-horizontal', 'role' => 'form');
        echo form_open('userPanel/changeEmail', $attributes);
      ?>   
      <div class="form-group">
        <label for="new_email" class="col-xs-3 control-label">New Email address</label>
        <div class="col-lg-6">
          <input required="required" type="email" class="form-control" id="new_email" name="new_email" placeholder="New email">
        </div><!-- col-lg-6 -->
      </div><!-- form-group -->
      <div class="form-group">
      <div class="col-xs-offset-2 col-xs-5 pull-right">
        <button type="submit" class="btn btn-info" id="change_email" name="change_email">Save Changes</button>
      </div><!-- col-xs-offset-2 -->
      </div><!-- form-group -->
    </form>
  </div><!-- /.col-md-12 -->
  </div><!-- /.row -->
  <div class="row">
  <div class="col-md-12"><br/>
    <h6>Change Password</h6>
    <?php 
      $attributes = array('class' => 'form-horizontal', 'role' => 'form');
      echo form_open('userPanel/changePassword', $attributes);
    ?>     
      <div class="form-group">
        <label for="current_pw" class="col-xs-3 control-label">Current Password</label>
        <div class="col-lg-6">
          <input required="required" type="password" class="form-control" id="current_p" name="current_p" placeholder="Current Password">
        </div><!-- col-lg-6 -->
      </div><!-- form-group -->
      <div class="form-group">
        <label for="new_p" class="col-xs-3 control-label">New Password</label>
        <div class="col-lg-6">
          <input required="required" type="password" class="form-control" id="new_p" name="new_p" placeholder="New Password">
        </div><!-- col-lg-6 -->
      </div><!-- form-group -->
      <div class="form-group">
        <label for="retype_p" class="col-xs-3 control-label">Retype Password</label>
        <div class="col-lg-6">
          <input required="required" type="password" class="form-control" id="retype_p" name="retype_p" placeholder="Retype Password">
        </div><!-- col-lg-6 -->
      </div><!-- form-group -->
      <div class="form-group">
      <div class="col-xs-offset-2 col-xs-5 pull-right">
        <button type="submit" id="change_p" name="change_p" class="btn btn-info">Save Changes</button>
      </div><!-- col-lg-6 -->
      </div><!-- form-group -->
    </form>
  </div><!-- /.col-md-12 -->
  </div><!-- /.row -->
</div> <!--tab container-->
</div><!--tab pane-->
<div class="tab-pane" id="viewElectric">
<div class="tab-container">
  <div class="page-header">
    <h4>Electricity Consumption</h4>
  </div><br/><!-- page-header -->
  <div class="row">
  <table class="table table-hover table-bordered table-responsive" id="e_table" name="e_table">
    <thead>
    <tr class="info">
      <th>Service ID</th>
      <th>Submeter Name</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Total kWh</th>
      <th>Total Cost</th>
      <th>Gen Charge</th>
      <th>Trans Charge</th>
      <th>Dist Charge</th>
			<th>Image</th>
    </tr>
    </thead>
    <tbody>
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
  </div><!-- row -->
</div><!--tab container-->
</div> <!--tab pane-->
<div class="tab-pane" id="viewWater">
<div class="tab-container">
  <div class="page-header">
    <h4>Water Consumption</h4>
  </div><br/><!-- page-header -->
  <div class="row">
  <table class="table table-hover table-bordered table-responsive" id="w_table" name="w_table">
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
    <tbody>
      <?php foreach ($wbillList as $wbill): ?>       
        <?php echo "<tr>"?>       
        <?php echo "<td>" . $wbill['serviceID'] . "</td>"; ?>
        <?php echo "<td>" . $wbill['startDate'] . "</td>"; ?>
        <?php echo "<td>" . $wbill['endDate'] . "</td>"; ?>
        <?php echo "<td>" . $wbill['totalCc'] . "</td>"; ?>
        <?php echo "<td>" . $wbill['totalCost'] . "</td>"; ?>        
        <?php echo "<td>" . "<a target='_blank' href=" . base_url() . "public/db_img/wbill/" . $ebill['imgDest'] . ">" . "View" . "</a>" . "</td>"; ?>
        <?php echo "</tr>"?>
      <?php endforeach ?>
    </tbody>
  </table>
  </div><!-- row -->
</div><!-- tab-container -->
</div><!-- tab-pane -->
</div> <!--tab content-->
</div> <!--col xs 10-->
</div><!-- tabbable -->
</div> <!--row--> 
<div class = "push"></div>
</div> <!-- container -->

<script type="text/javascript">
  $(document).ready( function () {
    var etable = $('#e_table').DataTable();    
    var wtable = $('#w_table').DataTable();    
  } );
</script>