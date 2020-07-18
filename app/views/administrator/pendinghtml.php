<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if( $this->session->flashdata('commonerrorrmsg') ) { ?>
	<?php echo $this->session->flashdata('commonerrorrmsg');?>
<?php } ?>
<div class="card height-auto">
	<div class="card-body">
		<div class="heading-layout1">
			<div class="item-title">
				<h3>Today's Goles's</h3>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table display data-table text-nowrap">
				<thead>
					<tr>
					<th>Sr.No</th>
					<th>Gole</th>


						<th>Note</th>
						<th>Status</th>

						<th>Settings</th>
					</tr>
				</thead>
				<tbody>
					<?php if( !empty($lists)):?>
						<?php $counter=1; foreach( $lists as $list ):?>
							

							<tr>
							<td><?php echo $counter;?></td>

								<td><?php echo $list->title;?></td>
								<td><?php echo $list->description ;?></td>
								<td>
								
								<?php if($list->isactive==1 || $list->isactive==0):?>
									<a href="<?php echo adminsbase_url("dashboard/changedate/$list->autoid"); ?>" onclick="return confirm('Are you sure  want to add')" ><button type="button" class="btn btn-success" title="Do You Want To Add This To Todays Gole">Pin To Today's Gole</button></a>
								<?php endif;?>&nbsp;
								</td>
								<td>

								<a href="<?php echo adminsbase_url("dashboard/deletegole/1/$list->autoid/"); ?>" onclick="return confirm('Are you sure  want to Delete')"><button type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button></a>&nbsp;
								<a href="<?php echo adminsbase_url("dashboard/addgole/$list->autoid"); ?>" ><button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button></a></td>
							</tr>
							<?php $counter+=1; endforeach; ?>
						<?php else :?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>