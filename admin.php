<?php
/*$ini_datas = parse_ini_file("db.ini");
$url = $ini_datas['url'];
$login = $ini_datas['login'];
$pass = $ini_datas['pass'];


$cnx = new PDO($url, $login, $pass);
*/


$cnx = new PDO('mysql:host=localhost;dbname=sitebaptiste', 'root', '');

session_start();

$rqtText = "SELECT textIntro FROM intro";
$resText = $cnx->query($rqtText);
$text = $resText->fetch();

function remove_accent($str)
{
    $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
    $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
    return str_replace($a, $b, $str);
}

function post_slug($str)
{
    return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
        array('', '-', ''), remove_accent($str)));
}


$encrypted = password_hash('local', PASSWORD_DEFAULT);

$query = "INSERT INTO keyadmin(admin_key) VALUES(:admin_key)";

$statement = $cnx->prepare($query);

$statement->execute(array(':admin_key' => $encrypted));

$reset = "DELETE FROM keyadmin WHERE id != 1";
$resReset = $cnx->query($reset);

if (isset($_POST['admin_verif'])) {
    $query = "SELECT * FROM keyadmin";
    $statement = $cnx->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);


    if (password_verify($_POST['admin_key'], $result['admin_key'])) {
        $_SESSION['admin_key'] = $result['admin_key'];
    } else {
        var_dump("NON!");
    }
}

if (isset($_POST['submitIntro'])) {

    $textIntro = $_POST['textIntro'];
    $rqtTextIntro = "UPDATE intro SET textIntro = ? WHERE textIntro = ?";
    $resTextIntro = $cnx->prepare($rqtTextIntro);
    $resTextIntro->execute(array($textIntro, $text[0]));

    header("Refresh:0");

}

if (isset($_POST['AjouterParcours'])) {

    $rqtAdd = "INSERT INTO parcours(titreParcours, dateParcours, descParcours) VALUES(NULL, NULL, NULL)";
    $resAdd = $cnx->query($rqtAdd);

    $rqtDelId = "ALTER TABLE parcours DROP idParcours";
    $resDelId = $cnx->query($rqtDelId);

    $rqtAddId = "ALTER TABLE parcours ADD idParcours SERIAL PRIMARY KEY";
    $resAddId = $cnx->query($rqtAddId);

    header("Refresh:0");
}

if (isset($_POST['SupprimerParcours'])) {

    $rqtDel = "DELETE FROM parcours WHERE idParcours = " . $_POST['id'];
    $resDel = $cnx->query($rqtDel);

    $rqtDelId = "ALTER TABLE parcours DROP idParcours";
    $resDelId = $cnx->query($rqtDelId);

    $rqtAddId = "ALTER TABLE parcours ADD idParcours SERIAL PRIMARY KEY";
    $resAddId = $cnx->query($rqtAddId);

    header("Refresh:0");
}

if (isset($_POST['ValiderParcours'])) {

    $rqtVal = "UPDATE parcours SET titreParcours = ?, dateParcours = ?, descParcours = ? WHERE idParcours = ?";
    $resVal = $cnx->prepare($rqtVal);
    $resVal->execute(array($_POST['titre'], $_POST['date'], $_POST['description'], $_POST['id']));

    header("Refresh:0");
}

if (isset($_POST['AjouterComp'])) {
    $rqtAdd = "INSERT INTO competences(titreComp, valeurComp) VALUES(NULL, NULL)";
    $resAdd = $cnx->query($rqtAdd);

    $rqtDelId = "ALTER TABLE competences DROP idComp";
    $resDelId = $cnx->query($rqtDelId);

    $rqtAddId = "ALTER TABLE competences ADD idComp SERIAL PRIMARY KEY";
    $resAddId = $cnx->query($rqtAddId);

    header("Refresh:0");
}

if (isset($_POST['SupprimerComp'])) {

    $rqtDel = "DELETE FROM competences WHERE idComp = " . $_POST['id'];
    $resDel = $cnx->query($rqtDel);

    $rqtDelId = "ALTER TABLE competences DROP idComp";
    $resDelId = $cnx->query($rqtDelId);

    $rqtAddId = "ALTER TABLE competences ADD idComp SERIAL PRIMARY KEY";
    $resAddId = $cnx->query($rqtAddId);

    header("Refresh:0");
}

