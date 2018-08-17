<?php

$css = '
	
';

$card = array(
	'icon'		=> "/res/icons/pencil.svg",
	'name'		=> "EditSkin",
	'class'		=> "edit-skin",
	'title'		=> "Éditer un skin",
	'secondary'	=> '<div class="button circle" onClick=""><img src="/res/icons/delete.svg?color=ffffff"/></div>',
	
);

?>

<style>
	
	.card-edit-skin {
		overflow: visible;
	}
	
	.card-edit-skin .card-header {
		border-radius: 6px 6px 0px 0px;
	}
	
	.card-edit-skin .card-body > .inner {
		padding: 1.5rem;
	}
	
	.card-edit-skin .form-edit {
		padding: 1rem;
		display: flex;
		flex-wrap: wrap;
	}
	
	.card-edit-skin .card-body .wrapper {
		position: relative;
		display: flex;
	}
	
	
	
	.card-edit-skin .form-end {
		display: flex;
		padding-left: 1rem;
		padding-top: 1rem;
	}
	
	.card-edit-skin .form-end > .info {
		flex-grow: 1;
		justify-content: flex-end;
		display: flex;
		padding-right: 2rem;
	}
	
	.card-edit-skin .form-end > .info > p {
		margin: auto 0 auto 15px;
	}
	
	
	.card-edit-skin .preview {
		height: 380px;
		background-position: center;
		background-size: cover;
		background-repeat: no-repeat;
		background: linear-gradient(to bottom right, #37474f, #b0bec5);
		border-radius: 6px;
		height: 360px;
		width: 360px;
		margin-left: auto;
	}
	
	.card-edit-skin .preview > div {		
		border-radius: 6px;
		height: 360px;
		width: 360px;
		left: 70%;
		background-position: center;
		background-size: cover;
		background-repeat: no-repeat;
	}
	
</style>
<div class="wrapper">
	<div class="col col-5">
		<div class="form-edit">
			<div class="form-row mb1">
				<div class="form-input w10">
					<img class="icon" src="/res/icons/pencil.svg" />
					<input type="text" placeholder="Nom du skin" value="" disabled/>
				</div>
			</div>

			<div class="form-row mb1">
				<div class="form-input w5">
					<img class="icon" src="/res/icons/currency-usd.svg"/>
					<input type="text" placeholder="Prix" value="" disabled/>
				</div>

				<div class="form-select w5 ml1">
					<select class="w10" disabled>
						<option>V-bucks</option>
						<option>Vip</option>
					</select>
				</div>
			</div>

			<div class="form-row mb1">
				<div class="form-select w5 ml1-5">
					<select	class="w10" disabled>
						<option>Légendaire</option>
						<option>Épique</option>
						<option>Rare</option>
						<option>Peu commun</option>
						<option>Commun</option>
					</select>
				</div>

				<div class="form-select w5 ml-5">
					<select	class="w10" disabled>
						<option>Outfits</option>
						<option>Pickaxe</option>
						<option>Glider</option>
						<option>Emote</option>
						<option>Other</option>
					</select>
				</div>
			</div>


			<div class="form-images form-input mt1">
				<img class="top icon" src="/res/icons/folder-multiple-image.svg"/>			
				<div class="col ml1 mb1">
					<div class="form-input w10">
						<input type="text" placeholder="Ressource" value="" disabled/>
						<img class="delete" src="/res/icons/close-circle.svg"/>
					</div>
					
					<img class="addImage mra ml-5 mt1" src="/res/icons/plus-circle.svg"/>
				</div>
			</div>
			
			<div class="form-row mb1 mt1">
				<div class="form-input">
					<img class="icon" src="/res/icons/calendar-check.svg"/>
					<p class="ml-5">Saison :</p>
					<input type="number" placeholder="Saison" value="" disabled/>
				</div>
			</div>
		</div>


	</div>

	<div class="col col-5">
		<div class="preview">
			<div style="/*background-image: url(/res/images/skins/269.png);*/"></div>
		</div>
	</div>
</div>

<div class="form-end">
	<div class="button green"><span>Enregistrer</span></div>
	<div class="info">
		<p>ID : </p>
		<p>Création le </p>
	</div>
</div>