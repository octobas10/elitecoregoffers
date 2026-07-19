<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); ?>

<div class="col-md-12 ">
	<!-- BEGIN SAMPLE FORM PORTLET-->
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-cogs font-green-sharp"></i> 
				<span class="caption-subject font-green-sharp bold uppercase">List Offers</span>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				<div class="row">
					<div class="col-md-6">
						<div class="btn-group">
							<a href="<?php echo site_url();?>offer/add_offer" class="btn green">
							Add New <i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			<table class="table table-striped table-bordered table-hover" id="table-list-sites">
				<thead>
					<tr>
						<th>Offer ID</th>	
						<th style="max-width:200px;">Offer Name</th>
						<th>Client Name</th>
						<th>Transfer Method</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($list_offers) > 0) { foreach ($list_offers as $value) { ?>
					<tr class="odd gradeX">
						<td><?php echo $value->id;?></td>
						<td><?php echo $value->offer_name;?></td>
						<td><?php echo $list_clients[$value->client_id];?></td>
						<td><?php echo $value->transfer_method;?></td>
						<td>
							<a href="<?php echo base_url();?>offer/add_offer/<?php echo $value->id;?>" class="btn default btn-xs purple"><i class="fa fa-edit"></i> Edit </a>
							<?php if($value->status_pause =='0'){ ?>
							<a href="#" link="<?php echo base_url();?>offer/pause_offer/<?php echo $value->id;?>" class="btn default btn-xs blue pauseButton" data-toggle="modal"><i class="fa fa-tag -o"></i>Pause</a>
							<?php }else{ ?>
							<a href="#" link="<?php echo base_url();?>offer/unpause_offer/<?php echo $value->id;?>" class="btn default btn-xs green unpauseButton" data-toggle="modal"><i class="fa fa-tags -o"></i>Resume</a>
							<?php } ?>
							<a href="#" link="<?php echo base_url();?>offer/delete_offer/<?php echo $value->id;?>" class="btn default btn-xs red deleteButton" data-toggle="modal"><i class="fa fa-trash-o"></i>Delete</a>
						</td>
					</tr>
					<?php } } ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- END SAMPLE FORM PORTLET-->
</div>

<!-- model -->
<div class="modal fade" id="deleteData" tabindex="-1" role="deleteOffer" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				 Are you sure want to delete this offer ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<a href="" id="deleteLink" class="btn blue">Save changes</a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="pauseData" tabindex="-1" role="pauseOffer" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				 Are you sure want to Pause this offer ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<a href="" id="pauseLink" class="btn blue">Save changes</a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="unpauseData" tabindex="-1" role="unpauseOffer" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				 Are you sure want to Unpause this offer ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<a href="" id="unpauseLink" class="btn blue">Save changes</a>
			</div>
		</div>
	</div>
</div>