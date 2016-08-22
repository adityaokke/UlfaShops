
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
		  <div class="col-md-6">
		  	<h2>stok barang baru</h2>
		  	<table class='table table-bordered'>
		  		<thead>
		  			<tr>
		  				<th style='width:25%;'>nama</th>
		  				<th style='width:25%;'>kode barang</th>
		  				<th style='width:25%;'>stok</th>
		  				<th style='width:25%;'>tgl masuk</th>
		  			</tr>
		  		</thead>
		  		<tbody>
		  			<?php

		  					foreach ($data_gudang as $data) 
		  					{
		  			?>
		  						<tr>
								 <td><?php	echo	$data['Item']['nama'];	?></td>		
								 <td><?php	echo	$data['Gudangs']['kodebarang'];?></td>	
								 <td><?php	echo	$data['Gudangs']['quantity'];?></td>
								 <td><?php	echo	$data['Gudangs']['tanggal_masuk'];?></td>		
								 <td>
							 	<h5><?php echo $this->HTML->link('ubah',array('controller'=>'Gudangs','action'=>'ubah',$data['Gudangs']['id']));?></h5>
		  						<h5> <?php	echo $this->Form->postlink('Hapus',array('controller'=>'Gudangs','action'=>'hapus',$data['Gudangs']['id'],"delkat"),array('confirm'=>'Apakah anda akan menghapus kategori beserta sub kategori dan item di dalamnya ?'));?></h5>
		  					 	</td>			
								</tr>
		  			<?php 	
		  					}
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
		  <div class="col-md-4">
		  	
		  	
		  </div>
		</div>

	</div>
</div>