<h2>Detil Item</h2>
<?php
echo $this->Html->link('Kembali', array('action'=>'index'));
?>

<table class='table table-bordered'>
	<thead>
		<tr>
			<th style="width:100px">Nama</th>
			<th style="width:100px">Kode Barang</th>
			
		<!-- 	<th style="width:100px">Jual satuan</th>
		<th style="width:100px">Jual lusin</th>
		<th style="width:100px">Jual gross</th> -->
			<!-- <th style="width:100px">merk</th> -->
			<th style="width:300px">gambar</th>

		</tr>


	</thead>
	<tbody>
		
		<tr>
			<td><?php echo $data['Item']['nama'];?></td>
			<td><?php echo $data['Item']['kodebarang'];?></td>
			
			<!-- <td><?php echo $data['Item']['jual_satuan'];?></td>
			<td><?php echo $data['Item']['jual_lusin'];?></td>
			<td><?php echo $data['Item']['jual_gross'];?></td> -->
			<!-- <td><?php echo $data['Item']['merk'];?></td> -->
			<td>
				<img style="width:300px; height:auto;"src="<?php echo $this->Html->url(array('action'=>'photos', $data['Item']['id'])); ?>" />

			</td>

		</tr>
		

	</tbody>

</table>