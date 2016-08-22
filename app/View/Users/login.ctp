<div class="container">
<div class="row me-margin-top">
	<div class="col-md-4 col-md-offset-3">
		<div class="users form">
		<?php echo $this->Session->flash('auth'); ?>
		<?php echo $this->Form->create('User'); ?>
		    <fieldset>
		        <legend>
		            <?php echo __('Please enter your username and password'); ?>
		        </legend>
		        <?php echo $this->Form->input('username');
		        echo $this->Form->input('password');
		    ?>
		     <p><?php echo $this->Form->checkbox('remember_me', array('style' => 'float: left; margin-top: 2px;')); ?>
                        <label style="font-weight:normal; font-size:0.9em;" for="UserRememberMe"> Remember me</label>
                    </p>
		    </fieldset>
		<?php echo $this->Form->end(__('Login')); ?>
		</div>
	</div>
</div>
</div>
