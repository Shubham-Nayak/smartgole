<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="successformdiv" id="successformdiv"></div>
 <?php if( $this->session->flashdata('commonerrorrmsg') ) { ?>
	<?php echo $this->session->flashdata('commonerrorrmsg');?>
<?php }
$streams=array(
	'science'=>'Science',
	'commerce'=>'Commerce',

);
?>
<?php echo form_open(adminsbase_url('dashboard/savegole'), 'class="" id="ajax-save-form" method="POST"');?>
<div class="row">
	<div class="col-9-xxxl col-xl-9">
		<div class="card">
			<div class="card-body">
				<div class="heading-layout1">
					<div class="item-title">
						<h5><?php echo ($info['autoid'] != '' ? 'Edit Agent' : 'Add New'); ?> Goles </h5>
					</div>
				</div>
				<hr/>
				<div class="row">
				<div class="col-xl-6 col-lg-6 col-12 form-group">
						<label>For Date</label>
						<?php if(empty($info['created_on'])):?>
						<input type="text"  class="form-control" value="<?php echo date('d-m-Y');?>" readonly>
						<?php else:?>
							<input type="text"  class="form-control" value="<?php echo date('d-m-Y',strtotime($info['created_on']));?>" readonly>
						<?php endif;?>
					</div>
					<div class="col-xl-6 col-lg-6 col-12 form-group">
						<label>Gole  *</label>
						<input type="text" name="title" class="form-control" value="<?php echo $info['title'];?>" required>
					</div>
					<div class="col-lg-12 col-12 form-group">
						<label>Description <small>( Short note or Expected Time )</small> </label>
						<input type="text" name="description" class="form-control" value="<?php echo $info['description'];?>" >
					</div>	
				
					
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 form-group mg-t-12">
		<div class="errormessageformdiv" id="errormessageformdiv"></div>
		<button type="submit" class="btn-fill-lg font-normal no-radius text-light gradient-pastel-green">Save</button>
		<a href="<?php echo adminsbase_url('dashboard/index'); ?>"><button type="button" class="btn-fill-lmd text-light gradient-dodger-blue"> <i class="fas fa-angle-left"></i> Back to list</button></a>
		<input type="hidden" name="isactive" value="1">
		<input type="hidden" name="autoid" value="<?php echo $info['autoid'];?>">


	</div>
</div>
<?php echo form_close();?>

