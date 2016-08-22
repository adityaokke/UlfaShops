<?php  $this->Html->addCrumb('Toko', array('controller' => 'Tokos', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Daftar Jenis Unit','/units'); ?>
<?php  $this->Html->addCrumb('Tambah Jenis Unit','#'); ?>
<div class="row">
	<div class="col-md-12">
		<h2>Tambah Jenis Unit</h2>
		<p>
		<?php
		//echo $this->Html->link('Kembali', array('action'=>'index'));
		?>
		</p>
		<?php
		echo $this->Form->create('Unit', array('action'=>'add', 'enctype' => 'multipart/form-data'));

		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('nama', array('label' => 'Nama : '));
		echo $this->Form->input('isi_unit', array('label' => 'Isi : '));
							
		echo $this->Form->end('Simpan');
		?>

	</div>
</div>