if (isset($_POST['ValiderComp'])) {

    $rqtVal = "UPDATE competences SET titreComp = ?, valeurComp = ? WHERE idComp = ?";
    $resVal = $cnx->prepare($rqtVal);
    $resVal->execute(array($_POST['titre'], $_POST['valeur'], $_POST['id']));

    header("Refresh:0");
}

if (isset($_POST['AjouterProj'])) {
    $rqtAdd = "INSERT INTO projets(titreProj, descProj, contentProj) VALUES(NULL, NULL, NULL)";
    $resAdd = $cnx->query($rqtAdd);

    $rqtDelId = "ALTER TABLE projets DROP idProj";
    $resDelId = $cnx->query($rqtDelId);

    $rqtAddId = "ALTER TABLE projets ADD idProj SERIAL PRIMARY KEY";
    $resAddId = $cnx->query($rqtAddId);

    header("Refresh:0");
}

if (isset($_POST['SupprimerProj'])) {

    $rqtDel = "DELETE FROM projets WHERE idProj = " . $_POST['idProj'];
    $resDel = $cnx->query($rqtDel);

    $rqtDelId = "ALTER TABLE projets DROP idProj";
    $resDelId = $cnx->query($rqtDelId);

    $rqtAddId = "ALTER TABLE projets ADD idProj SERIAL PRIMARY KEY";
    $resAddId = $cnx->query($rqtAddId);

    if ($_POST['titreProj'] != "") {
        unlink(post_slug($_POST['titreProj']) . '.php');
    }

    header("Refresh:0");
}

