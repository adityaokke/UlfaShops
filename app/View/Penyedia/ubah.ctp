<?php 
	echo $this->Form->create('Penyedia',array('url'=>
		array('controller'=>'Penyedia','action'=>'ubah',
			$Supplier_id)));

	echo $this->Form->input('Penyedia.id',array('id'=>'posttitle','label'=>'judul : ','style'=>'width:100%;','value'=>$Supplier_id));
	echo $this->Form->input('Penyedia.nama',array('id'=>'postcontent','label'=>'nama','value'=>$data['Penyedia']['nama']));
	echo $this->Form->input('Penyedia.alamat',array('id'=>'postcontent','label'=>'alamat','value'=>$data['Penyedia']['alamat']));
	
	echo $this->Form->input('Penyedia.telepon',array('id'=>'postcontent','label'=>'telepon','value'=>$data['Penyedia']['telepon']));
	echo $this->Form->end(array('label'=>'edit supllier'));
?>