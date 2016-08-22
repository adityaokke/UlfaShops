
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
			</div>
		  </div>
		  <div class="col-md-10">
		  	<?php
		  		$tahun = array();
		  		$bulan = array('1'=>'jan','2'=>'feb','3'=>'mar','4'=>'apr','5'=>'mei','6'=>'juni','7'=>'juli','8'=>'agst','9'=>'sept','10'=>'okt','11'=>'nov','12'=>'des');
		  		$x =0;
		  		for ($i=2011; $i < 2030; $i++) { 
		  			$tahun[$x] = $i;
		  			$x++;
		  		}
		  	?>
		  	<h4>Laporan bulanan untuk bulan : <?php echo $bulan[$bln]; ?> tahun : <?php echo $thn;?></h4>
		  </br>
		  	<div class='col-md-12 search-input'>
		  		<?php
		  		
		  		echo $this->Form->create('Post', array('url'=>array('controller' => 'Transbeli', 'action' => 'stokbulanan')));
				echo $this->Form->input('bulan',array('type'=>'select','options' => $bulan,'id'=>'bulan','class'=>'form-control'));
				echo $this->Form->input('tahun',array('type'=>'select','options' => $tahun,'id'=>'tahun','class'=>'form-control'));
				echo $this->Form->submit('Search');
				echo $this->Form->end();	

		  		?>
				<table class='table table-bordered'>	
				<thead>	
					 <tr>	
					 <th	style="width:	200px;">no</th>
					 
					 <th	style="width:	320px;">Kode barang</th>
					 <th	style="width:	200px;">Nama</th>	
					 <th	style="width:	200px;">Total Jumlah terbeli</th>
					 <th	style="width:	100px;">Total pembayaran</th>
					 	
					 
					 </tr>	
					 </thead>	
				<tbody>	
				<?php
					
					$sumquan=0;
					$sumtot=0;
					$i = 1;
					foreach($datas	as	$data)	{?>	
					 <tr>
					 
					<td><?php echo $i; $i++; ?></td>
					
					<td><?php echo $data['Gudangs']['kodebarang']; ?></td>
					<td><?php echo $data['Transbeli']['nama']; ?></td>
					<td><?php echo $data[0]['total_beli']; ?></td>
					<td><?php echo $data['Transbeli']['total']; ?></td>
					<?php
					$sumquan = $sumquan +$data[0]['total_beli'];
					$sumtot = $sumtot + $data['Transbeli']['total'];
					?>
					</tr>	
				<?php		
				}		
				unset($datas);	
				?>	
				</tbody>
				<tbody>
					<td></td>	
					<td></td>	
					<td></td>	
				<td>total :<?php  echo $sumquan;?></td>
				<td>total :<?php echo $sumtot;?></td>		
				</tbody>	
				</table>
				
				<script>
					

				</script>
		  		

		  	</div>
		  
		</div>

	</div>
</div>