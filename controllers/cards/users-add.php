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
		<div class="form-row mb1 edit-user w5">
			<div class="form-input big w5">
				<img class="icon" src="/res/icons/pencil.svg"/>
				<input type="text" placeholder="* Nom de l'utilisateur" id="addUserUser" value=""/>
			</div>
		</div>

		<div class="form-row mb1 edit-password w5">
			<div class="form-input big w10">
				<img class="icon" src="/res/icons/lock.svg"/>
				<input type="text" placeholder="* Mot de passe" id="addUserPassword" value=""/>
			</div>
		</div>
	</div>
	
	<div class="row mt1">
		<div class="form-row mb1 edit-name w5">
			<div class="form-input w5">
				<img class="icon" src="/res/icons/account.svg"/>
				<input type="text" placeholder="Nom affiché" id="addUserName" value=""/>
			</div>
		</div>

		<div class="form-row mb1 edit-mail w5">
			<div class="form-input w10">
				<img class="icon" src="/res/icons/email.svg"/>
				<input type="text" placeholder="Mail" id="addUserMail" value=""/>
			</div>
		</div>
	</div>
	
	<div class="row mt1">
		<div class="form-row mb1 edit-name w5">
			<div class="form-input w5">
				<img class="icon" src="/res/icons/calendar.svg"/>
				<input type="text" placeholder="Date d'expiration" id="addUserExpire" value=""/>
			</div>
		</div>
	</div>
	
	<div class="form-row mb1 edit-type">
		<div class="form-select w5 ml1">
			<p class="mt-5 mb-5">Type de compte :</p>
			<select class="" id="addUserType">
				<option>visitor</option>
				<option>www</option>
				<option>admin</option>
			</select>
		</div>
		
		<div class="form-row mt1-5">
			<p id="errorAddUser" class="mAa mr0"></p>
			<div class="button green mr1" id="addUserSub"><span>Ajouter</span></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var addUserSub = $('#addUserSub');
	
	addUserSub.click(function(){
		console.log('Add');
		
		var addData = [];
		
		addData['name'] = $('#addUserName').val();
		addData['user'] = $('#addUserUser').val();
		addData['password'] = $('#addUserPassword').val();
		addData['mail'] = $('#addUserMail').val();
		addData['type'] = $('#addUserType').val();
		addData['img'] = "";
		//addData['img'] = $('#addUserImg').val();
		addData['expire'] = $('#addUserExpire').val();
		
		console.log(addData);
		
		$.ajax({
			url : '../ajax/addUser.php',
			type : 'GET',
			data: { 
				"name": addData['name'],
				"user": addData['user'],
				"password": addData['password'],
				"mail": addData['mail'],
				"type": addData['type'],
				"img": addData['img'],
				"expirate": addData['expire']
			},

			success : function(code_html, statut) {
				console.log('Succes');
				console.log(code_html);
				location.reload();
			},

			error : function(result, statut, error) {
				console.error(result + ' / status ' + statut + ' : ' + error);
			},
		})
	});
</script>