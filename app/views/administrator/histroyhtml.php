<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if( $this->session->flashdata('commonerrorrmsg') ) { ?>
	<?php echo $this->session->flashdata('commonerrorrmsg');?>
<?php } ?>
<div class="card">
	<div class="card-body">
		<div class="heading-layout1">
			<div class="item-title">
				<h3>Goles's</h3>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table display data-table text-nowrap">
				<thead>
					<tr>
					<th>Sr.No</th>
					<th>Gole</th>


						<th>Note</th>
						<th>Date</th>

						<th>Taking Time</th>

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
								<td><?php echo date('d-m-Y',strtotime($list->created_on)) ;?></td>

								<td>
								<?php if($list->isactive==2):?>
									<a href="#" ><button type="button" class="btn btn-warning" title="Gole Has Been Completed">Completed In <?php   echo round(abs(date(strtotime($list->start_time)) - date(strtotime($list->end_time))) / 60,2). " minute";?></button></a>
								<?php endif;?>&nbsp;
								</td>
								<td>

								<a href="<?php echo adminsbase_url("dashboard/deletegole/1/$list->autoid/"); ?>" onclick="return confirm('Are you sure  want to Delete')"><button type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button></a>&nbsp;
							</tr>
							<?php $counter+=1; endforeach; ?>
						<?php else :?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div></div>