<?php

function getItem($item) {
	$output = '
		<tr id="' . $item['id'] . '">
			<td class="name">' . $item['name'] . '</td>
			<td>Créé le ' . $item['date'] . '</td>
			<td><div class="tag"><p>' . $item['type'] . '</p></div></td>
			<td class="expire">Expiration : ' . $item['expire'] . '</td>
			<td class="profile"><div class="preview"><img src="' . $item['preview'] . '"/></div></td>
		</tr>
	';
	
	return($output);
}

$list = array();

$users = User::getList();

if (!is_array($users)) {
	die('Not array : ' . gettype($users));
}

foreach($users as $user) {
	$img = "/res/icons/account.svg?color=cccccc";
	$expire = $user->expirate;
	
	if (!empty($user->img_profile)) {
		$img = "/res/images/profiles/" . $user->img_profile . "?size=50";
	}
	
	if ($expire == -1) {
		$expire = "Non";
	} else {
		$expire = date("d/m/Y", $expire);
	}
	
	$type = "";
	switch($user->type){
		case 'admin':
			$type = "Administrateur";
			break;
		case 'www':
			$type = "WWW";
			break;
		case 'visitor':
			$type = "Visiteur";
			break;
		default :
			$type = "Inconnu";
			break;
	}
	
	$list[] = array(
		'id'		=> 'user_' . $user->id,
		'name'		=> $user->name,
		'type'		=> $type,
		'date'		=> date('d/m/Y', intval($user->utsCreate)),
		'expire'	=> $expire,
		'preview'	=> $img
	);
}

$card = array(
	'icon'		=> "/res/icons/account.svg",
	'name'		=> "Users",
	'class'		=> "list-users",
	'title'		=> "Liste des utilisateurs",
);

?>

<style>

	.card-list-users {
		width: 800px;
		max-height: 700px;
	}
	
	.card-list-users .card-body > .inner {
	}
	
	.card-list-users .list-users {
		max-width: 100%;
		width: 100%;
		font-family: Myriad Pro, sans-serif;
	}
	
	.card-list-users .list-users tr {
		padding: 1rem 0;
		cursor: pointer;
	}
	
	.card-list-users .list-users td {
		height: 5rem;
		text-align: center;
		justify-content: center;
	}
	
	.card-list-users .list-users .name {
		font-weight: 600;
		font-size: 1.15rem;
	}
	
	.card-list-users .list-users .table-separator {
		width: 2px;
		height: 70%;
		background-color: #626262;
	}
	
	.card-list-users .list-users .preview {
		overflow: hidden;
		border-radius: 50%;
		background-color: white;
		height: 50px;
		width: 50px;
		margin: auto;
	}
	
	.card-list-users .list-users .profile {
		width: 15%;
	}
	
	.card-list-users .list-users .expire {
		width: 100px;
	}
	
	
	.card-list-users .list-users .shop-icon {
		display: flex;
	}
	
	.card-list-users .list-users .shop-icon > img {
		margin: auto 10px;
	}
	
	.card-list-users .list-users .preview > img {
		height: 50px;
		width: 50px;
	}
	
</style>

<table class="list-users">
	<tbody>
		<?php
		foreach ($list as $item) {
			echo(getItem($item));
		}
		?>
	</tbody>
</table>

<script type="text/javascript">
	var list = $('.list-users');
	console.log(list);
	
	$('.list-users tr').each(function(){
		$(this).click(function(){
			var id = $(this).attr('id');
			id = (id.match(/[0-9]+$/))[0];
			console.log(id);
			
			$('.card-list-users').css('opacity', '0.5');
			$('.card-edit-user').css('opacity', '0.5');
			$("body").css("cursor", "progress");
			
			$.ajax({ 
				type: 'GET', 
				url: '../ajax/editUser.php', 
				data: { type: 'get', id: id}, 
				dataType: 'json',
				
				success: function (data) {
					console.log(data);
					
					$('.card-edit-user').val(data['id']);
					$('#editUserUser').val(data['user']);
					$('#editUserName').val(data['name']);
					$('#editUserExpire').val(data['expirate']);
					$('#editUserMail').val(data['mail']);
					$('#editUserType').val(data['type']);
					$('#editUserId').val(data['id']);
					$('#editUserCrea').text('Création le ' + data['utsCreate']);
					$('#editUserId').text('ID : ' + data['id']);
					
					$('.card-list-users').css('opacity', '1');
					$('.card-edit-user').css('opacity', '1');
					$("body").css("cursor", "default");
				},
				
				error : function(result, statut, error) {
					console.error(result + ' / status ' + statut + ' : ' + error);
				},
			});
			
			
		});
	})
</script>