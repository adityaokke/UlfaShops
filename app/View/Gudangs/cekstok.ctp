<?php echo $this->Html->script('jquery'); ?>
<?php echo $this->Html->script('bootstrap.min.js'); ?>
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
		  	<!-- <button id='add'>update informasi</button>
		  	<div class='col-md-12 add-menu'>
		  		<?php
		  			 echo	$this->Form->create('Post',array('url'=>'/Gudangs/update'));	
		  						 /*echo	$this->Form->input('Gudangs.item_id',array('id'=>'posttitle','label'=>'Judul:'));	*/
		  						 echo   $this->Form->input('kodebarang',array('id'=>'postcontent','label'=>'kodebarang'));
		  						 echo   $this->Form->input('Gudangs.quantity',array('id'=>'postcontent','label'=>'jumlah barang'));
		  						 echo	$this->Form->input('Gudangs.satuan_grosir',array('id'=>'postcontent','label'=>'satuan grosir'));
		  						 echo	$this->Form->input('Gudangs.lusin_grosir',array('id'=>'postcontent','label'=>'lusin grosir'));
		  						 echo	$this->Form->input('Gudangs.lusin6_grosir',array('id'=>'postcontent','label'=>'lebih dari 6 lusin grosir'));
		  						 echo	$this->Form->input('Gudangs.satuan_eceran',array('id'=>'postcontent','label'=>'satuan eceran'));
		  						 echo	$this->Form->input('Gudangs.pcs3_eceran',array('id'=>'postcontent','label'=>'lebih dari 3 pcs eceran'));
		  						 echo	$this->Form->input('Gudangs.lusin1_eceran',array('id'=>'postcontent','label'=>'lebih dari 1 lusin eceran'));
		  						 echo	$this->Form->input('Gudangs.tanggal_masuk',array('id'=>'postcontent','label'=>'','value'=>date('Y-m-d H:i:s')));
		  						 echo $this->Form->end(array('label'=>'Submit	Item'));	
		  		?>
		  	
		  	</div> -->

		  	<button id='search'>search - kodebarang</button>
		  </br>
		  	<div class='col-md-12 search-input'>
		  		<?php
		  			 echo $this->Form->create("Search",array("default"=>false, "id"=>"SearchForm"));
					 echo $this->Form->input('kode barang',array('type'=>'text','div'=>false,'id'=>'keyword'));
					 echo $this->Form->submit('Search');
					 echo $this->Form->end();	

		  		?>
		  		
				
		  	</div>
		  	<div id="result"></div>
		  	<script type="text/javascript">
		  	 $(document).ready(function(){
		  	 	$(document).on('submit','#SearchForm',function(){

				 $.ajax({
				   type: "POST",
				   data:{keyword:$("#keyword").text(),kode:'kb'},
				   url: "<?php echo $this->base;?>/Gudangs/ajax_search/",
				   success:function(data) {
				   
				         $("#result").html(data);
				      }
				   });        
				 	      
				}); 
				
			 	/*$(".add-menu").hide();
		  		$("#add").click(function(event) {
		  			$(".add-menu").slideToggle();
		  			$(".search-input").slideUp();
		  			$(".search-input2").slideUp();
		  		});*/
		  		$(".search-input").hide();
		  		$("#search").click(function(event) {
		  			$(".search-input").slideToggle();
		  			$(".add-menu").slideUp();
		  			$(".search-input2").slideUp();
		  		});
		  		
		  		
			 });
		  	</script>
		  </div>
		  <div class="col-md-4">
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
								</tr>
		  			<?php 	
		  					}
		  			?>
				</tbody>
				

		  	</table>
		  	
		  </div>
		</div>

	</div>
</div>