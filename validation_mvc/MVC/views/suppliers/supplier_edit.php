<?php


?>


<h1 class="text-align-center title">Modification / Suppression d'un Fournisseur</h1>

<button type="submit" class="btn-delete btn-primary edit-btn m-l-60 fs-3 ">Supprimer</button>

<section class="itemCreate supplier ">



<!-- FORM LEFT -->

<form action="" method="get" class="">

  <div class="mb-3 ">
    <label for="supplierNameId" class="form-label">Raison Sociale</label>
    <input type="text" name="raison sociale" id="supplierNameId" class="form-control" placeholder="<?PHP echo$suppliers[0]['spplName']
     ?>" > 
  </div>

  <div class="mb-3 ">
    <label for="supplierContactId" class="form-label">Contact</label>
    <input type="text" name ="contact" id="supplierContactId" class="form-control" placeholder="<?PHP echo $suppliers[0]['spplContact'] ?> ">
  </div>

  <div class="mb-3">
    <label for="supplierPhoneId" class="form-label">Téléphone</label>
    <input type="text" name="phone" id="supplierPhoneId" class="form-control" placeholder="<?PHP echo $suppliers[0]['spplPhone'] ?> ">
  </div>

  <div class="mb-3">
    <label for="supplierMailId" class="form-label">Email de Commande</label>
    <input type="mail" name="supplierMail" id="supplierMailId" class="form-control" placeholder="<?PHP echo $suppliers[0]['spplMail'] ?> ">
  </div>

  <div class="bout-on">
	<button type="submit" class="btn btn-primary fs-3">Modifier</button>
  </div>

</form>

<!-- FORM RIGHT -->

<form action="" methode="get" class=""> 

  <div class="mb-3">
    <label for="supplierAdr1Id" class="form-label">N° + Voie</label>
    <input type="text" name="supplierAdr1" id="supplierAdr1Id" class="form-control" placeholder="<?PHP echo $suppliers[0]['spplAdr1'] ?>" >
  </div>

  <div class="mb-3">
    <label for="supplierAdr2Id" class="form-label">Complément d'Adresse</label>
    <input type="text" name="supplierAdr2" id="supplierAdr2Id" class="form-control" placeholder="<?PHP echo $suppliers[0]['spplAdr2'] ?>">
  </div>

  <div class="mb-3">
    <label for="supplierCPId" class="form-label">Code Postal</label>
    <input type="text" name="supplierCP" id="supplierCPId" class="form-control" placeholder="<?PHP echo $suppliers[0]['spplCp'] ?>" >
  </div>

	<div class="mb-3 ">
    <label for="spplTownId" class="form-label">Ville</label>
    <input type="text" name="spplTown" id="spplTownId" class="form-control" 
    placeholder="<?PHP echo $suppliers[0]['spplTown'] ?>" > 
  </div>

	<div class="mb-3 ">
    <label for="spplCountryId" class="form-label">Pays</label>
    <input type="text" name="spplCountry" id="spplCountryId" class="form-control"  placeholder="<?PHP echo $suppliers[0]['spplCountry'] ?>" > 
  </div>

	

</form>




</section>

