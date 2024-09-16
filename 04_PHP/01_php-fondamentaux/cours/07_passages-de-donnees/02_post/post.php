<?php 

  include 'inc/head.php';
  include 'inc/navbar.php';
  include 'functions/_helpers/tools.php';


  $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
  $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
  $cpwd = isset($_POST['cpwd']) ? $_POST['cpwd'] : '';


  $errors = [];


  if($_POST){

    if(empty($_POST['firstname'])){
      $errors['firstname'] = "Vous n'avez pas rempli le champ prénom";
    }
    
    if(empty($_POST['lastname'])){
      $errors['lastname'] = "Vous n'avez pas rempli le champ nom";
    }


  }




?>

  <h1 class="display-1 text-center my-5">$_POST</h1>

  <h2 class="display-2 text-center my-5">Inscription</h2>

  <div class="container w-25">

    <?php if(isset($errors)) : ?>
      <?php foreach($errors as $error) : ?>
        <div class="alert alert-danger">
          <?= $error ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>


    <form method="post" action="" class="needs-validation" novalidate >

      <div class="mb-3">
        <label for="firstname" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="firstname" name="firstname" >
      </div>
      <div class="mb-3">
        <label for="lastname" class="form-label">Nom</label>
        <input type="text" class="form-control <?= isset($errors['lastname']) ? 'is-invalid' : '' ?>" id="lastname" name="lastname" required>
        <div class="invalid-feedback" id="invalidEmail"><?php $errors['lastname'] ?></div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
      <div class="mb-3">
        <label for="pwd" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="pwd" name="pwd" required>
      </div>
      <div class="mb-3">
        <label for="cpwd" class="form-label">Confirmé mdp</label>
        <input type="password" class="form-control" id="cpwd" name="cpwd" required>
      </div>

      <div class="col-md-4">
    <label for="validationCustomUsername" class="form-label">Username</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend">@</span>
      <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
      <div class="invalid-feedback">
        Please choose a username.
      </div>
    </div>
  </div>
     
      <button type="submit" class="btn btn-primary mt-3">S'inscrire</button>

    </form>



  </div>

  <?php debug($_POST); ?>

<?php include 'inc/foot.php'; ?>