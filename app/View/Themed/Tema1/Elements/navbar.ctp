<?php

$main = '';

$kategori = '';

$item = '';

$gudang = '';

$toko = '';



$mainurl = $this->Html->url(array('controller'=>'main', 'action'=>'index'));

$kategoriurl = $this->html->url(array('controller'=>'kategori','action'=>'index'));

$itemurl = $this->html->url(array('controller'=>'Item','action'=>'index'));

$gudangurl = $this->html->url(array('controller'=>'Gudangs','action'=>'index'));

$tokourl = $this->html->url(array('controller'=>'Tokos','action'=>'index'));



if ($menu === 'main') {

  $main = 'class="active"';

  $mainurl = '#';

}

else if($menu=='kategori')

{

  $kategori = 'class="active"';

  $kategoriurl = '#';

}

else if($menu =='item')

{

  $item = 'class="active"';

  $itemurl = '#'; 

}

else if($menu =='gudang')

{

  $gudang = 'class="active"';

  $gudangurl = '#'; 

}

else if($menu =='toko')

{

  $gudang = 'class="active"';

  $gudangurl = '#'; 

}

?>

            

      <div class="navbar navbar-default navbar-fixed-top me-navbar" role="navigation">

        <div class="container-fluid">

          <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="navbar-collapse">

              <span class="sr-only">Toggle navigation</span>

              <span class="icon-bar"></span>

              <span class="icon-bar"></span>

              <span class="icon-bar"></span>

            </button>

            <a class="navbar-brand" href="#">

              <!-- <img src= "<?php echo $this->Html->url(array('action'=>'gambar', 'logo.png'));?>" /> -->

              <!-- kasih logo ULFA ng kene IEK :3 -->
              <?php echo $this->Session->read('Auth.User.Toko.nama'); ?>
            </a>

          </div>

          <div class="navbar-collapse collapse navbar-right">

            <ul class="nav navbar-nav">

              <li <?= $main; ?>><a href="<?= $mainurl; ?>">Home</a></li>

              <li <?= $kategori; ?>><a href="<?= $kategoriurl; ?>">Kategori</a></li>

              <li <?= $item; ?>><a href="<?= $itemurl; ?>">Item</a></li>

              <li <?= $gudang; ?>><a href="<?= $gudangurl; ?>">Gudang</a></li>

              <li <?= $toko; ?>><a href="<?= $tokourl; ?>">Toko</a></li>

              <?php $temp= $this->Session->read('Auth.User.role'); ?>

              <li> <a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'index')); ?>"><?php if( $this->Session->read('Auth.User.role') ){ ?>

                  <?php echo $this->Session->read('Auth.User.username')." | ".$this->Session->read('Auth.User.role'); ?>

                <?php }else echo ""; ?></a> 

              </li>

            </ul>

          </div><!--/.nav-collapse -->

        </div><!--/.container-fluid -->

      </div>