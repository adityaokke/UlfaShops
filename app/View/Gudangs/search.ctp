<table class='table table-bordered'>	
<thead>	
	 <tr>	
	 	 <th	style="width:	300px;">Id</th>
	 <th	style="width:	300px;">Nama</th>
	 	<th	style="width:	300px;">satuan grosir</th>
	 	<th	style="width:	300px;">lebih 1 lusin</th>
	 	<th	style="width:	300px;">lebih 6 lusin</th>
	 	<th	style="width:	300px;">satuan eceran</th>
	 	<th	style="width:	300px;">lebih 3 pcs</th>
	 	<th	style="width:	300px;">lebih 1 lusin</th>
	 
	 </tr>	
	 </thead>	
<tbody>	
	
<?php	
		
	foreach($list	as	$data)	{?>	
	 <tr>
	<td><?php	echo	$data['Gudangs']['id'];?></td>
	 <td><?php echo $this->html->link(
	 	$data['Item']['nama'],
	 	array('controller'=>'Item',
	 		  'action'=>'detil',
	 		  $data['Item']['id'])) ;
	 		  ?>
		<td><?php	echo	$data['Gudangs']['satuan_grosir'];?></td>
		<td><?php	echo	$data['Gudangs']['lusin_grosir'];?></td>
		<td><?php	echo	$data['Gudangs']['lusin6_grosir'];?></td>
		<td><?php	echo	$data['Gudangs']['satuan_eceran'];?></td>
		<td><?php	echo	$data['Gudangs']['pcs3_eceran'];?></td>					
	 	 <td><?php	echo	$data['Gudangs']['lusin1_eceran'];	?></td>	
	 <td>
					<?php
					echo $this->HTML->link('ubah',array('controller'=>'Gudangs','action'=>'ubah',$data['Gudangs']['id']));
					
					?>
					<?php
					echo $this->Form->postlink('hapus',array('controller'=>'Item','action'=>'hapus',$data['Item']['id']),array('confirm'=>'anda yakin ingin menghapus'));
					?>
				</td>
	 </tr>	
<?php		
}		
unset($datas);	
?>	
</tbody>	
</table>
<div	class="paging">	
<?php	
	 echo	$this->Paginator->prev('	<<	',	array('escape'	=>	false),	
																	 null,	array('escape'	=>	false,	'class'=>'prev	disabled'))	.	
	 					$this->Paginator->numbers(array('before'	=>	false,	
																	 'after'	=>	false,	'separator'	=>	false))	.	
	 					$this->Paginator->next('	>>	',	array('escape'	=>	false),	
																	 null,	array('escape'	=>	false,	'class'	=>	'next	disabled'))		
?>	
</div>