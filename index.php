
<?php
// lettre
$lettre = 0;
if(isset($_POST['inputPassword6'])){
    $valider=$_POST["inputPassword6"];
    if(preg_match('#[a-z]#',$valider)){
        echo 'c\'est une lettre';
        $lettre = 1;
    }
}
// chiffre
$chiffre = 0;
if(isset($_POST['inputPassword6'])){
    $valider=$_POST["inputPassword6"];
    if(preg_match('#[0-9]#',$valider)){
        echo 'c\'est un chiffre';
        $chiffre = 1;
    }
}
// majuscule
$majuscule = 0;
if(isset($_POST['inputPassword6'])){
    $valider=$_POST["inputPassword6"];
    if(preg_match('#[A-Z]#',$valider)){
        echo 'c\'est une majuscule';
        $majuscule = 1;
    }
}
// caratère special
$caractèrespecial = 0;
if(isset($_POST['inputPassword6'])){
    $valider=$_POST["inputPassword6"];
    if(preg_match('#(?=\S*[\W])#',$valider)){
        echo 'c\'est un caractère special';
        $caractèrespecial = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
     <form action="" method="POST">
        <div class="row gl-5 align-items-center">
        <div class="col-auto d-block">
            <label for="inputPassword6" class="col-form-label">Mode de passe (12 caractère):</label>
        </div>
        <div class="col-auto">
            <input type="text" name="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
        </div>
        <div class="container">
             
                <div class="progress mt-3">
                    <div class="progress">
                    <div class=" progress-bar-bg-<?php echo $color; ?>" role="progressbar" style="width: <?php echo $valeur; ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                   </div>
                </div>

        </div>
        
    </form>
    <section class="container mt-5">
            <div>
                <ul>
                <div class="list-group text-center">
                </button class="text-center">
                <li class="list-group-item list-group-item-dark">Le mot de passe doit contenir au moins</li>
                <?php if($lettre === 0){
                    echo "<button type='button' class='list-group-item list-group-item-action'>1 minuscule</button>"; 
                    $valeur =20;
                } ?>
                <?php if($chiffre === 0){
                    echo "<button type='button' class='list-group-item list-group-item-action'>1 chiffre</button>"; 
                    $valeur =20;
                } ?>
                 <?php if($majuscule === 0){
                    echo "<button type='button' class='list-group-item list-group-item-action'>1 majuscule</button>"; 
                } ?>
                  <?php if($caractèrespecial === 0){
                    echo "<button type='button' class='list-group-item list-group-item-action'>1 caractère special</button>"; 
                } ?>
          
                <button type="button" class="list-group-item list-group-item-action">12 caractères</button>
                </div>
            </ul>
            </div>
    </section>    
</body>
</html>






