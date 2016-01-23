<?php

use JNMFW\helpers\HLang;
use dokify2\langs\Lang;

?>

<div class="row well" id="companies">
	<h2 class="title"><?= HLang::get(Lang::generic_companies) ?></h2>
	
	<div class="col-md-6">
		<div class="col-md-8">
			<select class="list form-control" autocomplete="off">
				<option value="0"></option>
			</select>
		</div>

		<div class="col-md-2">
			<button class="delete btn btn-danger hidden"><?= HLang::get(Lang::generic_delete) ?></button>
		</div>
		<div class="col-md-2">
			<button class="view btn btn-primary hidden"><?= HLang::get(Lang::generic_view) ?></button>
		</div>
	</div>
	
	<div class="col-md-6">
		<form class="add" autocomplete="off">
			<div class="col-md-10">
				<input maxlength="127" required type="text" class="name form-control" placeholder="<?= HLang::get(Lang::generic_company_name) ?>">
			</div>
			<div class="col-md-2">
				<button class="btn btn-success"><?= HLang::get(Lang::generic_add) ?></button>
			</div>
		</form>
	</div>
</div>