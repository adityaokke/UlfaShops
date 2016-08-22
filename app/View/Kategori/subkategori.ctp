<div class="row">
	<div class="col-md-12">
<table class='table table-bordered'>	
<thead>	
	 <tr>	
	 <th	style="width:	100px;">isi</th>	
	 <th	style="width:	100px;">Kategori</th>	
	<th	style="width:	200px;">Action</th>	
	 </tr>	
	 </thead>	
<tbody>	
<?php	
	
	foreach($list_sub	as	$data)	{?>	
	 <tr>
	 	
	 <td><?php echo
	 	$data['Kategori']['nama']; ?>

	 	 <td><?php	echo	$namaKategori; ?></td>	
	 	<td>
	 		<?php
	 	echo $this->html->link('ubah',array('controller'=>'Kategori','action'=>'ubah',$data['Kategori']['id']));

	 ?>
	 		<?php
	 	echo "---".$this->html->link('lihat item',array('controller'=>'Kategori','action'=>'subitem',$data['Kategori']['id'],$namaKategori));

	 ?><?php	echo"---". $this->Form->postlink('Hapus',array('controller'=>'Kategori','action'=>'hapus',$data['Kategori']['id'],"delsub"),array('confirm'=>'Item yang  termasuk kategori ini akan terhapus. Lanjutkan ?'));
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
</div>
</div>