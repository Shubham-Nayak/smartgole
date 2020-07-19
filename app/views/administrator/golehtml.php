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
						<th>Expected Time</th>
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
								<td><?php echo $list->expexted_time ;?></td>
								<td>
								<?php if($list->isactive==2):?>
									<a href="#" ><button type="button" class="btn btn-warning" title="Gole Has Been Completed">Completed In <?php   echo round(abs(date(strtotime($list->start_time)) - date(strtotime($list->end_time))) / 60,2). " minute"; ?></button></a>
								<?php elseif($list->isactive==1 ):?>
									<a href="<?php echo base_url("dashboard/golestatus/0/$list->autoid/gole"); ?>" onclick="return confirm('Are you sure  want to start')" ><button type="button" class="btn btn-success">Start</button></a>
									<?php else:?>
							

									<a href="<?php echo base_url("dashboard/golestatus/1/$list->autoid/gole"); ?>" onclick="return confirm('Are you sure  want to stop')" ><button type="button" class="btn btn-danger">End</button></a>
								<?php endif;?>&nbsp;
								</td>
								<td>

								<a href="<?php echo base_url("dashboard/deletegole/1/$list->autoid/"); ?>" onclick="return confirm('Are you sure  want to Delete')"><button type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button></a>&nbsp;
								<a href="<?php echo base_url("dashboard/addgole/$list->autoid"); ?>" ><button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button></a></td>
							</tr>
							<?php $counter+=1; endforeach; ?>
						<?php else :?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>