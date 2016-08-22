<?php  $this->Html->addCrumb('Toko', array('controller' => 'Tokos', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Daftar Jenis Unit','#'); ?>
<div class="row">
	<div class="col-md-6">
	<header>
		<h3>Daftar Jenis Unit</h3>
		</header>
		<?php 
		echo $this->Html->link(
					'Tambah Unit', 
					array('controller'=>'Units', 'action' => 'add'),
					array('class' => 'btn btn-primary')
				);
		?>
		<table>
			<thead>
				<tr>
					<td></td>
					<td>Nama</td>
					<td>Isi(dalam satuan)</td>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach($datas as $data) {
			?>
				<tr>
					<td><?php 
					echo $this->Html->link('Sunting', array('action'=>'edit', $data['Unit']['id']));
					echo $this->Form->postLink(' | Hapus', 
									array('action'=>'delete', $data['Unit']['id']),
									array('confirm' => 'Apakah yakin akan menghapus data ' . 
										  $data['Unit']['nama']));
					// echo $this->Html->link(' | Detil', 
					// 				array('action'=>'detil', $data['Pembeli']['id']));
					 ?></td>
					<!-- <td>
						 <?php //echo 
						// $this->Html->link($data['Pembeli']['id'], '#', 
						// 			array('class'=>'anim btn btn-warning', 'nim' => $data['Pembeli']['id'])); 
						?>
					</td> -->
					<td><?= $data['Unit']['nama']; ?></td>
					<td><?= $data['Unit']['isi_unit']; ?></td>			
				</tr>
			<?php
			}unset($datas);
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