<?php  $this->Html->addCrumb('Toko', array('controller' => 'Tokos', 'action' => 'index')); ?>

<?php  $this->Html->addCrumb('Daftar Transaksi Jual','/notajuals'); ?>

<?php  $this->Html->addCrumb('Detil Transaksi Jual','#'); ?>

<div class="row">

	<div class="col-md-12">

	<header>

		

		<h3>Detil Transaksi Jual</h3>

		<a class="btn btn-default cetaknota" href="#" idnota="<?php echo $id; ?>">Cetak</a><span>   </span>
		<a class="btn btn-primary" href="<?php echo $this->Html->url(array('controller'=>'notajuals', 'action'=>'add_transjual', $id)); ?>">Tambah</a><br>

		</header>

		<?php if ($this->request->referer()===Router::url(array('controller'=>'returs','action'=>'index',''),true)): ?>

			<?php echo $this->Html->link("Kembali", $this->request->referer(), array('class'=>'lihat-nota btn btn-info')); 

						?>

		<?php endif ?>

		<?php //debug($temp); ?>


		<h4>Keterangan</h4>

		<div><?php echo $temp['Notajual']['keterangan']; ?></div>

		<hr>

		<table>

			<thead>

				<tr>

					<td>Tanggal</td>

					<td>Nama Pembeli</td>

					<td>Total<br>Harga</td>

					<td>Potongan</td>

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

					<!-- <td><?= $nama_pembeli['Pembeli']['nama']; ?></td> -->

					<td><?= $temp['Notajual']['pembeli']; ?></td>

					<td class="formatAngka"><?= $temp['Notajual']['harga_total']; ?></td>

					<td class="formatAngka"><?= $temp['Notajual']['potong']; ?></td>

					<td><?= $temp['Notajual']['status']; ?></td>

					

					<td class="formatAngka"><?= $temp['Notajual']['keuntungan_total']; ?></td>

					<td class="formatAngka"><?= $temp['Notajual']['hutang']; ?></td>

					<?php if ($temp['Notajual']['jatuh_tempo']!=="0000-00-00"): ?>

						<td><?= date('d-m-Y', strtotime($temp['Notajual']['jatuh_tempo'])); ?></td>	

					<?php else: ?>

						<td>__</td>	

					<?php endif ?>

					<td><?= $nama_user['User']['username']; ?></td>

				</tr>

			</tbody>

		</table>		

		<hr>

		<table>

			<thead>

				<tr>

					<td></td>

					<td>Kode Barang</td>

					<td>Nama Barang</td>

					<td>Isi<br>(tiap unit)</td>

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
			$page = $this->params['paging']['Transjual']['page'];
			$limit = $this->params['paging']['Transjual']['limit'];

			$counter = ($page * $limit) - $limit + 1;
			foreach($datas as $data) {

			?>
				<tr>

					<td><?php 
					echo $counter;
					echo $this->Html->link('| Sunting', array('action'=>'edit_transjual', $data['Transjual']['id']));

					echo $this->Form->postLink(' | Hapus', 

									array('action'=>'delete_transjual', $data['Transjual']['id']),

									array('confirm' => 'Apakah yakin akan menghapus data?'));

					 ?></td>

					

					<td><?= $data['Itemtoko']['Item']['kodebarang']; ?></td>

					<td><?= $data['Itemtoko']['Item']['nama']; ?></td>

					<td><?= $data['Transjual']['quantity']; ?></td>		

					<td><?= $data['Transjual']['jumlah_unit']; ?></td>					

					<td><?php echo $this->Form->input('unit', array(

													'label' => '',

													'type' => 'select',

													'disabled' => 'disabled',

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
				$counter++;
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