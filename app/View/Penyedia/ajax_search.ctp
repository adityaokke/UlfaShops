<table class='table table-bordered'>	
			<thead>	
				 <tr>	
				 <th	style="width:	200px;">id</th>	
				 <th	style="width:	300px;">Isi</th>	
				 <th	style="width:	300px;">Alamat</th>	
				 <th	style="width:	300px;">No Telepon</th>	
				 </tr>	
				 </thead>	
			<tbody>	
			<?php	foreach($Penyedia	as	$data)	{?>	
				 <tr>
				 <td><?php	echo	$data['Penyedia']['id'];	?></td>	
				  <td><?php	echo	$data['Penyedia']['nama'];	?></td>		
				  <td><?php	echo	$data['Penyedia']['alamat'];	?></td>	
				  <td><?php	echo	$data['Penyedia']['telepon'];	?></td>
				 <td>
				  <?php
				 	echo $this->html->link('lihat nota pembelian',array('controller'=>'Notabeli','action'=>'searchpenyedia',$data['Penyedia']['id']));

				 ?>
				 </td>	
				 <td>
				 	<?php echo $this->HTML->link('ubah',array('controller'=>'Penyedia','action'=>'ubah',$data['Penyedia']['id']));
				 	?>
				 	<?php echo $this->Form->postLink('hapus',array('controller'=>'Penyedia','action'=>'hapus',$data['Penyedia']['id']),
				 		array('confirm'=>'Are you sure ?'));
				 		?>

				 </td>
				 </tr>	
			<?php		
			}		
			unset($Penyedia);	
			?>	
			</tbody>	
</table>