<?php

class ConversationController
{
  public function index()
  {

    try {

      $convModel = new ConversationModel();
      $datas = $convModel->readAll();

      foreach ($datas as $data) {
        $conversations[] = new Conversation($data);
      }

      include 'views/index.php';
    } catch (Exception $e) {
      throw new Exception($e->getMessage(), $e->getCode(), $e);
    }
  }
}
