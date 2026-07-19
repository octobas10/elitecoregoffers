<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs font-green-sharp"></i> 
					<span class="caption-subject font-green-sharp bold uppercase">Offer Data</span>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""></a> 
					<a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""></a> 
					<a href="javascript:;" class="reload" data-original-title="" title=""></a> 
					<a href="javascript:;" class="remove" data-original-title="" title=""></a>
				</div>
			</div>
			<div class="portlet-body">
				<form action="<?php echo base_url();?>reports/list_offer_data" method='post'>
					<div class="row">
						<div class="col-md-3">
							<label>Search</label>
							<div class="input-group1">
								<input type="text" class="form-control" placeholder='Name,Email,Homephone,Zip'  value="<?php if(!empty($search_offer_data)) { echo $search_offer_data;} ?>"  name="search_offer_data" >
							</div>
							<!-- /input-group -->
						</div>
						<div class="col-md-3">
							<label>Date Range</label>
							<div class="input-group">
								<input type="text" class="form-control" placeholder='Date Range'  value="<?php if(isset($daterange)) {echo $daterange;} ?>"  name="daterange">
								<span class="input-group-btn">
								<button class="btn blue" type="submit">Go!</button>
								</span>
							</div>
							<!-- /input-group -->
						</div>
						<!-- /.col-md-6 -->
					</div>
				</form>
				<div class="table-scrollable">
					<div class="col-md-12">
						<div class="col-md-6 pull-left">Showing <?php echo $showing_rows;?> out of <?php echo $total_rows;?> rows</div>
						<div class="col-md-6 pull-right"><?php echo $page_link;?></div>
					</div>
					<table class="table table-hover tablesorter" id="offer_data">
						<thead>
							<tr>
								<!--<th>#</th>-->
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Date of Birth</th>
								<th>Homephone</th>
								<th>Zipcode</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
						<?php if(count($result)>0){ $count=1; 
						foreach ($result as $value) { ?>	
							<tr>
								<!--<td><?php echo $count;?></td>-->
								<td><?php echo $value->so_first_name;?></td>
								<td><?php echo $value->so_last_name;?></td>
								<td><?php echo $value->so_email;?></td>
								<td><?php echo $value->so_dob;?></td>
								<td><?php echo $value->so_homephone;?></td>
								<td><?php echo $value->so_zipcode;?></td>
								<td class="details-control" align="center"></td>
							</tr>
							
							<tr class="trdetails" style="display:none;">
								<td colspan="9">
									<div class="other_field pull-left"><b>Workphone</b> : <?php echo (!empty($value->so_workphone)) ? $value->so_workphone : "NULL";?></div>
									<div class="other_field pull-left"><b>Mobilephone</b> : <?php echo (!empty($value->so_mobilephone))? $value->so_mobilephone : "NULL";?></div>
									<div class="other_field pull-left"><b>Addres</b> : <?php echo (!empty($value->so_address)) ? $value->so_address : "NULL";?></div>
									<div class="other_field pull-left"><b>City</b> : <?php echo (!empty($value->so_city)) ? $value->so_city : "NULL";?></div>
									<div class="other_field pull-left"><b>State</b> : <?php echo (!empty($value->so_state)) ? $value->so_state : "NULL";?></div>
									<?php 									
									if(strlen($value->other)>2) {
									$delails = json_decode($value->other);
									foreach ($delails as $dkey=>$dvalue) { ?>
									<div class="other_field pull-left"><b><?php echo ucfirst($dkey);?></b> : <?php echo json_encode($dvalue);?></div>
									<?php } } ?>
								</td>
							</tr>	
						<?php $count++; } } ?>						
						</tbody>
					</table>
					<div class="col-md-12">
						<div class="col-md-6 pull-left">Showing <?php echo $showing_rows;?> out of <?php echo $total_rows;?> rows</div>
						<div class="col-md-6 pull-right"><?php echo $page_link;?></div>
					</div>
				</div>
			</div>
		</div>
		<!-- END SAMPLE TABLE PORTLET-->
	</div>
</div>