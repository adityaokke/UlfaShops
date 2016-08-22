



<div class='row'>

	<div class='col-md-10'>

		<br>

		<div>

				<button class='btn btn-primary' id='tambah' onclick="window.location.href='<?php echo Router::url(array('controller'=>'Item', 'action'=>'tambah'))?>'">Tambah data</button>

		</div>

		

		<br>

		<table class='table table-bordered'>



			<thead>

				<tr style='font-size:15pt;'>

					<th style="width: 150px">NAMA</th>

					<th style="width: 100px">Kode barang</th>

					<th style="width: 200px">Subkategori</th>

					<th style="width: 50px">pilihan</th>

					

					

			

				</tr>		

			</thead>

			<tbody>

				<?php 

				foreach($Item as $data)

				{?>

					<tr style='font-size:11pt;'>

						<td>
							<?php echo $this->Html->link($data['Item']['nama'],array('controller'=>'Item','action'=>'detil',$data['Item']['id'])) ?></td>	

						<td><?php echo $data['Item']['kodebarang'];?></td>

						<td><?php echo $data['Kategori']['nama'];?></td>

						<td>

							<?php

							echo $this->Html->link('ubah',array('controller'=>'Item','action'=>'ubah',$data['Item']['id']));

							echo " - ".$this->Form->postlink('hapus',array('controller'=>'Item','action'=>'hapus',$data['Item']['id']),array('confirm'=>'anda yakin ingin menghapus'));

							?>

						</td>

					</tr>

				<?php

				}

				unset($Item)

				?>



			</tbody>

			</table>

			

			<div	class="paging">	

			<?php	

				 echo	$this->Paginator->prev('<<',array('escape'=>false),null,array('escape'=>false,'class'=>'prev	disabled','id'=>'prev'))	.	

				 		$this->Paginator->numbers(array('before'=>false,'after'=>false,'separator'=>false))	.	

				 		$this->Paginator->next('>>',array('escape'=>false),	null,array('escape'	=>	false,'class'=>'next	disabled','id'=>'next'));		

			?>	

			</div>

	</div>

	<div class='col-md-2'>

		<h5>

		<?php 

		$this->Html->addCrumb('Item', array('controller' => 'Item', 'action' => 'index'));

		echo $this->Form->create('keyword',array('url'=>'/Item/search','type'=>'get','class'=>'form-group'));	

		echo $this->Form->input('key',array('id'=>'postcontent','label'	=>	'Masukan nama barang','class'=>'searchnamai focusme form-control'));

		echo $this->Form->input('key2',array('id'=>'postcontent','label'	=>	'Masukan kode barang','class'=>'searchkodei form-control'));

		echo $this->Form->end(array('label'=>'cari'));

		?>

		</h5>

	</div>



	



</div>

