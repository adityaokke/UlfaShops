<?php  $this->Html->addCrumb('Toko', array('controller' => 'Tokos', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Daftar Retur','#'); ?>
<div class="row">
	<div class="col-md-6">
		<header>
			<h3>Daftar Retur</h3>
		</header>
		<?php 
			echo $this->Html->link(
					'Tambah Retur', 
					array('controller'=>'Returs', 'action' => 'add'),
					array('class' => 'btn btn-primary')
			);
		?>
		<table>
			<thead>
				<tr>
					<td></td>
					<td>No Nota</td>
					<td>Kode Barang</td>
					<td>Jumlah</td>	
				</tr>
			</thead>
			<tbody>
			<?php
			foreach($datas as $data) {
			?>
				<tr>
					<td><?php 
					echo $this->Html->link('Sunting', array('action'=>'edit', $data['Retur']['id']));
					echo $this->Form->postLink(' | Hapus', 
									array('action'=>'delete', $data['Retur']['id']),
									array('confirm' => 'Apakah yakin akan menghapus data ' . 
										  $data['Retur']['kodebarang']));
					// echo $this->Html->link(' | Detil', 
					// 				array('action'=>'detil', $data['Pembeli']['id']));
					 ?></td>
					 <td>
						 <?php echo 
						 $this->Html->link($data['Retur']['notajual_id'], array('controller'=>'Notajuals','action'=>'detil',$data['Retur']['notajual_id']), 
						 			array('class'=>'lihat-nota btn btn-info', 'notajual_id' => $data['Retur']['notajual_id']	)); 
						?>
					</td>
					<!-- <td><?= $data['Retur']['notajual_id']; ?></td> -->
					<td><?= $data['Retur']['kodebarang']; ?></td>
					<td><?= $data['Retur']['jumlah']; ?></td>
					

				</tr>
			<?php
			}
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
	</div>
	<div class="col-md-6 nota"></div>
</div>