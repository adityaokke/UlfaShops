
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
			     <li><?php echo $this->Html->link( "Laporan stok bulanan",   array('controller' => 'Transbeli', 'action' => 'stokbulanan') ); ?></li>
			     <li><?php echo $this->Html->link( "Laporan total pembelian stok bulanan",   array('controller' => 'Transbeli', 'action' => 'stokbulanan') ); ?></li>
			     <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div> -->
			<?php echo $this->element('vertikalmenu'); ?>
		  </div>
		  <div class="col-md-10" style="float: left;">
		  	<?php
		  		echo $this->Form->create("Search",array("default"=>false, 'id'=>'SearchForm'));
				echo $this->Form->input('nama supplier',array('type'=>'text','div'=>false,'id'=>'keyword','placeholder'=>'masukan nama supplier'));
				echo $this->Form->submit('Search');
				echo $this->Form->end();	
		  	?>
			
			
			<script type="text/javascript">
		  	$(document).ready(function(){
		  	 	$(document).on('submit','#SearchForm',function(){
		  	 		
				 $.ajax({
				   type: "POST",
				   data:{keyword:$("#keyword").val()},
				   url: "<?php echo $this->base;?>/Notabeli/searchnota/",
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
		  				<th style='width:20%;'>nama Supplier</th>
		  				<th style='width:10%;'>Total</th>
		  				<th style='width:20%;'>Tanggal pembelian</th>
		  				<th style='width:20%;'>Tanggal tempo</th>
		  				<th style='width:10%;'>Keterangan</th>
		  				<th style='width:10%;'>Status</th>
		  				
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
								 <td><?php echo $data['Notabeli']['status'];?></td>
								 <td><?php
								 	echo $this->html->link('ubah',array('controller'=>'Gudangs','action'=>'ubah',$data['Notabeli']['id']));?> 
								 	<?php 
								 	echo $this->html->link('Lunaskan',array('controller'=>'Notabeli','action'=>'lunaskan',$data['Notabeli']['id']))."<br>";	
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
		  	</div>
		</div>

	</div>
</div>