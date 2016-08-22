<table class='table table-bordered'>	
<thead>	
	 <tr>	
	 <th	style="width:	200px;">isi</th>	
	 <th	style="width:	300px;">Id</th>	
	 
	 </tr>	
	 </thead>	
<tbody>	
<?php	
	
	foreach($list	as	$data)	{?>	
	 <tr>
	 	
	 <td><?php echo $this->html->link(
	 	$data['Kategori']['nama'],
	 	array('controller'=>'Kategori',
	 		  'action'=>'detail',
	 		  $data['Kategori']['id'])) ?></td>

	 	 <td><?php	echo	$data['Kategori']['id'];	?></td>	
	 
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