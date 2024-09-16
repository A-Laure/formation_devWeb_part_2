<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDO est une classe</title>
</head>
<body>

  <?php

    if(!empty($_POST)){

      /**
       * extract = fonction qui permet d'extraire les cles d'un tableau associatif et de créer des variables au nom de chaque clé en leur associant leur valeur
       * 
       * par exemple ici cela va donner : $idEmploye = $_POST['idEmploye'];
       * 
       */
      // extract($_POST);
      $idEmploye = $_POST['idEmploye'];


      try{
        // Nom des variables libres
        $dsn = 'mysql:host=localhost;dbname=entreprise;charset=utf8';
        $dbUser = 'root';
        // Sur Mac le PWD est root
        $dbPwd = '';

        # Connexion a la BDD / PDO est une classe : 3 classes (que pour les développeurs dans le code, pas d'impact en "fonctionnel"), public, private et protected =prive mais pour classe fille de la classe mère pourront accéder à celle de la mère
        # [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]) => activé par défaut seulement depuis PHP 8
        $dbh = new PDO($dsn, $dbUser, $dbPwd, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);

        # Requete que l'on veut soumettre a la BDD
        # idEmploye (nom colonne dans table) = :idEmploye (marqueur)
        $query = "SELECT * FROM employe WHERE idEmploye = :idEmploye";

        /**
         * Methode query 
         * 
         * Elle est utilisée pour soumettre une requete au serveur de la BDD
         * Elle est utile dans le cas ou l'on ne traite pas une requete avec des données soumises par une source externe ( ex: formulaire) car elle n'est pas protégé contre les injections SQL
         * 
         * elle éxécuté directement (donc pas besoin du $req->execute();)
         * 
         */

        /**
         * Methode prepare (requete préparées) 
         * 
         * Elle est utilisée pour soumettre une requete au serveur de la BDD
         * Elle est utile dans le cas ou l'on traite une requete avec des données soumises par une source externe ( ex: formulaire) car elle est protégé contre les injections SQL
         * 
         */

        # on prepare la requete / prepare = methode qui protège de l'injection par l'URL ou formulaire
        # protège d'une donnée variable en fonction user : récup données par formulaire ou url 
        # Query (+opti mais) est pareil que prepare sauf que ne protège pas de l'injection par l'URL ou formulaire
        
        if( ($req = $dbh->prepare($query)) !==false){

          # on lie les valeurs aux marqueurs, PDO::PARAM_INT s'asure que c'est un int = double sécurité
          if($req->bindValue(':idEmploye', $idEmploye, PDO::PARAM_INT)){

            # on execute la requete
            if($req->execute()){
          
              # on recupere les données / nom de la variable libre, fetch = récupérer
              # fetchAll : récupère tout de la liste
              # fetch récupère un seul élément de la liste, ici fetch car que un user en particulier
              # FETCH_ASSOC = nous renvoi un tableau associatif
              $res = $req->fetch(PDO::FETCH_ASSOC);
            }else{
              echo 'Un problème est survenu dans l\'éxecution de la requete';
            }


          }else{
            echo 'Un problème est survenu dans la préparation des valeurs';
          }
          $req->closeCursor(); // Termine le traitement de la requête 
        }else {
          echo 'Un problème est survenu dans la préparation de la requete';
        }

        echo 'Bonjour ' . $res['prenom'] . ' ' . $res['nom'];

      } catch(PDOException $e){
        // $e = instance de PDOException
        // extends = héritage (survol PDOException pour le voir)
        // catch renvoi la valeur de PDOException
        // die = equivalent à exit (exactement la même chose)
        // une méthode = une fonction qui appartient à une classe, ici getMessage() est une méthode
        die($e->getMessage());

      }
    }
  ?>


  <form method="POST" action="">
    <input type="number" name="idEmploye" placeholder="identifiant utilisateur">
    <button type="submit">Rechercher</button>
  </form>

  
</body>
</html>