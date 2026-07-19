<!-- BEGIN ROW -->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN CHART PORTLET-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bar-chart font-green-haze"></i>
					<span class="caption-subject bold uppercase font-green-haze"> Offer Chart</span>
					<span class="caption-helper">offer chart for last 15 days</span>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="fullscreen">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div id="SmartChart_1" class="chart" style="height: 500px;"></div>	
			</div>
		</div>
		<!-- END CHART PORTLET-->
	</div>
</div>
<!-- END ROW -->
<script>
var SmartChart1 = <?php if(isset($SmartChart1) && !empty($SmartChart1)) { echo $SmartChart1;} else { echo"[]";}?>;
</script>