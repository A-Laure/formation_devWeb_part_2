<?php
$title = "Creation Founisseurs";
$currentPage = "frnsCreate";


?>

<h1 class="text-align-center title">Création d'un Fournisseur</h1>


<section class="n-container">


<form action="" method="post" class="formCreate">

  <div class="mb-3 ">
    <label for="supplierNameId" class="form-label">Raison Sociale</label><span> *</span>
    <input type="text" name="raison sociale" id="supplierNameId" class="form-control" required > 
  </div>

  <div class="mb-3 ">
    <label for="supplierContactId" class="form-label">Contact</label>
    <input type="text" name ="contact" id="supplierContactId" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="supplierPhoneId" class="form-label">Téléphone</label>
    <input type="text" name="phone" id="supplierPhoneId" class="form-control" >
  </div>

  <div class="mb-3">
    <label for="supplierMailId" class="form-label">Email de Commande</label>
    <input type="mail" name="supplierMail" id="supplierMailId" class="form-control" >
  </div>  

  <div class="mb-3">
    <label for="supplierAdr1Id" class="form-label">N° + Voie</label><span> *</span>
    <input type="text" name="supplierAdr1" id="supplierAdr1Id" class="form-control"  required>
  </div>

  <div class="mb-3">
    <label for="supplierAdr2Id" class="form-label">Complément d'Adresse</label>
    <input type="text" name="supplierAdr2" id="supplierAdr2Id" class="form-control" >
  </div>

  <div class="mb-3">
    <label for="supplierCPId" class="form-label">Code Postal</label><span> *</span>
    <input type="text" name="supplierCP" id="supplierCPId" class="form-control"  required>
  </div>

	<div class="mb-3 ">
    <label for="spplTownId" class="form-label">Ville</label><span> *</span>
    <input type="text" name="spplTown" id="spplTownId" class="form-control"  required> 
  </div>

	<div class="mb-3 ">
    <label for="spplCountryId" class="form-label">Pays</label>
    <input type="text" name="spplCountry" id="spplCountryId" class="form-control"  required> 
  </div>

  <div class="bout-on">
	<button type="submit" class="n-btn btn-primary fs-3">Créer<?php header('Location: dashboard.php') ?></button>
  </div>	

</form>



</section>

