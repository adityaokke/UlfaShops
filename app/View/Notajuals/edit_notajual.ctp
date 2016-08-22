
<div class="row">
	<div class="col-md-12">
		<h2>Edit Nota Jual</h2>
		<p>
		<?php
		echo $this->Html->link('Kembali', array('action'=>'index'));
		?>
		</p>
		<?php
		echo $this->Form->create('NotaJual', array('action'=>'edit', 'enctype' => 'multipart/form-data'));

		echo $this->Form->input('Transjual.id', array('type' => 'hidden'));
		echo $this->Form->input('user_id', array('label' => 'Nama Penjual : '));
		echo $this->Form->input('alamat', array('label' => 'Alamat : '));
		echo $this->Form->input('kontak', array('label' => 'Kontak : '));
							
		echo $this->Form->end('Simpan');
		?>
	</div>
</div>