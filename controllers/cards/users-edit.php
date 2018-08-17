<?php

$css = '
	
';

$card = array(
	'icon'		=> "/res/icons/account.svg",
	'name'		=> "UserEdit",
	'class'		=> "edit-user",
	'title'		=> "Éditer un utilisateur",
	'secondary'	=> '<div class="button circle" onClick=""><img src="/res/icons/delete.svg?color=ffffff"/></div>',
	
);

?>

<style>
	
	.card-edit-user {
		min-width: 600px;
	}
	
	.card-edit-user .edit-name {
		
	}
	
	.card-edit-user .card-body > .inner {
		padding: 1.5rem;
		display: flex;
	}
	
	.card-edit-user .info {
		text-align: right;
	}
	
	.card-edit-user .info > p {
		margin: 0.5rem 0;
	}
	
</style>
<div class="card-edit-user" style="display: none;"></div>
<div class="col col-5">
	<div class="form-edit">
		<div class="form-row mb1 edit-name">
			<div class="form-input big w10">
				<img class="icon" src="/res/icons/pencil.svg"/>
				<input type="text" placeholder="Nom de l'utilisateur" value="" disabled/>
			</div>
		</div>

		<div class="form-row mt2 ml1-5">
			<div class="button green"><span>Enregistrer</span></div>
		</div>
	</div>	
</div>

<div class="col col-5">
	<div class="info">
		<p>ID : </p>
		<p>Création le </p>
		<p></p>
	</div>
</div>