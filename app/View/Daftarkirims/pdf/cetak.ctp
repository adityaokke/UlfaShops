<div class="row">
	<div class="col-md-12">
	<header>
		<h3>Daftar Kirim</h3>
		</header>
		Tanggal Kirim : <?php echo $this->Form->input('Daftarkirim.'.$data['Daftarkirim']['id'].'.tanggal_kirim', array('type'=>'datetime','label' => '','class'=>'me-disabled','selected'=>$data['Daftarkirim']['tanggal_kirim'],'disabled'=>'disabled')); ?>
		<br>
		Tanggal Terima : _______________________
		<table>
			<thead>
				<tr>
					<td>Jumlah</td>
					<td>Kode Barang</td>
					<td>Nama</td>
					
					<td>Status</td>					
				</tr>
			</thead>
			<tbody>
				<?php
				$status = array('perjalanan' => 'Perjalanan', 'rusak' => 'Rusak', 'hilang' => 'Hilang');
				
				foreach($datas as $data) {

				?>

					<tr class=<?php echo $data['Daftarkirim']['id']; ?>>
						<?php //debug($data['Daftarkirim']['id']); ?>

						<?php echo $this->Form->input('Daftarkirim.'.$data['Daftarkirim']['id'].'.id', array('type'=>'hidden','label' => '','class'=>'input_select'.$data['Daftarkirim']['id'],'disabled'=>'','value'=>$data['Daftarkirim']['id'])); ?>
						<?php echo $this->Form->input('Daftarkirim.'.$data['Daftarkirim']['id'].'.gudang_id', array('type'=>'hidden','label' => '','class'=>'input_select'.$data['Daftarkirim']['id'],'disabled'=>'','value'=>$data['Daftarkirim']['gudang_id'])); ?>
						<td><?php echo $this->Form->input('Daftarkirim.'.$data['Daftarkirim']['id'].'.jumlah', array('label' => '','class'=>'input_select'.$data['Daftarkirim']['id'],'disabled'=>'','value'=>$data['Daftarkirim']['jumlah'])); ?></td>						
						
						<td><?php echo $this->Form->input('Daftarkirim.'.$data['Daftarkirim']['id'].'.kodebarang', array('label' => '','class'=>'input_select'.$data['Daftarkirim']['id'],'value'=>$data['Daftarkirim']['kodebarang'],'disabled'=>'')); ?></td>
						<td><?php echo $this->Form->input('Daftarkirim.'.$data['Daftarkirim']['id'].'.nama', array('label' => '','class'=>'input_select'.$data['Daftarkirim']['id'],'disabled'=>'','value'=>$data['Daftarkirim']['nama'])); ?></td>
						<td>_____________</td>
								
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>		
	</div>
</div>