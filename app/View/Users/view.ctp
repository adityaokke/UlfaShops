<?php
    echo $this->Html->css('invoice');
?>
<div class="container">
    <div class="row me-margin-top">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th>Modified</th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <?php for ($i = 0; $i < 100; $i++) { ?>
                        <tr class="notfirst">
                            <td><?php echo $user['User']['username']; ?></td>
                            <td><?php echo $user['User']['nama_lengkap']; ?></td>
                            <td><?php echo $user['User']['role']; ?></td>
                            <td><?php echo date('d-m-Y H:i:s', strtotime($user['User']['created'])); ?></td>
                            <td><?php echo date('d-m-Y H:i:s', strtotime($user['User']['modified'])); ?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


