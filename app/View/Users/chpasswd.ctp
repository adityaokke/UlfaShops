<?php  $this->Html->addCrumb('User', array('controller' => 'users', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Ubah Password','#'); ?>

<div class="container">
	<div class="row me-margin-top">
            <?php echo $this->Session->flash(); ?>
            <div class="users form">
                <?php echo $this->Form->create('User'); ?>
                <h2><?php echo __('Ubah Password'); ?></h2>
                <div class="row">
                    <div class="col-md-6">
                        <?php  echo $this->Form->input('User.username', array('value' => $this->request->data['User']['username'], 'disabled' => true)); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->input('User.nama_lengkap', array('value' => $this->request->data['User']['nama_lengkap'], 'disabled' => true)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <?php echo $this->Form->input('active_password', array('type'=>'password', 'label' => __('Password sekarang'))); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <?php echo $this->Form->input('password', array('label' => __('Password baru'))); ?>
                    </div>
                    <div class="col-md-6">
                    <?php echo $this->Form->input('password2', array('type'=>'password', 'label' => __('Ulangi Password baru'))); ?>
                    </div>
                </div>	
            <?php
                $options = array(
                    'label' => 'Ubah Password',
                    'value' => 'Ubah Password!'
                );
                echo $this->Form->end($options);
            ?>
        </div>
    </div>
</div>