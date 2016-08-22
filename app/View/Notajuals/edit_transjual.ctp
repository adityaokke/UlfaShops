<?php  $this->Html->addCrumb('Toko', array('controller' => 'Tokos', 'action' => 'index')); ?>

<?php  $this->Html->addCrumb('Daftar Transaksi Jual','/notajuals'); ?>

<?php  $this->Html->addCrumb('Detil Transaksi Jual','/notajuals/detil/'.$this->request->data['Notajual']['id']); ?>

<?php  $this->Html->addCrumb('Edit Transaksi Jual','#'); ?>

<div class="row">

	<div class="col-md-6">

		<h2>Edit Trans Jual</h2>

		<!-- <p>

		<?php

		echo $this->Html->link('Kembali', array('action'=>'index'));

		?>

		</p> -->

		<p>

			<a class="lihat-daftar-item" style="cursor:pointer;">Lihat Daftar Item</a>

		</p>


		<?php


		echo $this->Form->create('Notajual', array('action'=>'edit_transjual', 'enctype' => 'multipart/form-data'));



		echo $this->Form->input('Transjual.id', array('type' => 'hidden'));
		echo $this->Form->input('Transjual.notajual_id', array('type' => 'hidden'));

		echo $this->Form->input('Transjual.itemtokoidasli', array('type' => 'hidden','class'=>'input-tambah-itemidasli','readonly'=>'readonly','value'=>$this->request->data['Itemtoko']['id']));	

		echo $this->Form->input('Transjual.itemtoko_id', array('type' => 'hidden','class'=>'input-tambah-item_id','readonly'=>'readonly','value'=>$this->request->data['Itemtoko']['id']));

		echo $this->Form->input('Item.kodebarang', array('label' => 'Kode Barang : ','class'=>'input-tambah-kodebarang','readonly'=>'readonly'));

		echo $this->Form->input('Item.nama', array('label' => 'Nama Barang : ','class'=>'input-tambah-nama','readonly'=>'readonly'));		
		
		echo $this->Form->input('Transjual.jumlah_unit', array('label' => 'Jumlah Unit : ','class'=>'input-edit-jumlah'));

		echo $this->Form->input('Transjual.unit', array(

													'label' => 'Unit : ',

													'type' => 'select',

													'options' => $this->request->data['jenis_unit'],

													'class'=>'input-edit-unit',

													'default'=>'1',

													'value'=>$this->request->data['Transjual']['unit']

												));
		echo $this->Form->input('Transjual.quantity', array('label' => 'Isi : ','class'=>'input-edit-isi'));
		
		echo $this->Form->input('Transjual.harga', array('type'=>'hidden','label' => 'Harga : ','readonly'=>'readonly','class'=>'input-edit-harga-barang'));

		echo $this->Form->input('Transjual.untung', array('type'=>'hidden','label' => 'Untung : ','readonly'=>'readonly','class'=>'input-edit-untung-barang'));

		echo $this->Form->input('Transjual.total_harga_jual', array('label' => 'Total Harga Jual : ','readonly'=>'readonly','class'=>'input-edit-hargatotal'));

		echo $this->Form->input('Transjual.keuntungan', array('label' => 'Keuntungan : ','readonly'=>'readonly','class'=>'input-edit-keuntungan'));

							

		echo $this->Form->end('Simpan');

		?>

	</div>
	<div class="col-md-6">
		<button class="reset btn">Reset</button>
	</div>
	<div class="col-md-3"><?php echo $this->Form->input('search_kodebarang', array('label' => array('class' => 'sr-only','text' => 'Enter KeyWord'),'placeholder'=>'Kode Barang','class'=>'me-change search_kodebarang')); ?></div><div class="col-md-3"><?php echo $this->Form->input('search_nama', array('label' => array('class' => 'sr-only','text' => 'Enter KeyWord'),'placeholder'=>'Nama Barang','class'=>'me-change search_nama')); ?></div>

	<div class="col-md-6 ajax-view"></div>

	<div class="col-md-6">

		<p>

			<a class="prev" style="cursor:pointer;"> << prev</a>			

			<a class="next" style="cursor:pointer;">next>></a>

		</p>



	</div>

</div>