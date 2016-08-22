				<tr class=<?php echo $no; ?>>
					<td class=<?php echo $no; ?>><?php echo $no+1; ?><!-- <a class="edit">edit</a> --><a class="hapus">| hapus</a></td>					
					<td><?php echo $this->Form->input('Transjual.'.$no.'.kode', array('label' => '','class'=>'input_select','value'=>$kode,'disabled'=>'disabled')); ?></td>
					<td><?php echo $this->Form->input('Transjual.'.$no.'.nama', array('label' => '','class'=>'input_select','disabled'=>'disabled','value'=>$nama)); ?></td>	
					<td><?php echo $this->Form->input('Transjual.'.$no.'.isi', array('label' => '','class'=>'input_select formatAngka','disabled'=>'disabled','value'=>$isi)); ?></td>	
					<td><?php echo $this->Form->input('Transjual.'.$no.'.quantity', array('label' => '','class'=>'input_select','value'=>$jumlah,'disabled'=>'disabled')); ?></td>
					<td><?php echo $this->Form->input('Transjual.'.$no.'.unit', array(
													'label' => '',
													'type' => 'select',
													'options' => $jenis_unit,
													'class'=>'input_select me-disabled',
													'default'=>$unit,
													'value'=>$unit,'
													disabled'=>'disabled'
												));
					?></td>
					<td><?php echo $this->Form->input('Transjual.'.$no.'.harga', array('label' => '','class'=>'input_select formatAngka','disabled'=>'disabled','value'=>$harga)); ?></td>	
					<td><?php echo $this->Form->input('Transjual.'.$no.'.total', array('label' => '','class'=>'input_select formatAngka','disabled'=>'disabled','value'=>$total)); ?></td>							
					<?php echo $this->Form->input('Transjual.'.$no.'.itemtoko_id', array('label' => '','class'=>'input_select','disabled'=>'disabled','value'=>$itemtoko_id,'type'=>'hidden')); ?>
					<?php echo $this->Form->input('Transjual.'.$no.'.keuntungan', array('label' => '','class'=>'input_select','disabled'=>'disabled','value'=>$untung,'type'=>'hidden')); ?>
				</tr>