<?php 

  require_once 'config/config.php';
  require_once 'lib/autoloader.php';
  require_once 'lib/_helpers/tools.php';

  $page = 'Conversations';


  require 'templates/head.php';

  try 
  {
    
    $msgModel = new MessageModel();
    $datas = $msgModel->readAll($_GET['conv']);
    
    // debug($datas);

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
    <h1 class="title">Liste des messages de la conversation n° <?= $_GET['conv']  ?></h1>
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
          else:   
        ?>
          <p>Aucun message</p>
        <?php endif;?>
      </div>
    </div>
  </div>



<?php require 'templates/foot.php'; ?>