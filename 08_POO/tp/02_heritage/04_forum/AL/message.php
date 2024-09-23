<?php
require_once 'config/config.php';
include_once 'functions/helpers.php';
require 'model/Message.php';
require 'model/Conversation.php';


if (!isset($_GET['id']) || empty($_GET['id'])) {
  header('Location: index.php?_err=404');
  exit;
}


try {

  $pdo = new PDO(DSN, DB_USER, DB_PWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);


  # REQUETE PREPARE | On prepare la requete avant de l'éxécuter
  if (($request = $pdo->prepare(
    'SELECT m_conversation_fk, m_contenu, DATE_FORMAT(m_date, "%d/%m/%Y") AS messageDate, m_id, DATE_FORMAT(m_date, "%H:%i:%s") AS messageHour, m_auteur_fk, u_nom, u_prenom
    FROM message
    RIGHT JOIN user ON m_auteur_fk = u_id
    WHERE m_conversation_fk = :idUrl 
    ORDER BY messageDate, messageHour'
  )) !== false) {

    if ($request->bindValue(':idUrl', $_GET['id'])) {

      # on execute la requête
      if ($request->execute()) {
        # On récupère et stocke le jeu de résultats au format tableau associatif
        $messages = $request->fetchAll(PDO::FETCH_ASSOC);

        # on termine le traitement de la requete
        $request->closeCursor();
      }
    }
  }
} catch (PDOException $e) {

  # On tue le processus (arrete la lecture du fichier) et affiche le message d'erreur
  die($e->getMessage());
}

// 
foreach($messages as $conversation){

  $conversation = new Message();
  $listConv[] = $conversation;
}

// dump($messages);

require_once 'inc/head.php';

?>



<h1 class="title">Conversation complète</h1>

<?php foreach($messages as $key => $value) : ?>

<div class="card">
  <div class="card-content">
    <div class="content">
    <p class="has-text-weight-bold">Messages de la conversation <?= $messages[$key]['m_conversation_fk'] ?> </p>
    <p><?= 'Le ' . $messages[$key]['messageDate'] . ' à ' . $messages[$key]['messageHour'] ?></p>
    <p><?= 'Auteur : ' . $messages[$key]['u_nom'] . ' ' . $messages[$key]['u_prenom']?></p>
      <!-- <p>Messages n°<?= $messages[$key]['m_id'] ?></p> -->
      <p><?= $messages[$key]['m_contenu'] ?></p>
      
    </div>
  </div>
</div>
 
<?php endforeach;?>

<?php

require_once 'inc/foot.php';

?>