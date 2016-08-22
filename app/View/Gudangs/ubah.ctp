<?php

		  	echo $this->Form->create('Gudangs',array('url'=>array('controller'=>'Gudangs','action'=>'ubah',$gudid,'class'=>'wall')));
		  						 /*echo	$this->Form->input('Gudangs.item_id',array('id'=>'posttitle','label'=>'Judul:'));	*/
		  						 echo   $this->Form->input('Laporanbarangs.kodebarang',array('id'=>'postcontent','label'=>'kodebarang','value'=>$data['Gudangs']['kodebarang']));
		  						 echo   $this->Form->input('Laporanbarangs.quantity',array('id'=>'postcontent','label'=>'jumlah barang','value'=>$data['Gudangs']['quantity']));
		  						 echo	$this->Form->input('Laporanbarangs.harga_barang',array('id'=>'postcontent','label'=>'harga','value'=>$data['Gudangs']['harga_barang']));
		  						 echo	$this->Form->input('Laporanbarangs.tanggal_masuk',array('id'=>'postcontent','label'=>'','value'=>$data['Gudangs']['tanggal_masuk']));
		  						 echo	$this->Form->input('Laporanbarangs.keterangan',array('id'=>'postcontent','label'=>'','placeholder'=>'masukan keterangan'));
		  						  echo   $this->Form->hidden('Laporanbarangs.tanggal_aksi', array('value'=>date('Y-m-d H:i:s'),'class'=>'hidden_input'));

		  						  echo   $this->Form->hidden('Laporanbarangs.gudangs_id', array('value'=>$gudid,'class'=>'hidden_input'));
		  						 echo $this->Form->end(array('label'=>'Submit	Item'));	
		  						 
?>