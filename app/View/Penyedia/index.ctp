
<div class="row">
	<div class="col-md-14">
		<div class="row">
		 <div class="col-md-2">
		  	<!-- <div class="btn-group-vertical" role="group" aria-label="...">
			 <?php echo $this->Form->Button('lihat laporan stok', array('onclick' => "location.href='Gudangs/lihatsemua'",'type'=>'button','class'=>'btn btn-default'));?>
			  <?php echo $this->Form->Button('lihat laporan stok', array('onclick' => "location.href='Gudangs/lihatsemua'",'type'=>'button','class'=>'btn btn-default'));?>
			  <div class="btn-group" role="group">
			    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			      Pembelian
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			      <li><?php echo $this->Html->link( "Lihat hutang gudang",   array('controller' => 'Notabeli', 'action' => 'showhutang')); ?></li>
			      <li><?php echo $this->Html->link( "Lihat informasi Supplier",   array('controller' => 'Penyedia', 'action' => 'index')); ?></li>
			      <li><?php echo $this->Html->link( "Sistem Pembelian",   array('controller' => 'Notabeli', 'action' => 'index') ); ?></li>
			      <li><?php echo $this->Html->link( "Tambah informasi Supplier",   array('controller' => 'Penyedia', 'action' => 'tambah') ); ?></li>
			    </ul>
			  </div>
			  
			  <div class="btn-group" role="group">
			    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			      Stok Gudang
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			      <li><?php echo $this->Html->link( "lihat stok barang terbaru",   array('controller' => 'Gudangs', 'action' => 'terbaru') ); ?></li>
			      <li><?php echo $this->Html->link( "lihat semua stok barang",   array('controller' => 'Gudangs', 'action' => 'lihatsemua') ); ?></li>
			      <li><?php echo $this->Html->link( "lihat barang tanpa harga",   array('controller' => 'Gudangs', 'action' => 'tanpaharga') ); ?></li>
			      <li><?php echo $this->Html->link( "tambah barang di gudang",   array('controller' => 'Gudangs', 'action' => 'update') ); ?></li>
			    </ul>
			  </div>

			  <div class="btn-group" role="group">
			    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			      laporan gudang
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			     <li><?php echo $this->Html->link( "Laporan update stok",   array('controller' => 'Laporanbarangs', 'action' => 'lihat') ); ?></li>
			     <li><?php echo $this->Html->link( "Laporan total pembelian stok bulanan",   array('controller' => 'Transbeli', 'action' => 'stokbulanan') ); ?></li>
			     <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div> -->
			<?php echo $this->element('vertikalmenu'); ?>
		  </div>
		  <div class="col-md-10" style="float: left;">
		  	
		  	<h5>Pencarian</h5>
		  		<?php echo $this->Form->create('BoostCake', array(
					'inputDefaults' => array(
						'div' => 'form-group',
						'label'=>false,
						'wrapInput' => false,
						'class' => 'form-control'
					),
					'class' => 'well form-inline','id'=>'SearchForm','default'=>false
				)); ?>
		  		<?php
		  			 
					 echo $this->Form->input('nama supplier',array('type'=>'text','id'=>'keyword','placeholder' => 'nama supplier'));
					 echo $this->Form->input('alamat supplier', array('type'=>'text','id'=>'alamat','placeholder' => 'alamat supplier'));
			         echo $this->Form->input('nomer telepon', array('type'=>'text','id'=>'notelp','placeholder' => 'no telp'));
					 echo $this->Form->submit('Search');
					 echo $this->Form->end();	

		  		?>
			
			
			<script type="text/javascript">
		  	$(document).ready(function(){
		  	 	$(document).on('submit','#SearchForm',function(){

				 $.ajax({
				   type: "POST",
				   data:{keyword:$("#keyword").val(),alamat:$('#alamat').val(),notelp:$('#notelp').val()},
				   url: "<?php echo $this->base;?>/Penyedia/ajax_search/",
				   success:function(data) {
				   		$("#result").html(data);
				      }
				   });        
				 	      
				});

				
			});
		  	</script>
		  	<div id='result'>
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
			<?php	
			
			foreach($Penyedia	as	$data)	{?>	
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
			<div>
				<button onclick="window.location.href='<?php echo Router::url(array('controller'=>'Penyedia', 'action'=>'tambah'))?>'">Tambah data</button>
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
		  	</div>
		  </div>
		  
		</div>

	</div>
</div>