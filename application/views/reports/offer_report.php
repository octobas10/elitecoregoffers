<?php 
//echo"<pre>";print_r($result);echo"</pre>";exit;
?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs font-green-sharp"></i> 
					<span class="caption-subject font-green-sharp bold uppercase">Offer Report</span>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""></a> 
					<a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""></a> 
					<a href="javascript:;" class="reload" data-original-title="" title=""></a> 
					<a href="javascript:;" class="remove" data-original-title="" title=""></a>
				</div>
			</div>
			<div class="portlet-body">
				<form action="<?php echo base_url();?>reports/offer_report" method='post'>
					<div class="row">
						<div class="col-md-3">
							<label>Client Name</label>
							<select name="client_id" class="form-control input-medium">
								<option value="">ALL</option>
								<?php if(count($list_client)>0) { foreach ($list_client as $key=>$value) { ?>
								<option value="<?php echo $key;?>" <?php if(!empty($client_id) && $client_id==$key) { echo"selected";}?>><?php echo $value;?></option>
								<?php } } ?>
							</select>
						</div>
						<div class="col-md-3">
							<label>Offer Name</label>
							<select name="offer_id" class="form-control input-medium">
								<option value="">ALL</option>
								<?php if(count($list_offer)>0) { foreach ($list_offer as $key=>$value) { ?>
								<option value="<?php echo $key;?>" <?php if(!empty($offer_id) && $offer_id==$key) { echo"selected";}?>><?php echo $value;?></option>
								<?php } } ?>
							</select>
						</div>
						
						
						<div class="col-md-3">
							<label>Date Range</label>
							<div class="input-group">
								<input type="text" class="form-control" value="<?php if(isset($daterange)) {echo $daterange;} ?>" placeholder='Date Range' name="daterange" id="daterange_left">
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
					<!--<div class="col-md-12">
						<div class="col-md-6 pull-left">Showing <?php //echo $showing_rows;?> out of <?php //echo $total_rows;?> rows</div>
						<div class="col-md-6 pull-right"><?php //echo $page_link;?></div>
					</div>-->
					<table class="table table-hover tablesorter" id="offer_data">
						<thead>
							<tr>
								<th>#</th>
								<?php /*?><th>Site</th><?php */ ?>
								<th>Offer</th>
								<th>Client</th>
								<th>Displayed</th>
								<th>Submitted</th>
								<th>Accepted</th>								
								<th>Payout</th>
								<th>EAR</th>
								<?php /*?>
								<th>Scrup Rate</th>
								<th>Gross</th>
								<th>Net</th>
								<th>eCPM</th>
								<th>subid</th>
								<th>Date</th>
								<?php */ ?>
							</tr>
						</thead>
						<tbody>
						<?php if(count($result)>0){ $count=1;
						$total_displayed = 0;$total_submitted = 0;$total_accepted = 0;$total_payout = 0;$total_so_ear = 0;
						foreach ($result as $value) {
						$accepted = $value->accepted;
						$so_payout = (!empty($value->so_payout)) ? $value->so_payout : 0; 
						$payout = (int)(($so_payout)*$accepted); 
						$so_ear	= round($value->so_ear * $payout /100 );
						
						$total_displayed = $total_displayed + $value->displayed;
						$total_submitted = $total_submitted + $value->submitted;
						$total_accepted = $total_accepted + $accepted;
						$total_payout = $total_payout + $payout;
						$total_so_ear = $total_so_ear + $so_ear;
						
						?>	
							<tr>
								<td><?php echo $value->offer_id;?></td>
								<?php /*?><td><?php echo $list_site[$value->site_id];?></td><?php */?>
								<td><?php echo $list_offer[$value->offer_id];?></td>
								<td><?php echo $list_client[$value->client_id];?></td>
								<td><?php echo $value->displayed;?></td>
								<td><a href="list_client_trans?offer_id=<?=$value->offer_id?>&daterange=<?=$daterange?>"><?php echo $value->submitted;?></a></td>
								<td><a href="list_client_trans?offer_id=<?=$value->offer_id?>&daterange=<?=$daterange?>&status=1"><?php echo $accepted;?></a></td>								
								<td>$<?php echo (!empty($payout)) ? $payout : "0.00";?></td>
								<td>$<?php echo (!empty($so_ear)) ? $so_ear : 0;?></td>
								<?php /*?>
								<td><?php echo (!empty($value->scrup_rate)) ? $value->scrup_rate : 0;?>%</td>
								<td><?php echo (!empty($value->gross)) ? $value->gross : 0;?>%</td>
								<td><?php echo (!empty($value->net)) ? $value->net : 0;?>%</td>
								<td><?php echo (!empty($value->eCPM)) ? $value->eCPM : 0;?>%</td>
								<td><?php echo $value->subid;?></td>
								<td><?php echo $value->date_created;?></td>
								<?php */?>
							</tr>	
						<?php $count++;}  ?>						
						</tbody>
						<tr>
								<th></th>
								<th></th>
								<th></th>
								<th><?=$total_displayed?></th>
								<th><?=$total_submitted?></th>
								<th><?=$total_accepted?></th>								
								<th>$<?=$total_payout?></th>
								<th>$<?=$total_so_ear?></th>
								
						</tr>
						<?php } else{?>
						<tr>
							<th colspan="8">No Records Found</th>
						</tr>
						<?php } ?>	
					</table>
					<!--<div class="col-md-12">
						<div class="col-md-6 pull-left">Showing <?php //echo $showing_rows;?> out of <?php //echo $total_rows;?> rows</div>
						<div class="col-md-6 pull-right"><?php //echo $page_link;?></div>
					</div>-->
				</div>
			</div>
		</div>
		<!-- END SAMPLE TABLE PORTLET-->
	</div>
</div>
<script src='https://code.jquery.com/jquery-1.10.2.js'></script>
<script><!--
$('select[name=\'client_id\']').on('change', function() {
$.ajax({
  url: '<?php echo base_url();?>client/list_offers_by_client/' + $(this).val(),
  dataType: 'json',
  beforeSend: function() {
	$('select[name=\'client_id\']').prop('disabled', true);
  },
  complete: function() {
	$('select[name=\'client_id\']').prop('disabled', false);
  },
  success: function(json) {
		var html="";
		html += '<option value="">ALL</option>';
		if (json['count']>0) {
			for (i = 0; i < json['count']; i++) {
				html += '<option value="' + json['result'][i]['id'] + '">'+json['result'][i]['offer_name'] + '</option>';
			}
		} 
	$('select[name=\'offer_id\']').html(html);
  },
  error: function(xhr, ajaxOptions, thrownError) {
	alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
  }
});
});
</script>
<?php if (isset($client_id) && $client_id!=""){?>
<script><!--
	$('select[name=\'client_id\']').trigger('change');
</script>
<?php } ?>

</script>	  