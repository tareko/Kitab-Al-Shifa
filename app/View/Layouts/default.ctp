<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Kitab: <?php echo $title_for_layout; ?>
	</title>
<?php
//		echo $this->Html->meta('icon');
		echo $this->Html->script("jquery");

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap.min');
//		echo $this->Html->css('bootstrap-custom');

		echo $scripts_for_layout;
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?= $this->Html->link('Kitab Al Shifa', array('controller' => 'shifts', 'action' => 'home'), array('class' => 'navbar-brand')); ?>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><?=$this->Html->link('Schedules', array('controller' => 'shifts', 'action' => 'wizard'));?></li>
            <li><?=$this->Html->link('Shift trading', array('controller' => 'trades', 'action' => 'index'));?></li>
            <li><?=$this->Html->link('Preferences', array('controller' => 'users', 'action' => 'preferences'));?></li>
			<?php if ($admin) { ?>
            <li><?=$this->Html->link('Administration', array('controller' => 'pages', 'action' => 'admin'));?></li>
			<?php } ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
		  <li><?php if($logged_in) {
		  	echo $this->Html->link($users_username .' (Logout)', array('controller' => ' users', 'action' => 'logout'));
		  } ?>
          </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


<div id="container-fluid">
	<?php
		$isLive = '';
		$currentPage = 	$_SERVER['REQUEST_URI'];
	?>
		<nav id="secondary-menu" <?php if ($currentPage != Router::url('/trades/index') && $currentPage != Router::url('/trades') && $currentPage != Router::url('/trades/history')) {echo 'style="display: none;"';}?>>
		<ul>
			<li><?php
				$isLive = '';
					if ($currentPage == Router::url('/trades/index') || $currentPage == Router::url('/trades')) {
					$isLive = array('class' => 'menu-current');
				}
				echo $this->Html->link('Make a trade', array('controller' => 'trades', 'action' => 'index'), $isLive) ?>
			</li>
			<li><?php
				$isLive = '';
					if ($currentPage == Router::url('/trades/marketplace')) {
					$isLive = array('class' => 'menu-current');
				}
				echo $this->Html->link('Marketplace', array('controller' => 'trades', 'action' => 'marketplace'), $isLive) ?>
			</li>
			<li><?php
				$isLive = '';
				if ($currentPage == Router::url('/trades/history')) {
					$isLive = array('class' => 'menu-current');
				}
				echo $this->Html->link('Trading history', array('controller' => 'trades', 'action' => 'history'), $isLive) ?>
			</li>
			</ul>
		<div class="clear"></div>
		</nav>
    	<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
		</div>
		<footer>
		</footer>
	</div>
	<?php
		echo $this->Html->script("bootstrap.min");
		echo $this->Html->script("jquery");
	?>
	</body>
</html>