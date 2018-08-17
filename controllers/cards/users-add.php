<?php

$card = array(
	'icon'		=> "/res/icons/plus-circle.svg",
	'name'		=> "UserAdd",
	'class'		=> "add-user",
	'title'		=> "Ajouter un utilisateur",	
);

?>

<style>
	
	.card-add-user {
		min-width: 600px;
	}
	
	.card-add-user .edit-name {
		
	}
	
	.card-add-user .form-edit {
		width: 100%;
	}
	
	.card-add-user .card-body > .inner {
		padding: 1.5rem;
	}
	
	.card-add-user .info {
		text-align: right;
	}
	
	.card-add-user .info > p {
		margin: 0.5rem 0;
	}
	
</style>
<div class="card-add-user" style="display: none;"></div>
<div class="form-edit">
	<div class="row">
		<div class="form-row mb1 edit-name w5">
			<div class="form-input big w5">
				<img class="icon" src="/res/icons/pencil.svg"/>
				<input type="text" placeholder="Nom de l'utilisateur" value=""/>
			</div>
		</div>

		<div class="form-row mb1 edit-password w5">
			<div class="form-input big w10">
				<img class="icon" src="/res/icons/lock.svg"/>
				<input type="text" placeholder="Mot de passe" value=""/>
			</div>
		</div>
	</div>

	
	<div class="form-row mb1 edit-type">
		<div class="form-select w5 ml1">
			<p class="mt-5 mb-5">Type de compte :</p>
			<select class="">
				<option>Visiteur</option>
				<option>WWW</option>
				<option>Administrateur</option>
				<option>Root</option>
			</select>
		</div>
		
		<div class="form-row mt1-5">
			<div class="button green mla mr1"><span>Ajouter</span></div>
		</div>
	</div>
</div>	