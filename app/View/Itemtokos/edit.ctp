<?php  $this->Html->addCrumb('Toko', array('controller' => 'Tokos', 'action' => 'index')); ?>

<?php  $this->Html->addCrumb('Daftar Item Toko','/itemtokos'); ?>

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

		echo $this->Form->create('Itemtoko', array('action'=>'edit', 'enctype' => 'multipart/form-data','class'=>'form-inline'));

		echo $this->Form->input('id', array('type' => 'hidden'));

		echo $this->Form->input('item_id', array('type' => 'hidden','class'=>'input-tambah-item_id','value'=>$this->request->data['Item']['id']));

		echo $this->Form->input('toko_id', array('type' => 'hidden','class'=>'input-tambah-toko_id','value'=>$this->request->data['Itemtoko']['toko_id']));

		echo $this->Form->input('Item.kodebarang', array('label' => 'Kode Barang : ','class'=>'input-tambah-kodebarang','readonly'=>'readonly'));

		echo $this->Form->input('Item.nama', array('label' => 'Nama Barang : ','class'=>'input-tambah-nama','readonly'=>'readonly'));

		echo $this->Form->input('quantity', array('label' => 'Jumlah (dalam satuan item) : '));

		echo $this->Form->input('hargabeli', array('label' => 'Harga Beli : '));

		echo $this->Form->input('tanggal_masuk', array('label' => 'Tanggal Masuk : ','type' => 'hidden'));

		$cont=0;

		echo '<h4><b><u>Masukkan Harga dan Untung untuk tiap jenis unit</u></b></h4>';

		foreach ($datas as $data) {
		?>

			<div class="row">

				<div class="col-md-12" style="margin:0;">

					<h4 style="margin:0;"><?php echo $data['Unit']['nama']; ?></h4>					

				</div>

				<?php 

					echo $this->Form->input('Hargaunit.'.$cont.'.id',array('type'=>'hidden'));

					echo $this->Form->input('Hargaunit.'.$cont.'.unit_id',array('type'=>'hidden','value'=>$data['Unit']['id']));

				?>

				<div class="col-md-12">

					<?php echo $this->Form->input('Hargaunit.'.$cont.'.harga',array('label'=>'Jual','div'=>array('class'=>'form-group'))); ?>

					<?php echo $this->Form->input('Hargaunit.'.$cont.'.untung',array('label'=>'Untung','div'=>array('class'=>'form-group'))); ?>

				</div>

			</div>

		<?php 

			$cont=$cont+1;

		}
		unset($datas);
		echo $this->Form->end('Simpan');

		?>



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