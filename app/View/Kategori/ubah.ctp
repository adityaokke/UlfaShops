<?php

	echo $this->Form->create('Kategori',array('url'=>array('controller'=>'Kategori','action'=>'ubah',$Kategori_id)));
	echo $this->Form->input('Kategori.id',array('class'=>'form-control' ,'id'=>'posttitle','label'=>'judul : ','style'=>'width:100%;','value'=>$Kategori_id));
	echo $this->Form->input('Kategori.nama',array('class'=>'form-control','id'=>'postcontent','label'=>'kategori','value'=>$data['Kategori']['nama']));
	
	
	echo $this->Form->end(array('label'=>'edit Item'));
?>
