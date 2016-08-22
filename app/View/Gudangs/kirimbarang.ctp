<div class="row">
	<div class="col-md-2">
		<?php echo $this->element('vertikalmenu'); ?>
	</div>
	<div class="col-md-5">
		<div class="row">
			<div class="col-md-12"><h3>Kirim Barang</h3></div>
			<?php echo $this->Form->create('Daftarkirim', array('action'=>'add', 'enctype' => 'multipart/form-data','class'=>'daftarkirimform')); ?>
			<div class="col-md-12">
				<?php echo $this->Form->input('Toko.id', array(
															'label' => 'Toko Tujuan Pengiriman : ',
															'type' => 'select',
															'options' => $daftar_toko,
															'class'=>'input_select input-toko',
															'default'=>'Pilih Toko',
															'empty'=>'Pilih Toko',
															'value'=>'0'
														));
							?>
			</div>
			
			<div class="col-md-12 isi-daftar-barang">
				<table>
					<thead>
						<tr>
							<td>Menu</td>
							<td>Jumlah</td>
							<td>Kode Barang</td>
							<td>Nama Barang</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<?php echo $this->Form->input('Gudang.id', array('label' => '','class'=>'input-gudang_id','value'=>'','readonly'=>'readonly','type'=>'hidden')); ?>
							<td><?php echo $this->Form->input('Gudang.jumlah', array('label' => '','class'=>'input-jumlah','value'=>'','readonly'=>'')); ?></td>
							<td><?php echo $this->Form->input('Gudang.kodebarang', array('label' => '','class'=>'input-kodebarang','value'=>'','readonly'=>'readonly')); ?></td>
							<td><?php echo $this->Form->input('Gudang.nama', array('label' => '','class'=>'input-nama','value'=>'','readonly'=>'readonly')); ?></td>
						</tr>
						<tr><td></td><td></td><td><a class="tambah-item-kirim">Tambah</a></td><td><a class="kirim-item-kirim">Kirim</a></td></tr>
						<tr class="last-row-kirim">

						</tr>
					</tbody>
				</table>
				<?php 
$options = array(
    'label' => 'Simpan',
    'div' => array(
        'class' => 'submit me-hide-submit',
    )
);
echo $this->Form->end($options);

				 ?>	
			</div>				
		</div>
	</div>
	<div class="col-md-5">
		<div class="row">

			<div class="col-md-6"><?php echo $this->Form->input('search_kodebarang', array('label' => array('class' => 'sr-only','text' => 'Enter KeyWord'),'placeholder'=>'Kode Barang','class'=>'me-change search_kodebarang')); ?></div><div class="col-md-6"><?php echo $this->Form->input('search_nama', array('label' => array('class' => 'sr-only','text' => 'Enter KeyWord'),'placeholder'=>'Nama Barang','class'=>'me-change search_nama')); ?></div>
			<div class="col-md-12 ajax-view"></div>
			<div class="col-md-12">
				<p>
					<a class="prev" style="cursor:pointer;"> << prev </a>|		
					<a class="next" style="cursor:pointer;">next >></a>
				</p>

			</div>
		</div>
	</div>
</div> 