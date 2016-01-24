<?php

use JNMFW\helpers\HLang;
use dokify2\langs\Lang;

?>

<div class="row well" id="relations">
	<h2 class="title"><?= HLang::get(Lang::generic_relations) ?></h2>
	
	<form class="form form-horizontal row">
		<div class="form-group col-md-5">
			<label class="col-md-2 control-label"><?= HLang::get(Lang::generic_list) ?></label>
			<div class="col-md-10">
				<select required class="relations form-control">
					<option value=""></option>
				</select>
			</div>
		</div>
		
		<div class="col-md-2">
			<button type="button" class="delete btn btn-danger hidden"><?= HLang::get(Lang::generic_delete) ?></button>
		</div>
		
		<div class="form-group col-md-5">
			
		</div>
	</form>
	
	<form class="form form-horizontal row">
		<div class="form-group col-md-5">
			<label class="col-md-2 control-label"><?= HLang::get(Lang::generic_client) ?></label>
			<div class="col-md-10">
				<select required class="client form-control">
					<option value=""></option>
				</select>
			</div>
		</div>
		<div class="form-group col-md-5">
			<label class="col-md-2 control-label"><?= HLang::get(Lang::generic_provider) ?></label>
			<div class="col-md-10">
				<select required class="provider form-control">
					<option value=""></option>
				</select>
			</div>
		</div>
		
		<div class="col-md-2">
			<button type="submit" class="btn btn-danger"><?= HLang::get(Lang::generic_add) ?></button>
		</div>
	</form>
</div>