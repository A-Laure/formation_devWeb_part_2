<?php 

  require_once 'config/config.php';
  require_once 'lib/autoloader.php';
  require_once 'lib/_helpers/tools.php';

  $page = 'Conversations';


  require 'templates/head.php';

  # On initialise la valeur de la page courante a 1
  $currentPage = 1;

  # Si il y a un parametre dans l'url (?page=numero-de-page => $_GET['page'])
  # IF : si $_GET['page'] n'est pas vide et que sa valeur est de type numérique alors on stocke la valeur de $_GET['page'] dans $currentpage 
  if(!empty($_GET['page']) && ctype_digit($_GET['page']))
  {
    $currentPage = $_GET['page'];
  }

  # On initialise la valeur de la page courante a 1
  $pagination = PAGINATION;

  # Si il y a un parametre dans l'url (?pagination=nombre-de-message-par--page => $_GET['pagination'])
  # IF : si $_GET['pagination'] n'est pas vide et que sa valeur est de type numérique alors on stocke la valeur de $_GET['pagnination'] dans $pagination
  if(!empty($_GET['pagination']) && ctype_digit($_GET['pagination']))
  {
    $pagination = $_GET['pagination'];
  }

  try 
  {
    
    $msgModel = new MessageModel();
    $datas = $msgModel->readAll($_GET['conv'], $pagination, $pagination*($currentPage-1));
    $nbMsg = $msgModel->countNbMessages($_GET['conv']);
    // debug($datas);

    if(count($datas) === 0)
    {
      header('Location: page404.php?_err=404');
      exit;
    }


    foreach($datas as $data)
    {
      $messages[] = new Message($data);
    }

    // debug($messages);
  }
  catch(Exception $e)
  {
    header('Location: index.php?_err=500');
    exit;
  }

?>

  
  <div class="section">
  <a href="index.php" class="button is-dark my-5">Retour</a>
    <h1 class="title">Liste des messages de la conversation n° <?= $_GET['conv'] ?></h1>
    <form action="" method="GET">
      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label for="" class="label">Afficher</label>
        </div>
        <div class="field">
          <div class="select">
            <input type="hidden" name="conv" value="<?= $_GET['conv']  ?>">
            <select name="pagination" >
              <option <?= $pagination == 10 ? 'selected' : '' ?> value="10">10</option>
              <option <?= $pagination == 20 ? 'selected' : '' ?> value="20">20</option>
              <option <?= $pagination == 50 ? 'selected' : '' ?> value="50">50</option>
            </select>
            </div>
        </div>
        <div class="ml-3 control">
          <button class="button is-dark" type="submit">Trier</button>
        </div>
      </div>
    </form>
    <div class="card is-shadowless">
      <div class="card-content">
        <?php if(!empty($messages)): ?>
          <table class="table is-hoverable is-fullwidth">
            <thead>
              <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Auteur</th>
                <th>Message</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($messages as $msg): ?>
              <tr>
                <td><?= $msg->getDate() ?></td>
                <td><?= $msg->getHour() ?></td>
                <td><?= $msg->getAuthor() ?></td>
                <td><?= $msg->getMessage() ?></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>

          <?php

            # Calcul du nombre total de page (ceil() fonction qui nous renvoie l'arrondi superieur de la division)
            $totalPages = ceil($nbMsg['nbMsg'] / $pagination);

          ?>

          <nav class="pagination is-centered">
              <a <?= ($currentPage > 1) ? 'href="?conv='. $_GET['conv'] .'&page='. $currentPage-1 .'"' : '' ?> class="pagination-previous" <?= ($currentPage > 1) ? '' : 'disabled' ?> >Page précedente</a>

              <a <?= ($currentPage < $totalPages) ? 'href="?conv='. $_GET['conv'] .'&page='. $currentPage+1 .'"' : '' ?> class="pagination-next" <?= ($currentPage < $totalPages) ? '' : 'disabled' ?>  >Page suivante</a>
              <ul class="pagination-list">
                <?php 
                  # On génère les liens de chaque page (ajouter dans l'url le parametre  ?conv='. $_GET['conv'].'&page='.$i.' ) on garde dans l'url le parametre de la conversation et on ajoute le parametre du numero de la page
                  # des que l'on veut rajouter un deuxieme parametre ou plus dans l'url il faut ajouter & avant 
                  for($i = 1; $i <= $totalPages; $i++) :
                    # si $i est égale a la page courante 
                    # on affihe le carre bleu 
                    # sinon on affiche le carre avec le numero de la page + on ajoute dans le href(lien)?conv='. $_GET['conv'].'&page='.$i.' 
                    if($i == $currentPage):
                ?>  
                  <li><a class="pagination-link is-current"><?= $i ?></a></li>
                <?php
                  else:
                ?>
                  <li><a href="?conv=<?= $_GET['conv'] ?>&page=<?= $i ?>" class="pagination-link"><?= $i ?></a></li>
                <?php 
                  endif;
                  endfor;
                ?>

              </ul>


          </nav>


        <?php 
          else:   
        ?>
          <p>Aucun message</p>
        <?php endif;?>
      </div>
    </div>
  </div>



<?php require 'templates/foot.php'; ?>