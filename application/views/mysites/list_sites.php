<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); ?>

<div class="col-md-12 ">
	<!-- BEGIN SAMPLE FORM PORTLET-->
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-cogs font-green-sharp"></i> 
				<span class="caption-subject font-green-sharp bold uppercase">List Sites</span>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-toolbar">
				<div class="row">
					<div class="col-md-6">
						<div class="btn-group">
							<a href="<?php echo site_url();?>MySite" class="btn green">
							Add New <i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			<table class="table table-striped table-bordered table-hover" id="table-list-sites">
				<thead>
					<tr>
						<th>Site ID</th>
						<th>Site Name</th>
						<th>Affiliate ID</th>
						<th>Display Offer Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($list_sites) > 0) { foreach ($list_sites as $value) { ?>
					<tr class="odd gradeX">
						<td><?php echo $value->id;?></td>
						<td><?php echo $value->site_name;?></td>
						<td><?php echo $value->affiliate_name;?></td>
						<td><?php echo (!empty($GLOBALS['DISPLAY_OFFER_TYPE'][$value->display_offer_type])) ? $GLOBALS['DISPLAY_OFFER_TYPE'][$value->display_offer_type] : " ";?></td>
						<td>
							<a href="<?php echo base_url();?>MySite/index/<?php echo $value->id;?>" class="btn default btn-xs purple"><i class="fa fa-edit"></i> Edit </a>
							
						</td>
					</tr>
					<?php } } ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- END SAMPLE FORM PORTLET-->
</div>