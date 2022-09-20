<?php
@$str=$_POST["str"];
@$valider=$_POST["valider"];
$message="";
if(isset($valider)){
    if(preg_match("#^[a-zA-Z0-9]$#",$str))
    if(filter_var($str, FILTER_VALIDATE_EMAIL))
       $message="<li style='color:greem'>Chaine valide</li>";
    else
       $message="<li style='color:red'>Chaine invalide</li>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuto PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form name="fo" method="POST" action="">
        <input type="text" name="str" value="<?=$str?>"/>
        <input type="submit" name="valider" value="valider"/>
    </form>
    <div>
        <?php echo $message ?>
    </div>
</body>
</html> 


 