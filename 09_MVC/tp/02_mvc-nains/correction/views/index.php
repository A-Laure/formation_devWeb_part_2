

<h1 class="title">Bienvenue à DwarfLand pays des nains ! </h1>
  <h2 class="subtitle">Et de la boisson ! </h2>

  <div class="columns is-multiline">


  <!-- DEBUT NAINS -->
  <div class="column is-half">
    <div class="card ">
      <header class="card-header">
        <p class="card-header-title">NAINS</p>
      </header>
      <div class="card-content">
        <div class="content">
          <form method="POST" action="index.php?ctrl=nain&action=show">
            <div class="field has-addons">
              <div class="control is-expanded">
                <div class="select is-fullwidth">
                  <select name="id">
                    <?php foreach($nains as $nain) : ?>
                      <option value="<?= $nain->getId()?>"><?= $nain->getNom() ?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="control">
                <button class="button is-dark">Voir ce nain</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- FIN NAINS -->
  <!-- DEBUT VILLES -->
  <div class="column is-half">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">VILLES</p>
      </header>
      <div class="card-content">
        <div class="content">
          <form method="GET" action="ville.php">
            <div class="field has-addons">
              <div class="control is-expanded">
                <div class="select is-fullwidth">
                  <select name="id">
                  <?php foreach($villes as $ville) : ?>
                    <option value="<?= $ville->getId()?>"><?= $ville->getNom()?></option>
                  <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="control">
                <button class="button is-dark">Voir cette ville</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- FIN VILLES -->
  <!-- DEBUT TAVERNES -->
  <div class="column is-half">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">TAVERNES</p>
      </header>
      <div class="card-content">
        <div class="content">
          <form method="GET" action="taverne.php">
            <div class="field has-addons">
              <div class="control is-expanded">
                <div class="select is-fullwidth">
                  <select name="id">
                    <?php foreach($tavernes as $taverne) : ?>
                      <option value="<?= $taverne->getId()?>"><?= $taverne->getNom()?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="control">
                <button class="button is-dark">Voir cette taverne</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- FIN TAVERNES -->
  <!-- DEBUT GROUPES -->
  <div class="column is-half">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">GROUPES</p>
      </header>
      <div class="card-content">
        <div class="content">
          <form method="GET" action="groupe.php">
            <div class="field has-addons">
              <div class="control is-expanded">
                <div class="select is-fullwidth">
                  <select name="id">
                    <?php foreach($groupes as $groupe) : ?>
                      <option value="<?= $groupe->getId()?>"><?= $groupe->getId()?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <div class="control">
                <button class="button is-dark">Voir ce groupe</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- FIN GROUPES -->


  </div>



  </div>
