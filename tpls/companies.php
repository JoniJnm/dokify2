<?php

use JNMFW\helpers\HLang;
use dokify2\langs\Lang;

?>

<div class="row well" id="companies">
	<h2 class="title"><?= HLang::get(Lang::generic_companies) ?></h2>
	
	<div class="row form-horizontal">
		<div class="col-md-5 form-group">
			<label class="col-md-2 control-label"><?= HLang::get(Lang::generic_list) ?></label>

			<div class="col-md-10">
				<select class="list form-control" autocomplete="off">
					<option value=""></option>
				</select>
			</div>
		</div>

		<div class="col-md-3">
			<button type="button" class="view btn btn-primary hidden"><?= HLang::get(Lang::generic_relations) ?></button>
			<button type="button" class="modify btn btn-primary hidden"><?= HLang::get(Lang::generic_modify) ?></button>
			<button type="button" class="delete btn btn-danger hidden"><?= HLang::get(Lang::generic_delete) ?></button>
		</div>

		<form class="add col-md-4" autocomplete="off">
			<div class="col-md-10">
				<input maxlength="127" required type="text" class="name form-control" placeholder="<?= HLang::get(Lang::generic_company_name) ?>">
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-success"><?= HLang::get(Lang::generic_add) ?></button>
			</div>
		</form>
	</div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10 relations"></div>
		<div class="col-md-1"></div>
	</div>
</div>