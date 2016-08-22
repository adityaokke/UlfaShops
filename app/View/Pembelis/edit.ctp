<?php  $this->Html->addCrumb('Toko', array('controller' => 'Tokos', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Pembeli','/Pembelis'); ?>
<?php  $this->Html->addCrumb('Edit Pembeli','#'); ?>
<div class="row">
	<div class="col-md-12">
		<h2>Edit Pembeli</h2>
		<!-- <p>
		<?php
		echo $this->Html->link('Kembali', array('action'=>'index'));
		?>
		</p> -->
		<?php
		echo $this->Form->create('Pembeli', array('action'=>'edit', 'enctype' => 'multipart/form-data'));

		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('nama', array('label' => 'Nama Pembeli : '));
		echo $this->Form->input('alamat', array('label' => 'Alamat : '));
		echo $this->Form->input('kontak', array('label' => 'Kontak : '));
							
		echo $this->Form->end('Simpan');
		?>
	</div>
</div>