<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<header>
				<h3>Transaksi Jual</h3>
				<!-- <a class="btn btn-primary" href="<?php echo $this->Html->url(array('controller'=>'notajuals', 'action'=>'cetak', $temp['Notajual']['id'] . '.pdf')); ?>">Cetak</a><br> -->
				</header>
				<?php //debug($nama_user); ?>
				<table>
					<thead>
						<tr>
							<td>Tanggal</td>
							<td>Nama Pembeli</td>
							<td>Total<br>Harga</td>
							<td>Status</td>
							<td>Total<br>Keuntungan</td>
							<td>Hutang</td>
							<td>Jatuh Tempo</td>
							<td>Nama Pelayan</td>
							
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?= date('d-m-Y', strtotime($temp['Notajual']['tanggal'])); ?></td>
							<td><?= $nama_pembeli['Pembeli']['nama']; ?></td>
							<td class="formatAngka"><?= $temp['Notajual']['harga_total']; ?></td>
							<td><?= $temp['Notajual']['status']; ?></td>
							
							<td class="formatAngka"><?= $temp['Notajual']['keuntungan_total']; ?></td>
							<td class="formatAngka"><?= $temp['Notajual']['hutang']; ?></td>
							<td><?= date('d-m-Y', strtotime($temp['Notajual']['jatuh_tempo'])); ?></td>
							<td><?= $nama_user['User']['username']; ?></td>
						</tr>
					</tbody>
				</table>		
				<hr>
				<table>
					<thead>
						<tr><!-- 
							<td></td> -->
							<td>Kode Barang</td>
							<td>Nama Barang</td>
							<td>Jumlah<br>(tiap unit)</td>
							<td>Unit</td>				
							<td>Harga Jual<br>(tiap unit)</td>
							<td>Total<br>Harga</td>
							<!-- <td>Isi Item<br>(tiap unit)</td>	 -->
							<td>Harga Beli<br>(tiap item)</td>
							<td>Total<br>Keuntungan</td>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach($datas as $data) {
					?>
					<?php //debug($jenis_unit); ?>
					
						<tr>
							<!-- <td><?php 
							echo $this->Html->link('Sunting', array('action'=>'edit_transjual', $data['Transjual']['id']));
							echo $this->Form->postLink(' | Hapus', 
											array('action'=>'delete', $data['Transjual']['id']),
											array('confirm' => 'Apakah yakin akan menghapus data?'));
							 ?></td> -->
							
							<td><?= $data['Itemtoko']['Item']['kodebarang']; ?></td>
							<td><?= $data['Itemtoko']['Item']['nama']; ?></td>
							<td><?= $data['Transjual']['quantity']; ?></td>					
							<td><?php echo $this->Form->input('unit', array(
															'label' => '',
															'type' => 'read only',
															'options' => $jenis_unit,
															'class'=>'input-unit-barang',
															'default'=>'1',
															'value'=>$data['Transjual']['unit']
														));
							?></td>
							<td><?= $hargaunit[$data['Itemtoko']['id']][$data['Transjual']['unit']]; ?></td>
							<td><?= $data['Transjual']['total_harga_jual']; ?></td>
							<!-- <td><?= $isi_unit[$data['Transjual']['unit']]; ?></td> -->
							<td><?= $data['Itemtoko']['hargabeli']; ?></td>
							<td><?= $data['Transjual']['keuntungan']; ?></td>

						</tr>
					<?php
					}
					?>
					</tbody>
				</table>
				<!-- <div class="paging">
					<?php
					echo $this->Paginator->prev(). ' ' . 
					     $this->Paginator->numbers(array('before'=>false, 'after'=>false,'separator'=>false)) . ' ' .
						 $this->Paginator->next();
					?>
				</div> -->

				<!-- <div id="infodetil" style="margin: 40px auto; padding: 60px 20px; background-color: #31B0D5;">
				[Detil Siswa]
				</div> -->
			</div>
		</div>
	</div>

</body>
</html>
