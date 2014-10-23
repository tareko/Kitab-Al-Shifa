<?php
	echo $this->Form->create('User', array(
			'action' => 'login',
			'class' => 'form-signin'));?>
	<h2 class="form-signin-heading">Please sign in</h2>
<?php


	echo $this->Form->input('username', array(
			'class' => 'form-control',
			'placeholder' => 'Username',
			'label' => false),
			'required',
			'autofocus');
	echo $this->Form->input('password', array(
			'class' => 'form-control',
			'placeholder' => 'Password',
			'label' => false),
			'required',
			'autofocus');
	echo $this->Form->submit('Sign in', array(
			'class' => 'btn btn-lg btn-primary btn-block'));
	echo $this->Form->end();
?>