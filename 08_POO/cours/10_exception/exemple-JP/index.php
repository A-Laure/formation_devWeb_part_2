<?php 



class DivisionParZeroException extends Exception {}



class Calculatrice {
    public function diviser($a, $b) {
        if ($b == 0) {
            throw new DivisionParZeroException("Division par zéro impossible");
        }
        return $a / $b;
    }
}

$calc = new Calculatrice();

try {
    echo $calc->diviser(10, 2) . "\n"; // Fonctionne normalement
    echo $calc->diviser(5, 0) . "\n";  // Lève une exception
} catch (DivisionParZeroException $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
} finally {
    echo "Opération terminée.\n";
} 