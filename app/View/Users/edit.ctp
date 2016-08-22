<?php  $this->Html->addCrumb('User', array('controller' => 'users', 'action' => 'index')); ?>
<?php  $this->Html->addCrumb('Ubah','#'); ?>

<div class="container">
    <div class="row me-margin-top">
        <div class="users form">
        
            <?php echo $this->Form->create('User'); ?>
            <h2><?php echo __('Sunting User'); ?></h2>
            <div class="row">
                <div class="col-md-6">
                    <?php echo $this->Form->input('User.id', array('type' => 'hidden', 'value'=> $this->request->data['User']['id'])); ?>
                    <?php echo $this->Form->input('User.username', array('value' => $this->request->data['User']['username'], 'disabled' => true)); ?>
                </div>
                <div class="col-md-6">
                    <?php echo $this->Form->input('User.nama_lengkap'); ?>
                </div>
            </div>
            <div class="row">
                <?php if ($this->Session->read('Auth.User.role') === 'owner' ) { ?>
                <div class="col-md-6">
                    <?php echo $this->Form->input('User.role', array(
                            'options' => array(
                                               'owner' => 'Owner', 
                                               'manager gudang' => 'Manager Gudang',
                                               'manager toko' => 'Manager Toko',
                                               'kasir' => 'Kasir'
                                               )
                            )
                        );
                    ?>
                </div>			
                <?php } ?>
            </div>
        <?php
            $options = array(
                'label' => 'Sunting Akun',
                'value' => 'Sunting Akun!'
            );
            echo $this->Form->end($options);
        ?>
        </div>
    </div>
</div>