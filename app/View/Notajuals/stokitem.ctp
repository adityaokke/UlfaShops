<?php  $this->Html->addCrumb('Toko', array('controller' => 'Tokos', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Laporan Penjualan','#'); ?>
<div class="row">

<?php //debug(date('t',strtotime(date('Y-m',strtotime('2015-04-31'))))); 
	//debug(date('Y-m',strtotime('2015-04-31')));
?>
		<div class="col-md-12">		
			<?php
			$base_url = array('controller' => 'notajuals', 'action' => 'stokitem');
			echo $this->Form->create('Filter', array(
			'url' => $base_url,
			'class' => 'filter form-inline', 
			'role' => 'form',
			'inputDefaults' => array(
			    'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
			    'div' => array('class' => 'form-group','label' => array('class' => 'sr-only')
			    ),'class' => array('form-control')))); ?>
			
			<fieldset class="pull-right">    
		    <?php 
		    	// $awalbulan=strtotime($awalbulan);
		    	// $akhirbulan=strtotime($akhirbulan);			
		    	// if ($awalbulan>date("Y-m-t", strtotime(date("Y-m",strtotime($awalbulan))))) {
		    	// 	$awalbulan=date("Y-m-t", strtotime(date("Y-m",strtotime($awalbulan))));
		    	// }
		    	// elseif ($akhirbulan>date("Y-m-t", strtotime(date("Y-m",strtotime($akhirbulan))))) {
		    	// 	$akhirbulan=date("Y-m-t", strtotime(date("Y-m",strtotime($akhirbulan))));
		    	// }
		    echo $this->Form->input('kode', array(
										'label' => array(
									        'class' => 'sr-only',
									        'text' => 'Kode Barang'
									    ),
										'placeholder'=>'Kode Barang',
										'class'=>'form-control me-change-index'
					));	
				echo $this->Form->input('awalbulan', array(
										'label' => array(
									        'class' => 'sr-only',
									        'text' => 'Status'
									    ),
										'type' => 'date',
										'class'=>'form-control me-change-tanggal-index',
										'placeholder'=>'Awal',
										'default' => '',
										'dateFormat' => 'DMY',
										'selected' => $awalbulan,
										'day'=>2
									));
				echo " s/d ";
				echo $this->Form->input('akhirbulan', array(
										'label' => array(
									        'class' => 'sr-only',
									        'text' => 'Status'
									    ),
										'type' => 'date',
										'class'=>'form-control me-change-tanggal-index',
										'placeholder'=>'Akhir',
										'default' => '',
										'dateFormat' => 'DMY',
										'selected' =>$akhirbulan
									));			
				
									// date("Y-m-t", strtotime($akhirbulan))
                echo "<div class='submit actions me-hide-index'>";
                echo $this->Form->submit("Search");
                echo $this->Html->link("Reset",$base_url);
                echo "</div>";
		    ?>

			</fieldset>
			<?php echo $this->Form->end();?>
		</div>
	<div class="col-md-12">
	<header>
		<h3>Laporan Penjualan</h3>
		</header>
		
		<table>
			<thead>
				<tr>
					<td rowspan="2" class="td-stokitem">No</td>
					<td rowspan="2" class="td-stokitem">Kode</td>
					<td rowspan="2" class="td-stokitem">Nama</td>
					<?php 
					$no=0;
					$time=strtotime($awalbulan);							
					while($time<=strtotime($akhirbulan)){
						$tahun=date("o",$time);
						while ($time<=strtotime($tahun.'-12-31')&&$time<=strtotime($akhirbulan)) {					
							$bulan=date("n",$time);
							$tep[$no]['Bulan']=date("F",$time);
							$opo=0;
							while($time<=strtotime(date("Y-m-t",strtotime($tahun.'-'.$bulan.'-01')))&&$time<=strtotime($akhirbulan)){
								$tanggal=date("j",$time);
								$opo=$opo+1;
								$tep[$no]['days'][$opo]=$tanggal;
								$time=strtotime("+1 day",$time);	
							}
							$tep[$no]['Jmlh']=$opo;
							$no++;
						}
					} 			
					debug($tep);	
					foreach ($tep as $key) {
							
							?>
							<td style="text-align:center;"colspan="<?php echo $key['Jmlh'];  ?>"><?php echo $key['Bulan']; ?></td>
							<?php
						}	

					?>
					
					<td rowspan="2">Jumlah</td>
				</tr>
				<tr>
					<?php foreach ($tep as $key) {
							foreach ($key['days'] as $a => $value) {
							?>
							<td><?php echo $value; ?></td>
							<?php
						}	
					}
					unset($tep);
						 ?>
				</tr>

			</thead>
			<tbody>
			<?php 
			$no=0;
			foreach ($datas as $data) {
			?>
			<tr>
				<td><?php echo ++$no; ?></td>
				<td><?php echo $data['Item']['kodebarang']; ?></td>
				<td><?php echo $data['Item']['nama']; ?></td>
			<?php
			$time=strtotime($awalbulan);		
			while($time<=strtotime($akhirbulan)){
				$tahun=date("o",$time);
				while ($time<=strtotime($tahun.'-12-31')&&$time<=strtotime($akhirbulan)) {					
					$bulan=date("n",$time);
					while($time<=strtotime(date("Y-m-t",strtotime($tahun.'-'.$bulan.'-01')))&&$time<=strtotime($akhirbulan)){
						$tanggal=date("j",$time);
						if(isset($data[$tahun][$bulan][$tanggal])){
							?>
							<td><?php echo $data[$tahun][$bulan][$tanggal]; ?></td>
							<?php
						}else{
							?>
							<td> </td>
							<?php
						}
						
						$time=strtotime("+1 day",$time);	
					}
					
				}
				
			} ?>
			<td><?php echo $data['total']; ?></td>
			</tr>
			<?php }
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