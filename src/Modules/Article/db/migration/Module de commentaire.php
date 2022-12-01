<?php
	$DB_NAME = new PDO('mysql:DB_HOST=SERVER;DB_NAME=BDD;charset=utf8mb4', 'DB_USERNAME', 'DB_PSW');
	$currenturl = strtolower('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

	// Fonctions de chargement des commentaires

	function commentaires($url, $id_commentaire=0)
	{
		global $db;
	
		$i=0;
		$commentaires = '';
		$tcolor = ['blue','green','orange','purple','gray','red'];
		
		$sql = "SELECT id_commentaire, nom, commentaire, email, date FROM p3x_commentaire WHERE actif='y' AND url=".$db->quote($url);
		if($id_commentaire!=0){ $sql .= " AND id_sous_commentaire=".$id_commentaire; }else{ $sql .= " AND id_sous_commentaire=0"; }
		$sql .= " ORDER BY id_sous_commentaire, date";	

		foreach($db->query($mysql) as $data) {
			$i++;
			mt_srand(crc32($data['email']));
			
			$commentaires .= '<div class="box-light">';
				
				if($i==1 && $id_commentaire==0)
				{
					$sql2 = "SELECT COUNT(id_commentaire) FROM p3x_commentaire WHERE actif='y' AND url=".$db->quote($url);
					$query = $db->prepare($sql2); 
					$query->execute(); 
					$row = $query->fetch();
					$count = $row[0];
					$nb = $count;
					$s='s';
					
					if($count==1){ $nb = 'Un'; }
					
					$commentaires .='<h2>'.$nb2.' commentaire'.$s.'</h2>';
				}
				
				$commentaires .= '<div class="separator"></div>
									<div class="box-light">
										<div class="letter '.$tcolor[mt_rand(0, count($tcolor) - 1)].'">'.htmlentities(substr($data['nom'], 0, 1)).'</div>
										<p class="chapeau">@'.htmlentities($data['nom']).' <span class="gray">'.$data['date'].'</span></p>
										<p>'.htmlentities($data['commentaire']).'</p>
										<form id="comform-'.$data['id_commentaire'].'" method="post" action="'.$url.'">
											<input name="action" value="poster-commentaire" type="hidden">
											<input name="email" class="hidden" type="text">
											<input name="id_sous_commentaire" value="'.$data['id_commentaire'].'" type="hidden">
											<div id="comform-div-'.$data['id_commentaire'].'" class="comform-div hidden">
												<p>Réponse à @'.htmlentities($data['nom']).'<br><textarea name="commentaire"></textarea></p>
												<p>Nom<br><input name="nom" type="text"></p>
												<p>Adresse e-mail<br><input name="emailtrue" type="text"></p>
											</div>
											<div class="clear"></div>
											<p><a class="repondre" data-rel="'.$data['id_commentaire'].'" href="#">Répondre</a></p>
											<div class="clear"></div>
										</form>
									</div>';
				
				$commentaires .= commentaires($url, $data['id_commentaire']);
				
			$commentaires .= '</div>';
		}
		return $commentaires;
	}

	// Insertion d'un commentaire
	
	if(isset($_POST['action']) && $_POST['action']=='poster-commentaire')
	{
		// Protection robot
		if(isset($_POST['email']) && empty($_POST['email']))
		{
			if(isset($_POST['commentaire']) && !empty($_POST['commentaire']) &&	isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['emailtrue']) && !empty($_POST['emailtrue']))
			{
				$id_sous_commentaire = 0;
				
				if(isset($_POST['id_sous_commentaire']) && is_numeric($_POST['id_sous_commentaire'])){ $id_sous_commentaire = intval($_POST['id_sous_commentaire']); }
			
				if(filter_var($_POST['emailtrue'], FILTER_VALIDATE_EMAIL))
				{
					$sql = "INSERT INTO p3x_commentaire(
												id_sous_commentaire,
												nom,
												commentaire,
												email,
												url,
												actif,
												date
											) VALUES(
												".$id_sous_commentaire.",
												:nom,
												:commentaire,
												:emailtrue,
												:currenturl,
												'a',
												'".date("Y-m-d H:i:s")."'
											)";
					$query = $db->prepare($sql);
					$query->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
					$query->bindValue(':commentaire', $_POST['commentaire'], PDO::PARAM_STR);
					$query->bindValue(':emailtrue', $_POST['emailtrue'], PDO::PARAM_STR);
					$query->bindValue(':currenturl', $currenturl, PDO::PARAM_STR);
					$query->execute();
					
					unset($_POST);
					
					$message_text = 'Votre message a été déposé mais vous devez attendre qu\'il soit validé.';
					$message_img = 'check';
				}
				else
				{
					$message_text = 'Votre adresse e-mail n\'est pas valide !';
				}
			}
			else
			{
				$message_text = 'Les informations obligatoires ne sont pas toutes renseignées !';
			}
		}
	}
	
	// Chargement des commentaires
	$commentaires = commentaires($currenturl, 0);
	if(!empty($commentaires)){ echo '<div class="box-light">'.$commentaires.'</div>'; }
?>
<h3>Poster un commentaire</h3>
<form method="post" action="<?php echo $currenturl; ?>">
	<input type="hidden" name="action" value="poster-commentaire" />
	<input type="text" name="email" class="hidden" />
	<p>Commentaire<br /><textarea name="commentaire"></textarea></p>
	<p>Nom<br /><input type="text" name="nom" /></p>
	<p>Adresse e-mail<br /><input type="text" name="emailtrue" /></p>
	<p><input type="submit" class="button-blue left" value="Poster mon commentaire" /></p>
	<div class="clear"></div>
	<p class="red right">Votre adresse e-mail n'est pas publiée lorsque vous ajoutez un commentaire.<br />Tous les champs sont obligatoires pour soumettre votre commentaire.</p>
	<div class="clear"></div>
</form>
