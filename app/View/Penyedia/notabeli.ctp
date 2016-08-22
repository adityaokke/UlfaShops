<h2>Manajemen	Berita</h2>	
<table class='table table-bordered'>	
<thead>	
	 <tr>	
	 <th	style="width:	200px;">id</th>	
	 <th	style="width:	300px;">total</th>	
	 <th	style="width:	300px;">tangga</th>	
	 
	 </tr>	
	 </thead>	
<tbody>	

<?php	foreach($data_nota	as	$data)	{?>	
	 <tr>
	 <td><?php	echo	$data['NotaBuyers']['id'];	?></td>	
	  <td><?php	echo	$data['NotaBuyers']['total_bayar'];	?></td>		
	 <td><?php	echo	$data['NotaBuyers']['tanggal'];	?></td>	
	 
	 <td>
	  <?php
	 	echo $this->html->link('barang',array('controller'=>'Supplier','action'=>'notabeli',$data['NotaBuyers']['id']));

	 ?>
	 </td>	
	 <td>
	 	<?php echo $this->HTML->link('ubah',array('controller'=>'Supplier','action'=>'ubah',$data['NotaBuyers']['id']));
	 	?>
	 	<?php echo $this->Form->postLink('hapus',array('controller'=>'Supplier','action'=>'hapus',$data['NotaBuyers']['id']),
	 		array('confirm'=>'Are you sure ?'));
	 		?>

	 </td>
	 </tr>	
<?php		
}		
unset($Supplier);	
?>	
</tbody>	
</table>
<div>
	<button onclick="window.location.href='<?php echo Router::url(array('controller'=>'Supplier', 'action'=>'tambah'))?>'">Tambah data</button>
</div>
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