<?php  $this->Html->addCrumb('Toko', array('controller' => 'Tokos', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Daftar Transaksi Jual','/notajuals'); ?>
<?php  $this->Html->addCrumb('Edit Transaksi Jual','#'); ?>
<div class="row">
	<div class="col-md-12">
		<h2>Edit Nota Jual</h2>
		<!-- <p>
		<?php
		echo $this->Html->link('Kembali', array('action'=>'index'));
		?>
		</p> -->
		<?php

		echo $this->Form->create('Notajual', array('action'=>'edit', 'enctype' => 'multipart/form-data'));

		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('tanggal', array('label' => 'Tanggal : ','disabled'=>'','class'=>''));
		echo $this->Form->input('pembeli', array('label' => 'Nama Pembeli : ','disabled'=>'disabled'));
		echo $this->Form->input('harga_total', array('label' => 'Total Harga : ','disabled'=>'disabled'));
		echo $this->Form->input('potong', array('label' => 'Potongan : ','disabled'=>'disabled'));
		echo $this->Form->input('status', array('label' => 'Status : ','disabled'=>'disabled'));
		echo $this->Form->input('keuntungan_total', array('label' => 'Total Keuntungan : ','disabled'=>'disabled'));
		echo $this->Form->input('hutang', array('label' => 'Hutang : '));
		echo $this->Form->input('jatuh_tempo', array('label' => 'Jatuh Tempo : '));
		echo $this->Form->input('User.username', array('label' => 'Nama Pelayan : ','disabled'=>'disabled'));
							
		echo $this->Form->end('Simpan');
		?>
	</div>
</div>