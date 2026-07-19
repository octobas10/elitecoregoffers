<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs font-green-sharp"></i> 
					<span class="caption-subject font-green-sharp bold uppercase">Client Transaction Data</span>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""></a> 
					<a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""></a> 
					<a href="javascript:;" class="reload" data-original-title="" title=""></a> 
					<a href="javascript:;" class="remove" data-original-title="" title=""></a>
				</div>
			</div>
			<div class="portlet-body">
				<form action="<?php echo base_url();?>reports/list_client_trans" method='post'>
					<div class="row">
						<div class="col-md-3">
							<label>Offer Name</label>
							<select name="offer_id" class="form-control input-medium">
								<option value="">ALL</option>
								<?php if(count($list_offer)>0) { foreach ($list_offer as $key=>$value) { ?>
								<option value="<?php echo $key;?>" <?php if(!empty($offer_id) && $offer_id==$key) { echo"selected";}?>><?php echo $value;?></option>
								<?php } } ?>
							</select>
						</div>
						<div class="col-md-2">

							<label>Status</label>
							<select name="status" class="form-control input-small">
								<option value=''>ALL</option>
								<option value='1' <?php if(isset($status) && $status=="1") { echo"selected";}?>>Accepted</option>									
								<option value='0' <?php if(isset($status) && $status=="0") { echo"selected";}?>>Rejected</option>
							</select>
						</div>
						
						<div class="col-md-3">
							<label>Date Range</label>
							<div class="input-group">
								<input type="text" class="form-control" value="<?php if(isset($daterange)) {echo $daterange;} ?>" placeholder='Date Range' name="daterange">
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
								<th>#</th>
								<th>Offer Name</th>
								<th width="20%">Request Data</th>
								<th>Response Data</th>
								<th>Status</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
						<?php if(count($result)>0){ $count=1; 
						foreach ($result as $value) {
							//echo $value->offer_id;print_r($list_offer);exit;
							?>	
							<tr>
								<td><?php echo $count;?></td>
								<td><?php echo (isset($list_offer[$value->offer_id]) ? $list_offer[$value->offer_id] : "Offer Id : ".$value->offer_id. ' is Not Available or Removed') ;?></td>
								<td class='request-data-td'><?php echo urldecode(htmlentities($value->request_data));?></td>
								<td><?php echo html_entity_decode(($value->response_data));?></td>
								<td><?php echo ($value->status==1) ? "Accepted" : "Rejected";?></td>
								<td><?php echo $value->date_created;?></td>
							</tr>	
						<?php $count++;} } ?>						
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