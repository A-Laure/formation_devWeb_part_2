<?php
  require_once 'config/config.php';
  include_once 'functions/helpers.php';


  $idUrl = needGET('id');
  
  #UPDATE
  if(isset($_POST['newGroup'])){

    try{

      if(($update = makeRequest('UPDATE nain SET n_groupe_fk = :groupe WHERE n_id = :id', ['groupe'=> $_POST['newGroup'], 'id'=>$idUrl])) === false){

        $error = 'Impossible de mettre à jour les données';

      }


    }catch(PDOException $e){
      die($e->getMessage());
    }


  }


  # AFFICHAGE
  try{
    $sql = 'SELECT nain.*, g_debuttravail, g_fintravail, g_taverne_fk, taverne.t_nom, t_villedepart_fk, t_villearrivee_fk, origine.v_nom AS v_natale, depart.v_nom AS v_depart, arrivee.v_nom AS v_arrivee
            FROM `nain` 
            LEFT JOIN ville AS origine ON n_ville_fk = v_id 
            LEFT JOIN groupe ON n_groupe_fk = g_id
            LEFT JOIN taverne ON g_taverne_fk = taverne.t_id
            LEFT JOIN tunnel ON g_tunnel_fk = tunnel.t_id 
            LEFT JOIN ville AS depart ON t_villedepart_fk = depart.v_id
            LEFT JOIN ville AS arrivee ON t_villearrivee_fk = arrivee.v_id
            WHERE n_id = :idUrl';
    // les 2 dernieres jointure servent a recuperer les noms des villes de épart et d'arrvivée via les foreign key de la table tunnel qui correspondent a l'id d'un ville (v_id) ici on crée des alias (depart, arrivee) afin d'avoir du contexte et de nous facilité la tache (on a des reflexives), puis dans le select on viendra refaire un alias pour le nom des villes afin d'avoir des clés plus propre pour notre tableau associatif  
    $nain = makeSelect($sql, ['idUrl'=> $idUrl]);

    $groupes = makeSelect('SELECT g_id FROM groupe ORDER BY g_id');
  }catch(PDOException $e){
    die($e->getMessage());
  }

  // autre solution pour gerer un seul resultat avec le fetchAll dans makeSelect
  // $nain = $nain[0];
  $page = 'Profil de ' . $nain['n_nom'];
  require_once 'inc/head.php';
 
?>

<h1 class="title has-text-centered">Fiche de <?= $nain['n_nom']?> </h1>

<div class="columns is-centered">

  <div class="column is-half">
    <div class="card">
      <header class="card-header">
          <p class="card-header-title"><?= $nain['n_nom']?></p>
      </header>
      <div class="card-content">
        <div class="content">

          <p>Le nain <?= $nain['n_nom']?> a une longueur de barbe de <?= $nain['n_barbe']?> cm</p>
          <p>Originaire de <a href="ville.php?id=<?= $nain['n_ville_fk']?>"> <?= $nain['v_natale']?></a></p>

          <?php if(isset($nain['n_groupe_fk'])) : ?>

            <?php if(isset($nain['g_taverne_fk'])) : ?>
              <p>Bois dans la taverne <a href="taverne.php?id=<?= $nain['g_taverne_fk']?>"> <?= $nain['t_nom']?></a></p>
            <?php endif; ?>

            <?php if(isset($nain['t_villedepart_fk'])) : ?>
              <p>Travaille de <?= $nain['g_debuttravail'] ?> à <?= $nain['g_fintravail'] ?> dans le tunnel reliant <a href="ville.php?id=<?= $nain['t_villedepart_fk'] ?>"><?= $nain['v_depart'] ?></a> à  <a href="ville.php?id=<?= $nain['t_villearrivee_fk'] ?>"><?= $nain['v_arrivee'] ?></a></p>
            <?php endif; ?>

            <p>Membre du groupe n°<a href="groupe.php?id=<?= $nain['n_groupe_fk']?>"> <?= $nain['n_groupe_fk']?></a> </p>          


          <?php else : ?>
            <p>N'appartient à aucun groupe</p>
          <?php endif; ?>
        </div>
    </div>
    <div class="card-footer">
      <form method="POST" action="" class="card-footer-item">
        <div class="field has-addons">
          <div class="control is-expanded">
            <div class="select is-fullwidth">
              <select name="newGroup">
              <option value="" <?= !isset($nain['n_groupe_fk']) ? 'selected' : '' ?> >Aucun</option>
              <?php foreach($groupes as $groupe) : ?>
                <option value="<?= $groupe['g_id']?>" <?= $nain['n_groupe_fk'] == $groupe['g_id'] ? 'selected' : '' ?> ><?= $groupe['g_id']?></option>
              <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="control">
            <button class="button is-dark">Changer groupe</button>
          </div>
        </div>
      </form>

    </div>

    </div>

  </div>
</div>

<?php


  dump($nain);

  require_once 'inc/foot.php';

?>