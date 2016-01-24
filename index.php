<?php

require(__DIR__.'/includes/init.php');

?>
<!DOCTYPE html>
<html>

	<?php require('tpls/head.php') ?>

	<body role="document">

		<?php require('tpls/navbar.php') ?>

		<div class="container" role="main">
			<?php require('tpls/companies.php'); ?>
			<?php require('tpls/relations.php'); ?>
		</div>

		<?php require('tpls/footer.php') ?>
	</body>
</html>
