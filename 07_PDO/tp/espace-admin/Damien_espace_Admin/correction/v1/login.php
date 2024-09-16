<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | AdminO3W</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body class="bg-body-secondary">

    

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="w-50">

            <?php 
                if(isset($_GET['_err'])){
                    switch($_GET['_err']){

                        case '401':
                            echo '<div class="alert alert-warning" role="alert">Vous devez vous connecter!</div>';
                            break;
                        case 'empty':
                            switch($_GET['field']){
                                case 'login':
                                    echo '<div class="alert alert-warning" role="alert">Vous devez saisir un login !</div>';
                                    break;    
                                case 'pwd':
                                    echo '<div class="alert alert-warning" role="alert">Vous devez saisir un mot de passe !</div>';
                                    break;    
                                default:
                                    echo '<div class="alert alert-warning" role="alert">Vous devez remplir tous les champs !</div>';
                                    break;    
                            }
                            break;    
                        case 'connect':
                            echo '<div class="alert alert-warning" role="alert">Mauvais login ou mot de passe</div>';
                            break;
                    }
                }
            ?>

            <div class="">
                <div class="card p-4 ">
                    <h1 class="p-2" >Connexion</h1>
                    <form action="admin/processing.php" method="post">
                        <div class="mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" name="login" class="form-control" id="login">
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Mot de passe</label>
                            <input type="password" name="pwd" class="form-control" id="pwd">
                        </div>
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>