<div class="col-sm-12">
		<?php if($this->session->flashdata('succ-msg')) {?>
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
				<strong>Success!</strong> <?php echo $this->session->flashdata('succ-msg') ;?>
			</div>
		<?php }	if($this->session->flashdata('err-msg')) {?>
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
				<strong>Error!</strong> <?php echo $this->session->flashdata('err-msg') ;?>
			</div>
		<?php } ?>
</div>