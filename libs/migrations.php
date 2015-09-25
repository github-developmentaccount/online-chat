<?php 


		<?php if(isset($_SESSION['user']['login']) && !empty($_SESSION['user']['login'])): ?>
		
		<?php else:?>

		<?php require_once 'login.tpl.php';?>

		<?php endif; ?>