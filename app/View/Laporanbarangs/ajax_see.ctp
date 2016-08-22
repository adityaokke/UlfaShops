<table class='table table-bordered'>
		  		<thead>
		  			<tr>
		  				
		  				<th style='width:10%;'>kode barang</th>
		  				<th style='width:5%;'>stok</th>
		  				<th style='width:12%;'>satuan grosir</th>
		  				<th style='width:10%;'>lusin grosir</th>
		  				<th style='width:10%;'>lebih 6 lusin</th>
		  				<th style='width:12%;'>satuan eceran</th>
		  				<th style='width:10%;'>3pcs eceran</th>
		  				<th style='width:10%;'>lebih 1 lusin</th>
		  				<th style='width:15%;'>tgl perubahan</th>
		  				<th style='width:15%;'>keterangan</th>
		  			</tr>
		  		</thead>
		  		<tbody>
		  			<?php
		  			
		  					foreach ($list as $data) 
		  					{
		  			?>
		  						<tr>
									
								 <td><?php	echo	$data['Laporanbarangs']['kodebarang'];?></td>	
								 <td><?php	echo	$data['Laporanbarangs']['quantity'];?></td>
								 <td><?php	echo	$data['Laporanbarangs']['satuan_grosir'];?></td>		
								 <td><?php	echo	$data['Laporanbarangs']['lusin_grosir'];?></td>
								 <td><?php	echo	$data['Laporanbarangs']['lusin6_grosir'];?></td>
								 <td><?php	echo	$data['Laporanbarangs']['satuan_eceran'];?></td>
								 <td><?php	echo	$data['Laporanbarangs']['pcs3_eceran'];?></td>
								 <td><?php	echo	$data['Laporanbarangs']['lusin1_eceran'];?></td>
								 <td><?php	echo	$data['Laporanbarangs']['tanggal_aksi'];?></td>
								 <td><?php	echo	$data['Laporanbarangs']['keterangan'];?></td>
								 <td>			
								</tr>
		  			<?php 	
		  					}
		  			?>
				</tbody>


		  	</table>