if (isset($_POST['ValiderProj'])) {

    $rqtVal = "UPDATE projets SET titreProj = ?, descProj = ? , contentProj = ? WHERE idProj = ?";
    $resVal = $cnx->prepare($rqtVal);
    $resVal->execute(array($_POST['titreProj'], $_POST['descProj'], $_POST['contentProj'], $_POST['idProj']));

    $pageProj = '
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>' . $_POST['titreProj'] . '</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Page Projet">
    <meta name="author" content="Baptiste Proust">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="animate-in">

    <div class="container">
        <div class="row">

            <!-- HEADER -->
            <div class="col-md-12">
                <div class="entete">
                    <header><h1>
                        ' . $_POST['titreProj'] . '
                    </h1></header>
                </div>
            </div>

            <!-- INTRODUCTION -->
            <div class="col-md-12">
                <div class="intro">
                        ' . $_POST['contentProj'] . '
                </div>
            </div>
        </div>
    </div>

    <div id="background">
    </div>


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/transition_out.js"></script>
    <script src="js/snow.js"></script>

</body>

</html>';

    $titleURL = post_slug($_POST['titreProj']) . '.php';

    $rqtURL = "UPDATE projets SET urlProj = ?";
    $resURL = $cnx->prepare($rqtURL);
    $resURL->execute(array($titleURL));

    $fichier = fopen($titleURL, 'w+');

    fwrite($fichier, $pageProj);

    fclose($fichier);

    header("Refresh:0");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php if (!isset($_SESSION['admin_key'])) { ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <div class="container">
            <div class="row">
                <div class="form-group col-md-12">
                    <p>Entrer la clé administrateur :</p>
                    <input type="text" class="form-control" name="admin_key">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <button type="submit" name="admin_verif" class="btn btn-success" style="float: right">Valider
                    </button>
                </div>
            </div>


    </form>
<?php } else { ?>

    <header>
        <center><h1>Pannel d'administrateur</h1></center>
    </header>
    <div class="container">
        <div class="row">

            <!-- INTRO -->
            <div class="col-md-12">
                <center><h2>Message d'intro</h2>
                    <form method='post' action='admin.php'>

                        <textarea name='textIntro' rows="10" cols="50"><?php echo "$text[0]" ?></textarea>
                        <br>
                        <input type='submit' name='submitIntro' value='Valider'>

                    </form>
                </center>
            </div>

            <!-- PARCOURS -->
            <div class="col-md-12">
                <center><h2>Parcours</h2>
                    <?php

                    $rqtTable = "SELECT * FROM parcours ORDER BY idParcours ASC";
                    $resTable = $cnx->query($rqtTable);

                    while ($table = $resTable->fetch()) {
                        $idParcours = $table['idParcours'];
                        $titreParcours = $table['titreParcours'];
                        $dateParcours = $table['dateParcours'];
                        $descParcours = $table['descParcours'];

                        echo "<div class='fiche'><form method='post' action='admin.php'>
    <br><h3>Titre</h3>
    <textarea name='titre' rows=\"1\" cols=\"20\">$titreParcours</textarea>
    <br><h3>Date</h3>
    <textarea name='date' rows=\"1\" cols=\"20\">$dateParcours</textarea>
    <br><h3>Description</h3>
    <textarea name='description' rows=\"10\" cols=\"50\">$descParcours</textarea>
    <br><h3>ID</h3>
    <textarea name='id' rows=\"1\" cols=\"1\" readonly=\"readonly\">$idParcours</textarea>
    <br>
    <input type='submit' name='ValiderParcours' value ='Valider'>
    <input type='submit' name='SupprimerParcours' value='Supprimer'>   
</form></div><br><br> ";
                    }

                    ?>

                    <form method="post" action="admin.php">
                        <input type='submit' name='AjouterParcours' value='Ajouter'>
                    </form>

                </center>
            </div>

            <!-- COMPETENCES -->
            <div class="col-md-12">
                <center><h2>Compétences</h2>
                    <?php

                    $rqtComp = "SELECT * FROM competences ORDER BY idComp ASC";
                    $resComp = $cnx->query($rqtComp);

                    while ($comp = $resComp->fetch()) {
                        $idComp = $comp['idComp'];
                        $titreComp = $comp['titreComp'];
                        $valeurComp = $comp['valeurComp'];

                        echo "<div class='fiche'><form method='post' action='admin.php'>
                    <br><h3>Titre</h3>
                    <textarea name='titre' rows=\"1\" cols=\"20\">$titreComp</textarea>
                    <br><h3>Valeur (0-100)</h3>
                    <textarea name=\"valeur\" rows=\"1\" cols=\"20\">$valeurComp</textarea>
                    <br><h3>ID</h3>
                    <textarea name='id' rows='1' cols='1'>$idComp</textarea>
                    <br>
                    <input type='submit' name='ValiderComp' value ='Valider'>
                    <input type='submit' name='SupprimerComp' value='Supprimer'> 
                    
                </form></div><br><br>";

                    }

                    ?>

                    <form method="post" action="admin.php">
                        <input type='submit' name='AjouterComp' value='Ajouter'>
                    </form>

                </center>
            </div>

            <!-- PROJETS -->
            <div class="col-md-12">
                <center><h2>Projet</h2>
                    <?php

                    $rqtProj = "SELECT * FROM projets ORDER BY idProj ASC";
                    $resProj = $cnx->query($rqtProj);

                    while ($proj = $resProj->fetch()) {
                        $idProj = $proj['idProj'];
                        $titreProj = $proj['titreProj'];
                        $descProj = $proj['descProj'];
                        $contentProj = $proj['contentProj'];

                        echo "<div class='fiche'><form method='post' action='admin.php'>
                    <br><h3>Titre</h3>
                    <textarea name='titreProj' rows=\"1\" cols=\"20\">$titreProj</textarea>
                    <br><h3>Description du projet</h3>
                    <textarea name=\"descProj\" rows=\"3\" cols=\"20\">$descProj</textarea>
                    <br><h3>Contenu</h3>
                    <textarea name='contentProj' rows='10' cols='50'>$contentProj</textarea>
                    <br><h3>ID</h3>
                    <textarea name='idProj' rows='1' cols='1'>$idProj</textarea>
                    <br>
                    <input type='submit' name='ValiderProj' value ='Valider'>
                    <input type='submit' name='SupprimerProj' value='Supprimer'> 
                    
                </form></div><br><br>";
                    }
                    ?>

                    <form method="post" action="admin.php">
                        <input type='submit' name='AjouterProj' value='Ajouter'>
                    </form>
                </center>
            </div>
        </div>
    </div>
<?php } ?>
</body>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>

