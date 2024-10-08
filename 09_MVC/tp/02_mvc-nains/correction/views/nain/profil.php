<h1 class="title has-text-centered">Fiche de <?= $nain->getNom()?> </h1>

<div class="columns is-centered">

  <div class="column is-half">
    <div class="card">
      <header class="card-header">
          <p class="card-header-title"><?= $nain->getNom() ?></p>
      </header>
      <div class="card-content">
        <div class="content">

          <p>Le nain <?= $nain->getNom()?> a une longueur de barbe de <?= $nain->getBarbe()?> cm</p>
          <p>Originaire de <a href="ville.php?id=<?= $nain->getVille()?>"> <?= $nain->getNatale()?></a></p>

          <?php if($nain->getGroupe()) : ?>

            <?php if($nain->getTaverne()) : ?>
              <p>Bois dans la taverne <a href="taverne.php?id=<?= $nain->getTaverne()?>"> <?= $nain->getTaverneNom()?></a></p>
            <?php endif; ?>

            <?php if($nain->getTaverne()) : ?>
              <p>Travaille de <?= $nain->getDebuttravail() ?> à <?= $nain->getFintravail() ?> dans le tunnel reliant <a href="ville.php?id=<?= $nain->getVilledepart()?>"><?= $nain->getDepart() ?></a> à  <a href="ville.php?id=<?= $nain->getVillearrivee() ?>"><?= $nain->getArrivee() ?></a></p>
            <?php endif; ?>

            <p>Membre du groupe n°<a href="groupe.php?id=<?= $nain->getGroupe()?>"> <?= $nain->getGroupe()?></a> </p>          


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
              <option value="" <?= !$nain->getGroupe() ? 'selected' : '' ?> >Aucun</option>
              <?php foreach($groupes as $groupe) : ?>
                <option value="<?= $groupe->getId()?>" <?= $nain->getGroupe() == $groupe->getId() ? 'selected' : '' ?> ><?= $groupe->getId()?></option>
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