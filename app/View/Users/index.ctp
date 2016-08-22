<?php  $this->Html->addCrumb('User','#'); ?>

    <div class="row me-margin-top">
        <h1>User Management</h1>
        <h1><?php echo $this->Session->read('Auth.User.username'); ?></h1>
        <?php if ($this->Session->read('Auth.User.role') == 'owner') {?>
        <a class="btn btn-success" href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'add')); ?>">Tambah Akun Baru</a>
        <?php } ?>
        <a class="btn btn-danger" href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'logout')); ?>">Logout</a><br>
        <div class="row">
            <div class="col-md-12">
                <table id="usertable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th>Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php debug($this->Session->read('Auth.User'));foreach($users as $user) { ?>				
                            <tr class="notfirst">
                                <td>
                                    <?php if ($this->Session->read('Auth.User.id') == $user['User']['id'] || $this->Session->read('Auth.User.role') == 'owner') { ?>
                                    <div class="btn-group">
                                    <?php 
                                     //if ($this->Session->read('Auth.User.id') == $user['User']['id']) {
                                       $classwrn = 'btn-info';
                                  //}
                                    ?>
    
                                    <a class="btn <?php echo $classwrn; ?>" href="#"><i class="glyphicon glyphicon-user"></i> User</a>
                                    <a class="btn <?php echo $classwrn; ?> dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'edit', md5('ULFAshops#'.$user['User']['username']))); ?>"><i class="icon-pencil"></i> Ubah</a></li>
                                    <?php if ($this->Session->read('Auth.User.role') == 'owner') { ?>
                                    <li><?php echo $this->Form->postLink('Hapus Akun', array('controller'=>'users', 'action'=>'delete', md5('ULFAshops#'.$user['User']['username'])), array('style' => 'color: #D31F42;', 'escape' => false, 'confirm' => 'Yakinkah Anda?')); ?></li>
                                    <?php } ?>
                                    <li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'chpasswd', md5('ULFAshops#'.$user['User']['username']))); ?>"><i class="icon-edit"></i> Ubah Password</a></li>
                                    </ul>
                                    </div>
                                    <?php } ?>
                                </td>
                                <td><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view', $user['User']['id'] . '.pdf'));?>"><?php echo $user['User']['username']; ?></a></td>
                                <td><?php echo $user['User']['nama_lengkap']; ?></td>
                                <td><?php echo $user['User']['role']; ?></td>
                                
                                <td><?php echo date('d-m-Y H:i:s', strtotime($user['User']['created'])); ?></td>
                                <td><?php echo date('d-m-Y H:i:s', strtotime($user['User']['modified'])); ?></td>
                        </tr>
                        <?php }
                        unset($users);
                        ?>
                    </tbody>
                </table>
                <div class="paging">
                <?php
                        if ($this->Session->check('search')) {
                                $this->Paginator->options['url'] = array_merge($this->passedArgs, array('o' => 'search'));
                        }
                        
                        echo $this->Paginator->prev(' <i class="glyphicon glyphicon-step-backward size-20"></i> ', array('escape' => false), null, array('escape' => false, 'class'=>'prev disabled')) .
                             $this->Paginator->numbers(array('before' => false, 'after' => false, 'separator' => false)) .
                             $this->Paginator->next(' <i class="glyphicon glyphicon-step-forward size-20"></i> ', array('escape' => false, '#ok'), null, array('escape' => false, 'class' => 'next disabled')) 
                ?>
                </div>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>



