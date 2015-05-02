<div class="container">
<div class="row">
<div class="tabbable tabs-left"> <!-- required for floating -->
<!-- Nav tabs -->
<div class="col-xs-2">
  <ul class="nav nav-tabs tabs-left" id="tabPanel">
	 <li class="active"><a href="#elect" data-toggle="tab"><img src="<?=base_url()?>public/img/icons/png/Light-Bulb.png" height="100" width="100" class="displayed"/></a></li>
	 <li><a href="#water" data-toggle="tab"><img src="<?=base_url()?>public/img/icons/png/Water-Tap.png" height="100" width="100" class="displayed"/></a></li>
	 <li><a href="<?=site_url('adminPanel/main')?>"><img src="<?=base_url()?>public/img/icons/png/back.png" height="100" width="100" class="displayed"/></a></li>
  </ul>
</div><!--col xs 2-->
		    
<div class="col-xs-10">
<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane active" active id="elect">
<div class="tab-container">
  <div class="page-header">
    <h4>Electricity Statistics</h4>
  </div><br/><!-- page-header -->
  <div class="row">
  <div class="col-md-12">  
  </div><!--col-md-12-->
  </div> <!--row-->
  <table class='table table-hover table-bordered table-responsive' id='e_stat_table' name='e_stat_table'>
    <thead>
    <tr class='info'>
		  <th>Building Name</th>	
      <th>Submeter Name</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Total kWh</th>
      <th>Total Cost</th>
    </tr>
    </thead>
    <tbody>    
      <?php foreach ($ebillStat as $ebill): ?>       
        <?php echo "<tr>"?>       
        <?php echo "<td>" . $ebill['buildingName'] . "</td>"; ?>
        <?php echo "<td>" . $ebill['submeterName'] . "</td>"; ?>
        <?php echo "<td>" . $ebill['startDate'] . "</td>"; ?>
        <?php echo "<td>" . $ebill['endDate'] . "</td>"; ?>
        <?php echo "<td>" . $ebill['totalKwh'] . "</td>"; ?>
        <?php echo "<td>" . $ebill['totalCost'] . "</td>"; ?>        
        <?php echo "</tr>"?>
      <?php endforeach ?>
    </tbody>
	</table>
</div> <!--tab container -->
</div> <!--tab-pane-->
                
<div class="tab-pane" id="water">
<div class="tab-container">
  <div class="page-header">
    <h4>Water Statistics</h4>	
  </div><br/><!-- page-header -->
  <table class='table table-hover table-bordered table-responsive' id='w_stat_table' name='w_stat_table'>
    <thead>
    <tr class='info'>
  	  <th>Building Name</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Total Cubic Meters</th>
      <th>Total Cost</th>
    </tr>
    </thead>
    <tbody>
      <?php foreach ($wbillStat as $wbill): ?>       
        <?php echo "<tr>"?>       
        <?php echo "<td>" . $wbill['buildingName'] . "</td>"; ?>
        <?php echo "<td>" . $wbill['startDate'] . "</td>"; ?>
        <?php echo "<td>" . $wbill['endDate'] . "</td>"; ?>
        <?php echo "<td>" . $wbill['totalCc'] . "</td>"; ?>
        <?php echo "<td>" . $wbill['totalCost'] . "</td>"; ?>        
        <?php echo "</tr>"?>
      <?php endforeach ?>
  	</tbody>
	</table>
</div> <!--tab container-->
</div><!--tab pane-->
               
</div><!-- tab content -->    
</div> <!--col xs 10-->
</div><!--  tabbable -->
</div> <!--row--> 
<div class = "push"></div>
</div> <!-- end of container div -->
