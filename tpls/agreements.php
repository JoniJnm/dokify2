<?php

use JNMFW\helpers\HLang;
use dokify2\langs\Lang;

?>

<div class="row well">
	<h2 class="title"><?= HLang::get(Lang::generic_agreements) ?></h2>
	
	<form id="agreement_modify" class="form-horizontal" autocomplete="off">
		<div class="row">
			<div class="form-group col-md-5">
				<label class="col-md-2 control-label"><?= HLang::get(Lang::generic_list) ?></label>
				<div class="col-md-10">
					<select required class="agreements form-control">
						<option value=""></option>
					</select>
				</div>
			</div>

			<div class="col-md-2">
				<button type="button" class="delete btn btn-danger hidden"><?= HLang::get(Lang::generic_delete) ?></button>
			</div>
			
			<div class="form-group col-md-5">
				<div class="name"></div>
			</div>
		</div>
		
		<div class="modify_section row hidden">
			<div class="form-group col-md-5">
				<label class="col-md-2 control-label"><?= HLang::get(Lang::generic_relation) ?></label>
				<div class="col-md-10">
					<select required class="relations form-control">
						<option value=""></option>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<button type="submit" class="add_relation btn btn-success"><?= HLang::get(Lang::generic_add_relation) ?></button>
			</div>
			<div class="col-md-5">
				<div class="form-control-static long_name"></div>
			</div>
		</div>
	</form>
	
	<hr>
	
	<form id="agreement_create" class="form-horizontal row" autocomplete="off">
		<div class="form-group col-md-5">
			<label class="col-md-2 control-label"><?= HLang::get(Lang::generic_name) ?></label>
			<div class="col-md-10">
				<input maxlength="127" required type="text" class="name form-control">
			</div>
		</div>
		<div class="form-group col-md-5">
			<label class="col-md-2 control-label"><?= HLang::get(Lang::generic_relation) ?></label>
			<div class="col-md-10">
				<select required class="relation form-control">
					<option value=""></option>
				</select>
			</div>
		</div>
		<div class="form-group col-md-2">
			<button type="submit" class="btn btn-success"><?= HLang::get(Lang::generic_create_agreement) ?></button>
		</div>
	</form>
</div>