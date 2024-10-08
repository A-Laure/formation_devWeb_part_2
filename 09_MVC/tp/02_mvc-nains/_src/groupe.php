<?php
  require_once 'config/config.php';
  include_once 'functions/helpers.php';


  $idUrl = needGET('id');
  try{
    # Recupere les tavernes ou il y a assez de place pour accueillir le groupe de nains
    $tavernesLibres = makeSelect('SELECT t_id, t_nom, t_ville_fk, (t_chambres - COUNT(n_id)) AS chambresLibres
    FROM taverne 
    LEFT JOIN groupe ON t_id = g_taverne_fk
    LEFT JOIN nain  ON g_id = n_groupe_fk
    GROUP BY t_id
    HAVING chambresLibres >= (SELECT COUNT(n_id) FROM nain WHERE n_groupe_fk = :idUrl)', 
    ['idUrl' => $idUrl ]);

    // HAVING chambresLibres >= (SELECT COUNT(n_id) FROM nain WHERE n_groupe_fk = :idUrl) | Ici on fait une sous requete afin de récupérer le nombre de nains du groupe de la page pour le comparer au nombres de places disponibles dans la taverne sélectionnée  


  }catch(PDOException $e){
    die($e->getMessage());
  }

  # UPDATE
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['tunnel']) && isset($_POST['taverne'])){

      $place = false;
      if($_POST['taverne'] === ''){
        $place = true;
      }else{
  
        foreach($tavernesLibres as $taverne){
  
          if($_POST['taverne'] == $taverne['t_id']){
            $place = true;
            break;
          }
  
        }
  
      }
  
  
      if($place){
  
        $result = makeRequest('UPDATE groupe 
                              SET g_debuttravail = :debut, g_fintravail = :fin, g_taverne_fk = :taverne, g_tunnel_fk = :tunnel 
                              WHERE g_id = :idUrl',
                              ['debut' => $_POST['debut'], 'fin'=>$_POST['fin'], 'taverne'=>$_POST['taverne'],'tunnel'=>$_POST['tunnel'], 'idUrl'=> $idUrl]);
        // header('Location: groupe.php?id='.$idUrl);
      }else {
  
        $error = 'Nombre de place insuffisante';
  
      }
  
  
    }
  
  }



  # AFFICHAGE INFOS ET FORMULAIRE
  try{
    
    $groupe = makeSelect('SELECT groupe.*,t_nom,t_progres, t_villedepart_fk, t_villearrivee_fk, depart.v_nom AS v_depart, arrivee.v_nom AS v_arrivee
    FROM groupe 
    LEFT JOIN taverne ON g_taverne_fk = taverne.t_id
    LEFT JOIN tunnel ON g_tunnel_fk = tunnel.t_id
    LEFT JOIN ville AS depart ON t_villedepart_fk = depart.v_id
    LEFT JOIN ville AS arrivee ON t_villearrivee_fk = arrivee.v_id
    WHERE g_id = :idUrl',
    ['idUrl'=> $idUrl]);


    $nains = makeSelect('SELECT n_id, n_nom FROM nain WHERE n_groupe_fk = :idUrl', ['idUrl'=> $idUrl]);


    $tunnels = makeSelect('SELECT tunnel.*, depart.v_nom AS v_depart, arrivee.v_nom AS v_arrivee
                           FROM tunnel
                           JOIN ville AS depart ON t_villedepart_fk = depart.v_id
                           JOIN ville AS arrivee ON t_villearrivee_fk = arrivee.v_id');


    #Recupere les tavernes ou il y a assez de place pour accueillir le groupe de nains
    $tavernesLibres = makeSelect('SELECT t_id, t_nom, t_ville_fk, (t_chambres - COUNT(n_id)) AS chambresLibres
                                  FROM taverne
                                  LEFT JOIN groupe ON t_id = g_taverne_fk
                                  LEFT JOIN nain  ON g_id = n_groupe_fk
                                  GROUP BY t_id
                                  HAVING chambresLibres >= (SELECT COUNT(n_id) FROM nain WHERE n_groupe_fk = :idUrl)', 
                                  ['idUrl' => $idUrl ]);


  }catch(PDOException $e){
    die($e->getMessage());
  }


  
  

  
  $page = 'Groupe ' . $groupe['g_id'];
  require_once 'inc/head.php';
 
?>
<h1 class="title has-text-centered">Fiche du Groupe n° <?= $groupe['g_id']?> </h1>

<div class="columns is-centered">

  <div class="column is-half">
    <div class="card">
      <header class="card-header">
          <p class="card-header-title">Groupe n° <?= $groupe['g_id']?></p>
      </header>
      <div class="card-content">
        <div class="content">
          <p>Membres : </p>

          <span class="tags">
            <?php foreach($nains as $nain): ?>
              <span class="tag"><a href="nain.php?id=<?= $nain['n_id']?>"><?= $nain['n_nom']?></a></span>
            <?php endforeach;?>
          </span>

          <?php if(isset($groupe['g_taverne_fk'])) : ?>
            <p>Boivent dans <a href="taverne.php?id=<?= $groupe['g_taverne_fk']?>"> <?= $groupe['t_nom']?></a></p>
          <?php else: ?>
            <p>Boivent dans aucune</p>
          <?php endif; ?>

          <?php if(isset($groupe['g_tunnel_fk'])) : ?>
            <p><?= $groupe['t_progres'] == 100 ? 'Entretiennent' : 'Creusent' ?> de  <?= $groupe['g_debuttravail'] ?>  à  <?= $groupe['g_fintravail'] ?>  le tunnel de <a href="ville.php?id=<?= $groupe['t_villedepart_fk']?>"> <?= $groupe['v_depart']?></a>  à  <a href="ville.php?id=<?= $groupe['t_villearrivee_fk']?>"> <?= $groupe['v_arrivee']?></a>  (<?= $groupe['t_progres']?>% )</p>
          <?php endif; ?>

        </div>
    </div>
    <div class="card-footer">
      <form method="POST" action="" class="section">
        <h3 class="subtitle">Changemment attributions :  </h3>
        <!-- TAVERNES -->
        <div class="field">
          <label for="" class="label">Taverne</label>
          <div class="control">
            <div class="select is-fullwidth">
              <select name="taverne" id="">
              <option value="" <?= !isset($groupe['g_taverne_fk']) ? 'selected' : '' ?> >Aucune</option>
              <?php foreach($tavernesLibres as $taverne) : ?>
                <option value="<?= $taverne['t_id']?>" <?= $groupe['g_taverne_fk'] == $taverne['t_id'] ? 'selected' : '' ?> ><?= $taverne['t_nom']?></option>
              <?php endforeach;?>
              </select>
            </div>
          </div>
        </div>
        <!-- HORAIRES -->
        <div class="field-body my-5">
          <div class="field">
              <label for="" class="label">Debut</label>
              <div class="control">
                <input type="time" class="input" name="debut" step="1" value="<?= $groupe['g_debuttravail'] ?>">
              </div>
          </div>
          <div class="field">
              <label for="" class="label">Fin</label>
              <div class="control">
                <input type="time" class="input" name="fin" step="1" value="<?= $groupe['g_fintravail'] ?>">
              </div>
          </div>
        </div>
        <!-- TUNNELS -->
        <div class="field">
          <label for="" class="label">Tunnel</label>
          <div class="control">
            <div class="select is-fullwidth">
              <select name="tunnel" id="">
              <option value="" <?= !isset($groupe['g_tunnel_fk']) ? 'selected' : '' ?> >Aucun</option>
              <?php foreach($tunnels as $tunnel) : ?>
                <option value="<?= $tunnel['t_id']?>" <?= $groupe['g_tunnel_fk'] == $tunnel['t_id'] ? 'selected' : '' ?> ><?= $tunnel['v_depart']?> -> <?= $tunnel['v_arrivee']?> (<?= $tunnel['t_progres']?>%)</option>
              <?php endforeach;?>
              </select>
            </div>
          </div>
        </div>
        <div class="control  my-5">
          <button class="button is-dark">Modifier</button>
        </div>
      </form>

    </div>
    </div>

  </div>
</div>

<?php


  dump($groupe);

  require_once 'inc/foot.php';

?>