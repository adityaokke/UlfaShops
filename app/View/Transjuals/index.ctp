<div class="row">

	<div class="col-md-12">	



		<header>

			<h3>Nota Jual</h3>

		</header>

	</div>

	<?php if ($this->params['pass']) { ?>

	<div style="display:none;" class="url"><?php echo $this->params['pass'][0]."/".$this->params['pass'][1]."/".$this->params['pass'][2]; ?></div>

	<?php } ?>

	<div class="col-md-3 pull-right"><?php echo $this->Form->input('pembeli', array(

										'label' => array(

									        'class' => 'sr-only',

									        'text' => 'Pembeli'

									    ),

										'placeholder'=>'Pembeli',

										'class'=>'pembeli-dummy'



										)); ?></div>

	<div class="modal fade" id="myModal">

	  <div class="modal-dialog">

	    <div class="modal-content">

	      <div class="modal-header">

	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

	        <h4 class="modal-title">Pembayaran</h4>

	      </div>

	      <div class="modal-body">



	        <p style="font-size:36pt;">Total : <span class="show_total" >0</span>,00</p>

	      	<div class="row">

	      		<div class="col-md-4"><span style="font-size:26pt;">Potongan : </span></div>

	      		<div class="col-md-6">

					<?php echo $this->Form->input('potongharga', array('label' => '','class'=>'potong-dummy-harga formatAngka','value'=>0,'style'=>'height: 50pt;font-size: 26pt;')); ?>					

	      		</div>

	      		<div class="col-md-2"><span style="font-size:26pt;">,00</span></div>

	      	</div>

	      	<div class="row">

	      		<div class="col-md-4"><span style="font-size:36pt;">Bayar : </span></div>

	      		<div class="col-md-6">

					<?php echo $this->Form->input('bayarharga', array('label' => '','class'=>'bayar-dummy-harga formatAngka','style'=>'height: 50pt;font-size: 36pt;')); ?>

					

	      		</div>

	      		<div class="col-md-2"><span style="font-size:36pt;">,00</span></div>

	      	</div>

	      	

	      	<hr style="border: 3px solid;">

	        <p style="font-size:36pt;">Kembali : <span class="show_kembali" >0</span>,00</p>

	        <p class="hutang" style="font-size:36pt;">Hutang : <span class="show_hutang" >0</span>,00</p>



	      	<div class="row hutang">

	      		<div class="col-md-3"><p>Jatuh Tempo : </p></div>

	      		<div class="col-md-9">

					<?php echo $this->Form->input('jatuhtempodummy', array('label' => '','type'=>'date','dateFormat' => 'DMY','class'=>'jatuh_tempo-dummy-harga')); ?>

					

	      		</div>

	      		



	        

	      	</div>



	        

	      </div>

	      <div class="modal-footer">

	        <button type="button" class="btn btn-default no_form" data-dismiss="modal">Close</button>

	        <button type="button" class="btn btn-primary ok_form">Ok</button>

	      </div>

	    </div><!-- /.modal-content -->

	  </div><!-- /.modal-dialog -->

	</div><!-- /.modal -->



	<div class="col-md-12 tabel-nota-jual">

		<form action="<?php echo $this->Html->url(array('controller'=>'transjuals','action'=>'addAll')) ?>" enctype="multipart/form-data" id="TransjualAddForm" method="post" accept-charset="utf-8">

			<div style="display:none;"><input type="hidden" name="_method" value="POST"></div>

		<?php echo $this->Form->input('tanggal', array('label' => '','type'=>'date','dateFormat' => 'DMY','class'=>'input-tanggal-barang')); ?>


		<table>

			<thead>

				<tr>

					<td></td>

					<td>Kode</td>

					<td>Nama</td>

					<td>isi</td>

					<td>Jumlah</td>

					<td>Unit</td>

					<td>Harga</td>

					<td>Total</td>					

				</tr>

			</thead>

			<tbody>

				<tr class="input-row-nota-jual">

					<td></td>									

					<td><?php echo $this->Form->input('kodebarang', array('label' => '','class'=>'input-kode-barang biginput','id'=>"autocomplete")); ?></td>	

					<td><?php echo $this->Form->input('nama', array('label' => '','class'=>'input-nama-barang ','disabled'=>'disabled')); ?></td>	

					<td><?php echo $this->Form->input('isi', array('label' => '','class'=>'input-isi-barang formatAngka','disabled'=>'disabled')); ?></td>	

					<td><?php echo $this->Form->input('jumlah', array('type'=>'text','label' => '','class'=>'input-jumlah-barang')); ?></td>

					<td><?php echo $this->Form->input('unit', array(

													'label' => '',

													'type' => 'select',

													'options' => $jenis_unit,

													'class'=>'input-unit-barang',

													'default'=>'1'

												));

					?></td>

					<!-- <td><?php //echo $this->Form->input('unit',array('label'=>'','class'=>'input-unit-barang','options'=>array("satuan","pack-3","stgh-lusin","lusin","grosir"))); ?></td> -->

					<td><?php echo $this->Form->input('harga', array('label' => '','class'=>'input-harga-barang formatAngka')); ?></td>			

					<td><?php echo $this->Form->input('total', array('label' => '','class'=>'input-total-barang formatAngka','disabled'=>'disabled')); ?></td>

					<?php echo $this->Form->input('untung', array('type'=>'hidden','label' => '','class'=>'input-untung-barang','disabled'=>'disabled')); ?>	
					<?php echo $this->Form->input('keuntungan', array('type'=>'hidden','label' => '','class'=>'input-untung-total-barang','disabled'=>'disabled')); ?>	



				</tr>

				<tr class="last-row-nota-jual">

					<td>

						<!-- <a href="#" class="tambah-nota-jual">Tambah</a> -->

					</td>					

					<td><!-- <a href="#" class="bayar-nota-jual">Bayar</a> --></td>

					<td></td>

					<td></td>

					<td></td>

					<td></td>

					<td></td>

				</tr>				

			</tbody>

			

		</table>

			

	</div>

	<div class="col-md-12 pull-left">

		<div class="row">			

			<div class="col-md-6 view-total-harga-transaksi"></div>

			<div class="col-md-6 view-total-semua-harga-transaksi"></div>

		</div>

	</div>

	<?php echo $this->Form->input('pembeli', array('label' => '','type'=>'hidden','class'=>'pembeli')); ?>

	<!-- <div class="col-md-1">Total</div> -->

	<div class="col-md-2 proses-transaksi" >

		<?php echo $this->Form->input('totalharga', array('type'=>'hidden','label' => '','class'=>'total-harga formatAngka','readonly'=>'readonly')); ?>

	</div>



	<!-- <div class="col-md-1">Bayar</div> -->

	<div class="col-md-2 proses-transaksi" >

		<?php //echo $this->Form->input('bayarharga', array('type'=>'hidden','label' => '','class'=>'bayar-harga formatAngka')); ?>

	</div>

	<div class="col-md-3"><hr></div>

	<!-- <div class="col-md-1">Kembali</div> -->

	

	<div class="col-md-2 proses-transaksi" >

		<?php echo $this->Form->input('potongharga', array('type'=>'hidden','label' => '','class'=>'potong-harga formatAngka','readonly'=>'readonly')); ?>

	</div>

	<!-- <div class="col-md-1">Hutang</div> -->

	<div class="col-md-2 proses-transaksi" >

		<?php echo $this->Form->input('hutangharga', array('type'=>'hidden','label' => '','class'=>'hutang-harga formatAngka','readonly'=>'readonly')); ?>

	</div>	

		<?php echo $this->Form->input('untungharga', array('type'=>'hidden','label' => '','class'=>'untung-harga','readonly'=>'readonly','type'=>'hidden')); ?>

	<!-- <a href="#" class="cetak-nota-jual">Cetak</a> -->

	<?php echo $this->Form->input('bayarharga', array('type'=>'hidden','label' => '','class'=>'bayar-harga','style'=>'height: 50pt;font-size: 36pt;')); ?>

	<?php echo $this->Form->input('kembaliharga', array('type'=>'hidden','label' => '','class'=>'kembali-harga','style'=>'height: 50pt;font-size: 36pt;')); ?>

	<br>

		<div class="col-md-6 col-md-offset-6 jatuh-tempo" >

			

	</div>

	<div class="col-md-12">

		<div class="me-hidden"><?php echo $this->Form->input('jatuhtempo', array('label' => '','type'=>'date','class'=>'jatuh_tempo-harga')); ?></div>

		

		<h3>Keterangan</h3>

		<?php echo $this->Form->input('keterangan', array('type'=>'text','label' => '','class'=>'keterangan')); ?>

	</div>

	<div class="submit"><input type="submit" value="Simpan"></div>			

			</form>			
<?php echo $this->Form->input('unitdumb', array(
													'label' => '',
													'type' => 'select',
													'options' => $jenis_unit,
													'class'=>'input_select me-disabled',
													'style'=>'display: none;'
												));
					?>
</div>