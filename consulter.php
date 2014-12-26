<?php 
include_once('generique/applications.php');
verifLogin();

$tabComments = $comment->getComments($_SESSION['id']);
?>

<div class="notif"></div>

<?php if($tabComments) { ?>
<div id="consulter">
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th class="date">Date</th>
				<th class="note">Note</th>
			</tr>
		</thead>
		<tbody>
		<?php for($i=0; $i < count($tabComments) ; $i++) { ?>
			<tr id="<?php echo $tabComments[$i]['id']?>">
				<td>
					<p>
						<?php
						$creation = depuis($tabComments[$i]['date_creation']); 
						
						if( $creation < 1 )
							echo "Aujourd'hui";
						else if( $creation == 1 )
							echo "Hier";
						else  
							echo "Il y a " . depuis($tabComments[$i]['date_creation']) . " jours";
						?>
					</p>
					<div class="grisClair">
						<small>
							<i class="icon-calendar icon-grey"></i> <?php echo getDateFr($tabComments[$i]['date_creation'])?>
							<br>
							<i class="icon-time icon-grey"></i> <?php echo getHeure($tabComments[$i]['date_creation'])?>
						</small>
					</div>
					
					<div class="btn-group">
						<button class="modifier btn btn-small btn-primary" value="<?php echo $tabComments[$i]['id']?>" title="Modifier la note"><i class="icon-pencil icon-white"></i></button>
						<button class="supprimer btn btn-small btn-danger" value="<?php echo $tabComments[$i]['id']?>" title="Supprimer la note"><i class="icon-trash icon-white"></i></button>
					</div>
					
				</td>
				<td>
					<?php 
						if($tabComments[$i]['title']) {
							//$size = strlen($tabComments[$i]['title']);
							//if($size > 25)
							//	echo '<p class="lead gras">' . substr($tabComments[$i]['title'], 0, 25) . '...</p>';
							//else
								echo '<p class="lead gras">' . $tabComments[$i]['title'] . '</p>';
						}
					?>
					
					<div class="note">
					<?php 
						if( isset( $tabComments[$i]['comment'] ) ) {
							//$size = strlen($tabComments[$i]['comment']);
							//if($size > 40)
							//	echo substr(html_entity_decode($tabComments[$i]['comment']), 0, 40). '...';
							//else 
								echo html_entity_decode($tabComments[$i]['comment']);
						}
					?>
					</div>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>

<?php } else { ?>
<p>Tu n'as aucune note pour le moment, qu'attends-tu ?</p>

<?php } ?>