<?php  $this->Html->addCrumb('Toko', array('controller' => 'Tokos', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Daftar Item Toko','/itemtokorusaks'); ?>
<?php  $this->Html->addCrumb('Edit Item Toko','#'); ?>
<div class="row">
	<div class="col-md-6">
		<?php 
		//echo $this->Html->link('Kembali', array('action'=>'index')); ?>
		<h2>Edit Item Toko</h2>
		<p>
			<a class="lihat-daftar-item" style="cursor:pointer;">Lihat Daftar Item</a>
		</p>

		<?php
		//debug($this->request->data);
		echo $this->Form->create('Itemtokorusak', array('action'=>'edit', 'enctype' => 'multipart/form-data','class'=>'form-inline'));

		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('itemtoko_id', array('type' => 'hidden','class'=>'input-tambah-itemtoko_id','readonly'=>'readonly'));
		echo $this->Form->input('Item.kodebarang', array('label' => 'Kode Barang : ','class'=>'input-tambah-kodebarang','readonly'=>'readonly'));
		echo $this->Form->input('Item.nama', array('label' => 'Nama Barang : ','class'=>'input-tambah-nama','readonly'=>'readonly'));
		echo $this->Form->input('jumlah', array('label' => 'Jumlah (dalam satuan item) : '));

		echo $this->Form->end('Simpan');
		?>

	</div>
	<!-- <div class="col-md-3"><?php //echo $this->Form->input('search_kodebarang', array('label' => array('class' => 'sr-only','text' => 'Enter KeyWord'),'placeholder'=>'Kode Barang','class'=>'me-change search_kodebarang')); ?></div><div class="col-md-3"><?php //echo $this->Form->input('search_nama', array('label' => array('class' => 'sr-only','text' => 'Enter KeyWord'),'placeholder'=>'Nama Barang','class'=>'me-change search_nama')); ?></div>
	<div class="col-md-6 ajax-view"></div>
	<div class="col-md-6">
		<p>
			<a class="prev" style="cursor:pointer;"> << prev</a>			
			<a class="next" style="cursor:pointer;">next>></a>
		</p>

	</div> -->

</div>