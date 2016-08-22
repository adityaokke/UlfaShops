<?php
	echo $this->Form->create('Transbeli',array('url'=>array('controller'=>'Transbeli','action'=>'ubah',$this->params['pass'][1])));
	echo $this->Form->input('Transbeli.id',array('id'=>'posttitle','label'=>'judul','value'=>$data['Transbeli']['id']));
	echo $this->Form->input('kodebarang',array('id'=>'postcontent','label'=>'kodebarang','value'=>$kodebarang));
	echo $this->Form->input('Transbeli.quantity',array('id'=>'postcontent','label'=>'jumlah','value'=>$data['Transbeli']['quantity']));
	echo $this->Form->input('Transbeli.harga',array('id'=>'postcontent','label'=>'harga beli','value'=>$data['Transbeli']['harga']));
	echo $this->Form->submit('submit');
	echo $this->Form->end();


?>