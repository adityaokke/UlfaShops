<?php  $this->Html->addCrumb('Toko', array('controller' => 'Tokos', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Pembeli','#'); ?>
<div class="row">
	<div class="col-md-12">
	<header>
		<h3>Daftar Pembeli</h3>
		</header>
		<?php 
		echo $this->Html->link(
					'Tambah Pembeli', 
					array('controller'=>'Pembelis', 'action' => 'add'),
					array('class' => 'btn btn-primary')
				);
		?>
		<table>
			<thead>
				<tr>
					<td></td>
					<td>Nama</td>
					<td>Alamat</td>
					<td>Kontak</td>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach($datas as $data) {
			?>
				<tr>
					<td><?php 
					echo $this->Html->link('Sunting', array('action'=>'edit', $data['Pembeli']['id']));
					echo $this->Form->postLink(' | Hapus', 
									array('action'=>'delete', $data['Pembeli']['id']),
									array('confirm' => 'Apakah yakin akan menghapus data ' . 
										  $data['Pembeli']['nama']));
					// echo $this->Html->link(' | Detil', 
					// 				array('action'=>'detil', $data['Pembeli']['id']));
					 ?></td>
					<!-- <td>
						 <?php //echo 
						// $this->Html->link($data['Pembeli']['id'], '#', 
						// 			array('class'=>'anim btn btn-warning', 'nim' => $data['Pembeli']['id'])); 
						?>
					</td> -->
					<td><?= $data['Pembeli']['nama']; ?></td>
					<td><?= $data['Pembeli']['alamat']; ?></td>
					<td><?= $data['Pembeli']['kontak']; ?></td>
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