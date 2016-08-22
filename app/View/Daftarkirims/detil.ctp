<?php  $this->Html->addCrumb('Gudang', array('controller' => 'Gudangs', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Kirim Barang', array('controller' => 'daftarkirims', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Edit','#'); ?>
<div class="row">
	<div class="col-md-12">
	<header>
		<div id="status" style="display:none;"><?php echo $status; ?></div>
		<h3>Detil Daftar Kirim</h3>
		
		<h4><?= $daftartoko[$daftar['Daftarkirim']['toko_id']]; ?></h4>
		</header>
		<hr>
		<?php echo $this->Form->create('Daftarkirim', array('action'=>'edit', 'enctype' => 'multipart/form-data','class'=>'editdaftarkirimform')); ?>
		<?php echo $this->Form->input('Daftarkirim.id', array('type'=>'hidden','label' => '','class'=>'me-disabled','value'=>$daftar['Daftarkirim']['id'])); ?>
		<h4>Tanggal Kirim : <?php echo $this->Form->input('Daftarkirim.tanggal_kirim', array('type'=>'datetime','label' => '','class'=>'me-disabled','selected'=>$daftar['Daftarkirim']['tanggal_kirim'],'disabled'=>'disabled','dateFormat'=>'DMY')); ?></h4>

		<h4>Tanggal Terima : <?php 

		if ($daftar['Daftarkirim']['tanggal_terima']) {
			echo $this->Form->input('Daftarkirim.tanggal_terima', array('label' => '','class'=>'input_select','disabled'=>'','selected'=>$daftar['Daftarkirim']['tanggal_terima'],'type'=>'datetime','dateFormat'=>'DMY'));	
		}else{
			echo $this->Form->input('Daftarkirim.tanggal_terima', array('label' => '','class'=>'input_select','disabled'=>'','selected'=>$daftar['Daftarkirim']['tanggal_terima'],'type'=>'datetime','dateFormat'=>'DMY'));
		}

		 ?></h4>

		
		
		
		<?php echo $this->Form->input('Toko.toko_id', array('type'=>'hidden','label' => '','value'=>$daftar['Daftarkirim']['toko_id'])); ?>
		<table>
			<thead>
				<tr><?php if ($this->Session->read('Auth.User.role')): ?>
					
					<td></td>
				<?php endif ?>
					<td>Jumlah</td>
					<td>Kode Barang</td>
					<td>Nama</td>
					<td>Status</td>					
				</tr>
			</thead>
			<tbody>
				<?php
				$status = array('' => '','sampai'=>'Sampai', 'rusak' => 'Rusak', 'hilang' => 'Hilang');				
				foreach($datas as $data) {
					//debug($data);
				?>

					<tr class=<?php echo $data['Detildaftarkirim']['id']; ?>>
						<?php //debug($data['Detildaftarkirim']['id']); ?>

							<?php if ($this->Session->read('Auth.User.role')): ?>
								
						<td><!-- <a class="edit">Edit</a> -->
							<?php echo $this->Html->link('Hapus', array('action' => 'delete', $data['Detildaftarkirim']['id']),array('confirm' => 'Apakah yakin akan menghapus data ' . 
										 $data['Detildaftarkirim']['nama']) );?>
						</td>			
							<?php endif ?>		
						<?php echo $this->Form->input('Detildaftarkirim.'.$data['Detildaftarkirim']['id'].'.id', array('type'=>'hidden','label' => '','class'=>'input_select'.$data['Detildaftarkirim']['id'],'disabled'=>'','value'=>$data['Detildaftarkirim']['id'])); ?>
						<?php echo $this->Form->input('Detildaftarkirim.'.$data['Detildaftarkirim']['id'].'.item_id', array('type'=>'hidden','label' => '','class'=>'input_select'.$data['Detildaftarkirim']['id'],'disabled'=>'','value'=>$data['Detildaftarkirim']['item_id'])); ?>
						<td><?php echo $this->Form->input('Detildaftarkirim.'.$data['Detildaftarkirim']['id'].'.jumlah', array('label' => '','class'=>'input_select'.$data['Detildaftarkirim']['id'],'disabled'=>'','value'=>$data['Detildaftarkirim']['jumlah'])); ?></td>						
						
						<td><?php echo $this->Form->input('Detildaftarkirim.'.$data['Detildaftarkirim']['id'].'.kodebarang', array('label' => '','class'=>'input_select'.$data['Detildaftarkirim']['id'],'value'=>$data['Detildaftarkirim']['kodebarang'],'disabled'=>'')); ?></td>
						<td><?php echo $this->Form->input('Detildaftarkirim.'.$data['Detildaftarkirim']['id'].'.nama', array('label' => '','class'=>'input_select'.$data['Detildaftarkirim']['id'],'disabled'=>'','value'=>$data['Detildaftarkirim']['nama'])); ?></td>
						<!-- <td><?php echo $this->Form->input('Detildaftarkirim.'.$data['Detildaftarkirim']['id'].'.tanggal_terima', array('label' => '','class'=>'input_select'.$data['Detildaftarkirim']['id'],'disabled'=>'','selected'=>$data['Detildaftarkirim']['tanggal_terima'],'type'=>'datetime')); ?></td> -->
						<td><?php echo $this->Form->input('Detildaftarkirim.'.$data['Detildaftarkirim']['id'].'.status', array('options'=>$status,'label' => '','class'=>'input_select'.$data['Detildaftarkirim']['id'],'disabled'=>'','value'=>$data['Detildaftarkirim']['status'],'selected'=>$data['Detildaftarkirim']['status'])); ?></td>
								
					</tr>
				<?php
				}
				unset($datas);
				?>
			</tbody>
		</table>		
		<a class="save-edit-daftar">Simpan</a>
		<?php echo $this->Form->end('Simpan'); ?>	
		<a class="" href="<?php echo $this->Html->url(array('controller'=>'daftarkirims', 'action'=>'cetak', $id . '.pdf')); ?>">Cetak</a><br>
	</div>
</div>