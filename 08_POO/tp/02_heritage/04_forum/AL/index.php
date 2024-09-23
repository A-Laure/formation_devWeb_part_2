<?php
  require_once 'config/config.php';
  include_once 'functions/helpers.php'; 



  $converse = makeSelect('SELECT *, DATE_FORMAT(c_date, "%d/%m/%Y") AS dateConversation, DATE_FORMAT(c_date, "%H:%i:%s") AS heureConversation, count(m_id) AS nbreMessage
  FROM conversation
  JOIN message
  WHERE c_id = m_conversation_fk
  GROUP BY c_id');



require_once 'inc/head.php';

?>



  <h1 class="title">Etape 1</h1>

    <div class="columns is-multiline">    
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date de la conversation</th>
      <th scope="col">Heure de la conversation</th>
      <th scope="col">Nombre de message</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($converse as $key => $value) : ?>
    <tr class = "<?= $converse[$key]['c_termine'] == 1 ? 'opened' : 'closed' ?>">
      <td scope="row"><?=$converse[$key]['c_id'] ?></td>
      <td><?=$converse[$key]['dateConversation'] ?></td>
      <td><?=$converse[$key]['heureConversation'] ?></td>
      <td><?=$converse[$key]['nbreMessage'] ?></td>
      <td ><a href="message.php?id=<?=$converse[$key]['c_id']?>">Voir message</a>
    </td>
    </tr>
    <?php endforeach ?>
     </tbody>
</table>

  </div>


<?php

require_once 'inc/foot.php';

?>