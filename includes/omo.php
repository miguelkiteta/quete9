<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>    
<body>
    <?php include 'includes/header.php'; ?>


    <div class="container-fluid">
        <div class="row">
            <div class="col-5">
                <?php
                if(empty($_SESSION['aymeric'])){
                    echo '<a href="index.php"><button type="button" class="btn btn-outline-dark btn-block">Home</button></a>';
                }
                else{
                    echo '<a href="index.php?action"><button type="button" class="btn btn-outline-dark btn-block">Home</button></a>';
                }
                ?>                
            </div>
            
            <?php
            if(isset($_GET['data'])){
                // Form col-7
                include 'includes/form.php';
            }
            

            if (!isset($_GET['action'])){
                if(!isset($_GET['action']) && empty($_SESSION['aymeric']) && !isset($_GET['data'])){
                echo '<div class="col-4"><a href="index.php?data"><button type="button" class="btn btn-dark btn-block">Ajouter des données</button></a></div>';
                }
            }
            //POST Form
            if(isset($_POST['submit'])){

                function alert($var){
                    return '<div class="col-12 mt-3 text-center alert alert-dark" role="alert">' . $var . '</div>';
                }
                //Secure
                if(empty($_POST['first_name'])){
                    echo alert('Saisis un Prénom');
                }
                if(empty($_POST['last_name'])){
                    echo alert('Saisis un Nom');
                }
                if(empty($_POST['age'])){
                    echo alert('Saisis un Age');
                }
                if(empty($_POST['size'])){
                    echo alert('Saisis une Taille');
                }
                if(empty($_POST['situation'])){
                    echo alert('Saisis une Situation');
                }
                if ($_FILES['file']['error'] == 4){
                    echo alert('Fichier non envoyé');
                }
                if ($_FILES['file']['size'] >= 1000000){
                    echo alert('Fichier trop lourd');
                }

                
                //$_files existe && $_Files est bien envoyé
                if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){

                    // $_files taille est inférieur ou égale
                    if ($_FILES['file']['size'] <= 1000000){
                        // pathinfo renvoi un tableau avec ['dirname']['basename']['extension']['filename'] du file
                        $file = pathinfo($_FILES['file']['name']);
                        $extension = $file['extension'];
                        $extensionOk = ['jpg','png','jpeg'];

                        // in_array compare les 2 tableaux
                        if(in_array($extension,$extensionOk)){

                            // basename extrait uniquement le nom du fichier
                            // move_uploaded_file déplace un fichier téléchargé vers une nouvelle destination
                            $fileName = 'public/images/' . basename($_FILES['file']['name']);
                            move_uploaded_file($_FILES['file']['tmp_name'], $fileName);
                            rename($fileName,'public/images/' . $_POST['first_name'] . $_FILES["file"]["name"]);

                            //session On
                            $_SESSION['aymeric'] = [
                                'first_name' => $_POST['first_name'],
                                'last_name' => $_POST['last_name'],
                                'age' => $_POST['age'],
                                'size' => $_POST['size'],
                                'situation' => $_POST['situation'],
                                'file' => $_FILES['file']
                            ];
                            echo '<div class="col-12 mt-3 text-center alert alert-dark" role="alert">La session a étais créé </div>';
                        }
                        else{
                            echo '<div class="col-12 mt-3 text-center alert alert-dark" role="alert">Extension du fichier non accepté</div>';
                        }
                    }
                }
            }?>
        </div>
    </div> 

    <?php
    if(isset($_GET['action']) && !isset($_GET['data']) && isset($_SESSION['aymeric'])){ ?>
        <div class="container-fluid">
            <div class="row">
                
                <?php include 'includes/nav.php';

                if(isset($_GET['action'])){
                    if($_GET['action'] === 'debug'){
                        echo "<pre>";
                        print_r($_SESSION['aymeric']);
                        echo "</pre>";
                    }
                    if($_GET['action'] === 'conca'){?>

                        <div class="col-6">
                            <h2>Concaténation</h2>
                            
                            <p>Construction d'une phrase avec les données du tableau</p>
                            <h3><?= $_SESSION['aymeric']['first_name'] . ' ' . $_SESSION['aymeric']['last_name']; ?></h3>
                            <p><?= $_SESSION['aymeric']['age'] ?>ans, je mesure <?= $_SESSION['aymeric']['size']; ?>m et je fais partie des <?= $_SESSION['aymeric']['situation']?> de AFCI</p>

                            <p>Construction d'une phrase avec la maj du tableau</p>
                            <h3><?= $_SESSION['aymeric']['first_name'] . ' ' . strtoupper($_SESSION['aymeric']['last_name']); ?></h3>
                            <p><?= $_SESSION['aymeric']['age'] ?>ans, je mesure <?= $_SESSION['aymeric']['size']; ?>m et je fais partie des <?= $_SESSION['aymeric']['situation']?> de AFCI</p>

                            <p>Affichage d'une virgule à la place d'un point</p>
                            <h3><?= $_SESSION['aymeric']['first_name'] . ' ' . strtoupper($_SESSION['aymeric']['last_name']); ?></h3>
                            <p><?= $_SESSION['aymeric']['age'] ?>ans, je mesure <?= str_replace('.',',',$_SESSION['aymeric']['size']); ?>m et je fais partie des <?= $_SESSION['aymeric']['situation']?> de AFCI</p>
                        </div>

                    <?php 
                    }
                    if($_GET['action'] === 'loop'){
                        echo 'Boucle: </br>';
                        for($i = 0; $i <= 10; $i++){
                            echo 'Je m\'appelle ' .  $_SESSION['aymeric']['first_name'] . $_SESSION['aymeric']['last_name'] . ', j\'ai ' . $_SESSION['aymeric']['age'] . ' ans et je mesure ' . $_SESSION['aymeric']['size'] . '</br>';
                        }
                    }
                    if($_GET['action'] === 'function'){
                        function session(){
                            foreach($_SESSION['aymeric'] as $key => $value){
                                echo 'Cette ligne correspond à la clé: ' . $key . ' et contient: ' . $value . '</br>';
                            }
                        }
                        session();
                    }
                    if($_GET['action'] === 'destroy'){
                        //session Off
                        echo '<div>session destroy..</div>';
                        session_destroy();  
                    }
                }
                ?>

            </div>
        </div>

        <?php
        }

        include 'includes/footer.php'; ?>
</body>
</html>