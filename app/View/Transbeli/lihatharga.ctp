
<div class="row">
	<div class="col-md-14">
		<div class="row">
			
		  <div class="col-md-2">
		  	<div class="btn-group-vertical" role="group" aria-label="...">
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
			      <li><?php echo $this->Html->link( "lihat harga beli barang",   array('controller' => 'Gudangs', 'action' => 'lihatharga') ); ?></li>
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
			</div>
		  </div>
		  <div class="col-md-6">
		  	<h3>pencarian harga barang</h3>
		  	<button class='btn btn-primary' id='search'>search - kodebarang</button>
		  </br>
		  	<div class='col-md-12 search-input'>

		  		<?php
		  			 echo $this->Form->create("Search",array('default'=>false, 'id'=>'SearchForm'));
					 echo $this->Form->input('kode barang',array('type'=>'text','div'=>false,'id'=>'keyword','placeholder'=>'masukan kode barang','class'=>'searchgudang form-control'));
					 echo $this->Form->submit('Search');
					 echo $this->Form->end();	

		  		?>
		  		
				
		  	</div>
		  	
		  	<script type="text/javascript">
		  	 $(document).ready(function(){
		  	 	$(document).on('submit','#SearchForm',function(){
		  	 		
				 $.ajax({
				   type: "POST",
				   data:{keyword:$("#keyword").val()},
				   url: "<?php echo $this->base;?>/Transbeli/ajax_harga_beli/",
				   success:function(data) {
				   
				         $("#result").html(data);
				      }
				   });        
				 	      
				}); 
				$(".search-input").hide();
		  		$("#search").click(function(event) {
		  			$(".search-input").slideToggle();
		  			$(".add-menu").slideUp();
		  			
		  		});
		  		
		  		
			 });
		  	</script>
		  	<div id="result"></div>
		  </div>
		  <div class="col-md-4">
		  	
		  </div>
		</div>

	</div>
</div>