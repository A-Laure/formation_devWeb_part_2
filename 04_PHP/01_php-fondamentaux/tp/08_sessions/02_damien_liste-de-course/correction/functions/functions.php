<?php



  /**
   * addToList : Permet d'ajouter un produit (article et quantité) dans  $_SESSION['shop']['shopList'] (avec un passage par référence, cf: &)
   * @param string $article
   * @param int $quantity
   * @param array &$shopList
   * @return void
   */
  function addToList(string $article, int $quantity, array &$shopList){
    # on parcours le tableau 
    foreach($shopList as $index => $product){
      # si l'élément parcourru est égale a la valeur de $article 
      if($article === $product['article']){
        # alors on ajoute la quantité a l'élément deja existant
        $shopList[$index]['quantity'] += $quantity;

        # si un utilisateur rentre une valeur négative pour soustraire des éléments et quelle donne un quatité
        # inferieur a 1 alors on supprime lélément de la liste 
        if($product['quantity'] < 1){
          print_r($product);
          unset($shopList[$index]);
        }
        # on met un return pour stopper la fonction
        return;
      }
    }

    # si le produit n'existe pas alors on l'ajoute à la fin du tableau
    $shopList[] = [
      'article' => $article,
      'quantity' => $quantity,
    ];
}

  /**
 * addToList : Permet de supprimer un ou plusieurs produit (article et quantité) dans  $_SESSION['shop']['shopList'] (avec un passage par référence, cf: &)
 * @param array $eleteArticles
 * @param array &$shopList
 * @return void
 */
function deleteToList(array $deleteArticles, array &$shopList){

  foreach($deleteArticles as $deleteArticle){

    foreach($shopList as $index => $product){

      if($deleteArticle === $product['article']){
        unset($shopList[$index]);
      }

    }

  }

}
