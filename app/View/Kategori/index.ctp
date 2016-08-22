
<div class="row">
	<div class="col-md-12">
		<?php  $this->Html->addCrumb('Kategori', array('controller' => 'Kategori', 'action' => 'index')); ?>
		<h2>Manajemen	Kategori</h2>	
		<?php 
			 echo	$this->Form->create('keyword',array('url'=>'/Kategori/search','type'=>'get','class'=>'form-group'));	
			 echo	$this->Form->input('key',array('id'=>'postcontent','label'	=>	'Masukan kategori/subkategori','class'=>'form-control'));
			 echo     $this->Form->end(array('label'=>'cari'));
		?>
		<button class='btn btn-primary' id='tambah' onclick="window.location.href='<?php echo Router::url(array('controller'=>'Kategori', 'action'=>'tambah'))?>'">Tambah Kategori</button><br><br><br>
		<table class='table table-bordered'>	
		<thead>	
			 <tr>	
			 <th	style="width:	200px;">isi</th>	
			 <th	style="width:	200px;">Jumlah</th>
			 <th	style="width:	400px;">Action </th>	
			 
			 </tr>	
			 </thead>	
		<tbody>	
		<?php	foreach($datas	as	$data)	{?>	
			 <tr>
			 <td><?php echo $data['Kategori']['nama']; ?></td>	
			 <td><?php echo $data['Kategori']['nama']; ?></td>
			 <td><?php
			 	echo $this->html->link('ubah',array('controller'=>'Kategori','action'=>'ubah',$data['Kategori']['id']));

			 ?> <?php	echo"---". $this->Form->postlink('Hapus',array('controller'=>'Kategori','action'=>'hapus',$data['Kategori']['id'],"delkat"),array('confirm'=>'Apakah anda akan menghapus kategori beserta sub kategori dan item di dalamnya ?'));
			 ?>
			 <?php
			 	echo "---".$this->html->link('lihat sub',array('controller'=>'Kategori','action'=>'subkategori',$data['Kategori']['id']));

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
