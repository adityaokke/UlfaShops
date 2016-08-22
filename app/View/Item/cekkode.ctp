<table>	
<thead>	
	 <tr>	
	 <th	style="width:	200px;">nama	</th>	
	 <th	style="width:	300px;">kode barang</th>	
	 
	 </tr>	
	 </thead>	
<tbody>	
<?php	
	
	foreach($list	as	$data)	{?>	
	 <tr>
	 	
	 

	 	 <td><?php	echo	$data['Item']['nama'];	?></td>	
	 	 <td><?php	echo	$data['Item']['kodebarang'];	?></td>	
	 
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