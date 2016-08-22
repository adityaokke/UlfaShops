
<?php 
	echo $this->Form->create('Post',array('url'=>'/Penyedia/tambah'));
	echo $this->Form->input('Penyedia.nama',array('id'=>'posttitle','label' => 'nama:','style'=>'width:100%'));
	echo $this->Form->input('Penyedia.alamat',array('id'=>'postcontent','label'=>'alamat'));
	echo $this->Form->input('Penyedia.telepon',array('id'=>'postcontent','label'=>'telepon'));
	echo $this->Form->end(array('label' => 'tambah Supplier'));

?>