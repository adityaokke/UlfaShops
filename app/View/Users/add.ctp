<?php  $this->Html->addCrumb('User', array('controller' => 'users', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Tambah','#'); ?>
<div class="container">
	<div class="row me-margin-top">


	<?php echo $this->Form->create('User'); ?>
		<h2><?php echo __('Tambah Akun'); ?></h2>
		<div class="row">
			<div class="col-md-6">
			<?php  echo $this->Form->input('username'); ?>
			</div>
			<div class="col-md-6">
			<?php echo $this->Form->input('nama_lengkap'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
			<?php echo $this->Form->input('password'); ?>
			</div>
			<div class="col-md-6">
			<?php echo $this->Form->input('password2', array('type'=>'password')); ?>
			</div>
		</div>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $this->Form->input('role', array(
                                    'options' => array(
                                                       'manager toko' => 'Manager Toko',
                                                       'manager gudang' => 'Manager Gudang',
                                                       'owner' => 'Owner',
                                                       'kasir' => 'Kasir'
                                                       )
                                ));
                        ?>
                    </div>
                </div>
	<?php
	$options = array(
	    'label' => 'Tambah Akun',
	    'value' => 'Tambah Akun!'
	);
	echo $this->Form->end($options);
	?>
	</div>
	</div>

</div>
</div>
