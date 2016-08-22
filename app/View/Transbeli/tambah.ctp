<?php

	if($status==0)
	{
?>
<table>
			<thead>
				<tr>
					<th >NO</th>		
					<th >NAMA</th>
					
					<th >jumlah</th>
					<th >Harga beli</th>
					<th >Total</th>
					<th >Action</th>
					
					
					
			
				</tr>		
			</thead>
			<tbody>
				<?php 
				
				foreach($data_beli as $Item)
				{?>
					<tr >
						<td><?php echo $Item['Transbeli']['id'];?></td>
						<td><?php echo $Item['Gudangs']['kodebarang'];?></td>
						<td><?php echo $Item['Transbeli']['quantity'];?></td>
						<td><?php echo $Item['Transbeli']['harga'];?></td>
						<td><?php echo $Item['Transbeli']['total'];?></td>
						<td>
							<?php
							echo $this->HTML->link('ubah',array('controller'=>'Item','action'=>'ubah'));
							
							?>
							<?php
							echo $this->Form->postlink('hapus',array('controller'=>'Item','action'=>'hapus'),array('confirm'=>'anda yakin ingin menghapus'));
							?>
						</td>
					</tr>
				<?php
				}
				unset($Item)
				?>

			</tbody>
			</table>
<?php
	}
	else
	{
		debug('data tidak ditemukan tekan f5 atau refresh halaman');
		
	}
?>
