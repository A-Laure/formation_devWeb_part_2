<?php

class DisplayModel extends CoreModel
{
    public function getLinksByUserId($id)
{
    try {
        $query = 'SELECT netw_networkId, netw_networkLink FROM display WHERE user_userId = :userId';
        $stmt = $this->getDb()->prepare($query);  

        if ($stmt !== false) {
            $stmt->bindValue(':userId', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $links = []; 

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Crée un nouvel objet Display pour chaque ligne récupérée
                    $display = new Display();
                    $display->setUserId($id); 
                    $display->setNetworkId($row['netw_networkId']); 
                    $display->setNetworkLink($row['netw_networkLink']); 
                    
                    $links[] = $display; // Ajoute l'objet à la liste des liens
                }

                return $links; 
            } else {
                echo "Aucune donnée trouvée pour l'utilisateur avec l'ID $id.";
            }
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

}

