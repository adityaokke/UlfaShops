<div class="btn-group-vertical" role="group" aria-label="...">
			 <?php echo $this->Form->Button('lihat laporan stok', array('onclick' => "location.href='Gudangs/lihatsemua'",'type'=>'button','class'=>'btn btn-default'));?>
			  <?php //echo $this->Form->Button('lihat laporan stok', array('onclick' => "location.href='Gudangs/lihatsemua'",'type'=>'button','class'=>'btn btn-default'));?>
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
			    </ul>
			  </div>


			  <div class="btn-group" role="group">
			    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			      Kirim barang
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			      <li><?php echo $this->Html->link( "kirim barang",   array('controller' => 'Gudangs', 'action' => 'kirimbarang') ); ?></li>
			      <li><?php echo $this->Html->link( "lihat daftar pengiriman barang",   array('controller' => 'daftarkirims', 'action' => 'index') ); ?></li>
			    </ul>
			  </div>
			</div>