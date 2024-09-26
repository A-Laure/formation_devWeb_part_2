<?php 

  require_once 'config/config.php';
  require_once 'lib/autoloader.php';
  require_once 'lib/_helpers/tools.php';

  $page = 'Conversations';


  require 'templates/head.php';



  $convModel = new ConversationModel();
  $datas = $convModel->readAll();
  
  // debug($datas);

  foreach($datas as $data)
  {
    $conversations[] = new Conversation($data);
  }

  // debug($conversations);


?>


  <div class="section">
    <h1 class="title">Liste des conversations</h1>
    <div class="card is-shadowless">
      <div class="card-content">
        <?php if(!empty($conversations)): ?>
          <table class="table is-hoverable is-fullwidth">
            <thead>
              <tr>
                <th>Id Conv</th>
                <th>Date Conv</th>
                <th>Heure Conv</th>
                <th>Nb Messages Conv</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($conversations as $conv): ?>
              <tr class="<?= ( !$conv->getStatus() ? '' : 'has-background-danger')?> ">
                <th><?= $conv->getId() ?></th>
                <td><?= $conv->getDate() ?></td>
                <td><?= $conv->getHour() ?></td>
                <td><?= $conv->getNbMsg() ?></td>
                <td><a href="messages.php?conv=<?= $conv->getId()?>" class="button is-dark is-small">Voir messages</a></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>


        <?php 
          else:   
        ?>
          <p>Aucunes conversations</p>
        <?php endif;?>
      </div>
    </div>
  </div>



<?php require 'templates/foot.php'; ?>