<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); ?>

<div class="col-md-12 ">
	<!-- BEGIN SAMPLE FORM PORTLET-->
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-cogs font-green-sharp"></i> 
				<span class="caption-subject font-green-sharp bold uppercase">List Clients</span>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				<div class="row">
					<div class="col-md-6">
						<div class="btn-group">
							<a href="<?php echo site_url();?>client" class="btn green">
							Add New <i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			<table class="table table-striped table-bordered table-hover" id="table-list-sites">
				<thead>
					<tr>
						<th>Client Name</th>
						<th>Email</th>
						<th>Phone Number</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($list_clients) > 0) { foreach ($list_clients as $value) { ?>
					<tr class="odd gradeX">
						<td><?php echo $value->client_name;?></td>
						<td><?php echo $value->client_email;?></td>
						<td><?php echo $value->client_phone_number;?></td>
						<td><?php echo $value->client_status;?></td>
						<td>
							<a href="<?php echo base_url();?>client/index/<?php echo $value->id;?>" class="btn default btn-xs purple"><i class="fa fa-edit"></i> Edit </a>
							<a link="<?php echo base_url();?>client/delete_client/<?php echo $value->id;?>" class="btn default btn-xs black deleteButton" data-toggle="modal"><i class="fa fa-trash-o"></i> Delete </a>
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
<div class="modal fade" id="deleteData" tabindex="-1" role="deleteClient" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				 Are you sure want to delete this Client ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<a href="" id="deleteLink" class="btn blue">Save changes</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->