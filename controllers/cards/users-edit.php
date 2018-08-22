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
	
	.card-edit-user .info > p {
		margin: 0.5rem 0;
	}
	
</style>

<div class="form-edit w10">
	<div class="row">
		<div class="form-row mb1 edit-user w5">
			<div class="form-input big w5">
				<img class="icon" src="/res/icons/pencil.svg"/>
				<input type="text" placeholder="* Nom de l'utilisateur" id="editUserUser" value=""/>
			</div>
		</div>

		<div class="form-row mb1 edit-password w5">
			<div class="form-input w5">
				<img class="icon" src="/res/icons/account.svg"/>
				<input type="text" placeholder="Nom affiché" id="editUserName" value=""/>
			</div>
		</div>
	</div>
	
	<div class="row mt1">
		<div class="form-row mb1 edit-name w5">
			<div class="form-input w5">
				<img class="icon" src="/res/icons/calendar.svg"/>
				<input type="text" placeholder="Date d'expiration" id="editUserExpire" value=""/>
			</div>
		</div>

		<div class="form-row mb1 edit-mail w5">
			<div class="form-input w5">
				<img class="icon" src="/res/icons/email.svg"/>
				<input type="text" placeholder="Mail" id="editUserMail" value=""/>
			</div>
		</div>
	</div>
	
	
	<div class="row mt1">
		<div class="col col-5">
			<div class="form-select w5 ml1">
				<p class="mt-5 mb-5">Type de compte :</p>
				<select class="" id="editUserType">
					<option>visitor</option>
					<option>www</option>
					<option>admin</option>
				</select>
			</div>
		</div>
			
		<div class="col col-5">
			<div class="info">
				<p id="editUserId">ID : </p>
				<p id="editUserCrea">Création le </p>
				<p></p>
			</div>
		</div>
	</div>
	
	<div class="row">
		<p id="errorEditUser" class="mAa mr0"></p>
		<div class="button green mr1" id="editUserSub"><span>Modifier</span></div>
	</div>
</div>

<script type="text/javascript">
	$('#editUserSub').click(function(){
		console.log('Sub edit');
	});
	
	
</script>