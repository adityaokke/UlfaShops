	<table >
		  		<thead>
		  			<tr>
		  				<th style='width:20%;'>nama Supplier</th>
		  				<th style='width:10%;'>Total</th>
		  				<th style='width:20%;'>Tanggal pembelian</th>
		  				<th style='width:20%;'>Tanggal tempo</th>
		  				<th style='width:10%;'>Keterangan</th>
		  				
		  			</tr>
		  		</thead>
		  		<tbody>
		  			<?php

		  					foreach ($list as $data) 
		  					{
		  			?>
		  						<tr>
								 <td><?php echo $data['Penyedia']['nama'];?></td>
								 <td><?php echo $data['Notabeli']['total_bayar'];?></td>
								 <td><?php echo $data['Notabeli']['tanggal'];?></td>
								 <td><?php echo $data['Notabeli']['tanggal_tempo'];?></td>
								 <td><?php echo $data['Notabeli']['keterangan'];?></td>
								 <td><?php
								 	echo $this->html->link('ubah',array('controller'=>'Gudangs','action'=>'ubah',$data['Notabeli']['id']));?> 
								 	<?php 
								 	echo '<br>'.$this->html->link('Lunaskan',array('controller'=>'Notabeli','action'=>'lunaskan',$data['Notabeli']['id']))."<br>";	
								 	echo $this->Form->postlink('Hapus',array('controller'=>'Gudangs','action'=>'hapus',$data['Notabeli']['id'],"delkat"),array('confirm'=>'Apakah anda akan menghapus kategori beserta sub kategori dan item di dalamnya ?'));
								 ?>
								
								</td>
								 		
								</tr>
		  			<?php 	
		  					}
		  			?>
				</tbody>


		  	</table>
		  	<div	class="paging">	
			<?php	
				 echo	$this->Paginator->prev('	<<	',	array('escape'	=>	false),	null,	array('escape'	=>	false,	'class'=>'prev	disabled'))	.	$this->Paginator->numbers(array('before'	=>	false,	'after'	=>	false,	'separator'	=>	false))	.	
				 	$this->Paginator->next('	>>	',	array('escape'	=>	false),	null,	array('escape'	=>	false,	'class'	=>	'next	disabled'))		
			?>	
			</div>