<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title><?= $page ?> | DwarfLand</title>
  <style>

    .is-fullheight{
      min-height: 100vh;
    }
    .fullheight{
      min-height: 100%;
    }



  </style>
</head>
<body class="has-background-light is-fullheight">
  <div class="container section">
    <?php if($page !== 'Toujours plus de nain !'): ?>
      <a href="index.php">
      <button class="button mb-5">
        <span class="icon">
        <i class="fa-solid fa-arrow-left-long"></i>
        </span>
        <span>Retour</span>
      </button>
      </a>
    <?php endif;?>

