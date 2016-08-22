<?php  $this->Html->addCrumb('Gudang', array('controller' => 'Gudangs', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Kirim Barang','#'); ?>

<div class="row">
	<div class="col-md-12">
	<header>
		<h3>Daftar Pengiriman</h3>
		</header>
		
		<table>
			<thead>
				<tr>
					<td></td>
					<td>No</td>
					<td>Tanggal Kirim</td>
					<td>Toko Tujuan</td>
					<td>Status</td>
					<td>Tanggal Diterima</td>
				</tr>
			</thead>
			<tbody>
			<?php
			debug($datas);
			foreach($datas as $data) {
			?>
				<tr>
					<td><?php 
					echo $this->Html->link('Detil', array('action'=>'detil', $data['Daftarkirim']['id']));
					echo $this->Form->postLink(' | Hapus', 
					 				array('action'=>'delete', $data['Daftarkirim']['id']),
					 				array('confirm' => 'Apakah yakin akan menghapus data ' . 
					 					  $data['Daftarkirim']['id']));
					// // echo $this->Html->link(' | Detil', 
					// 				array('action'=>'detil', $data['Pembeli']['id']));
					 ?></td>
					<!-- <td>
						 <?php //echo 
						// $this->Html->link($data['Pembeli']['id'], '#', 
						// 			array('class'=>'anim btn btn-warning', 'nim' => $data['Pembeli']['id'])); 
						?>
					</td> -->
					<td><?= $data['Daftarkirim']['id']; ?></td>
					<td><?= $data['Daftarkirim']['tanggal_kirim']; ?></td>
					<td><?= $daftartoko[$data['Daftarkirim']['toko_id']]; ?></td>
					<td><?= $data['Daftarkirim']['status']; ?></td>
					<td><?= $data['Daftarkirim']['tanggal_terima']; ?></td>
				</tr>
			<?php
			}
			unset($datas);
			?>
			</tbody>
		</table>
		<div class="paging">
			<?php
			echo $this->Paginator->prev(). ' ' . 
			     $this->Paginator->numbers(array('before'=>false, 'after'=>false,'separator'=>false)) . ' ' .
				 $this->Paginator->next();
			?>
		</div>

<!-- 		<div id="infodetil" style="margin: 40px auto; padding: 60px 20px; background-color: #31B0D5;">
		[Detil Siswa]
		</div>
 -->	</div>
</div>