<?php 
  $page = 'Conversations';
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

        <div class="field">
          <div class="select">
            <select name="orderBy" >
              <option <?= $orderBy == 'id' ? 'selected' : '' ?> value="id">Id</option>
              <option <?= $orderBy == 'date' ? 'selected' : '' ?> value="date">Date</option>
              <option <?= $orderBy == 'author' ? 'selected' : '' ?> value="author">Auteur</option>
            </select>
            </div>
        </div>

        <div class="field">
          <div class="select">
            <select name="order" >
              <option <?= $order == 'ASC' ? 'selected' : '' ?> value="ASC">Croissant</option>
              <option <?= $order == 'DESC' ? 'selected' : '' ?> value="DESC">Décroissant</option>
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
                <th><a href="?ctrl=message&action=index&conv=<?= $_GET['conv']?>&pagination=<?= $pagination ?>&orderBy=id&order=<?= $order === 'ASC' ? 'DESC' : 'ASC' ?>">id</a></th>
                <th><a href="?ctrl=message&action=index&conv=<?= $_GET['conv']?>&pagination=<?= $pagination ?>&orderBy=date&order=<?= $order === 'ASC' ? 'DESC' : 'ASC' ?>">Date</a></th>
                <th>Heure</th>
                <th><a href="?ctrl=message&action=index&conv=<?= $_GET['conv']?>&pagination=<?= $pagination ?>&orderBy=author&order=<?= $order === 'ASC' ? 'DESC' : 'ASC' ?>">Auteur</a></th>
                <th>Message</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($messages as $msg): ?>
              <tr>
                <td><?= $msg->getId() ?></td>
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
              <a <?= ($currentPage > 1) ? 'href="?ctrl=message&action=index&conv='. $_GET['conv'] .'&page='. $currentPage-1 .'"' : '' ?> class="pagination-previous" <?= ($currentPage > 1) ? '' : 'disabled' ?> >Page précedente</a>

              <a <?= ($currentPage < $totalPages) ? 'href="?ctrl=message&action=index&conv='. $_GET['conv'] .'&page='. $currentPage+1 .'"' : '' ?> class="pagination-next" <?= ($currentPage < $totalPages) ? '' : 'disabled' ?>  >Page suivante</a>
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
                  <li><a href="?ctrl=message&action=index&conv=<?= $_GET['conv'] ?>&page=<?= $i ?>" class="pagination-link"><?= $i ?></a></li>
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

