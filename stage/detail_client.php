<?php
$user = 'root';
$pass = '';
$dsn = 'mysql:host=localhost;dbname=gestiondeboutique';

try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérez les informations du client à afficher
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id_client = $_GET['id'];

        $query_info = "SELECT remarque, image_defaut FROM client WHERE id_client = :id_client";
        $stmt_info = $dbh->prepare($query_info);
        $stmt_info->bindParam(':id_client', $id_client);
        $stmt_info->execute();
        $client_info = $stmt_info->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Détail Client</title>
</head>

<body>

    <div class="content">
        <div class="container">
            <div class="row align-items-stretch no-gutters contact-wrap">
                <div class="col-md-8">
                    <div class="form h-100">
                        <h3>Détail de votre client</h3>
                        <form class="mb-5" method="post" id="contactForm" name="contactForm"
                            enctype="multipart/form-data" action="traitement.php">
                            
                            <div class="col-md-6 form-group mb-5">
                                <label for="id_client" class="col-form-label">Id Client</label>
                                <input type="text" class="form-control" name="id_client" id="id_client"
                                    value="<?php echo $id_client; ?>" readonly>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group mb-5">
                                    <label for class="col-form-label">Remarque</label>
                                    <input type="text" class="form-control" name="remarque" id="name"
                                        value="<?php echo isset($client_info['remarque']) ? $client_info['remarque'] : ''; ?>">
                                </div>

                            </div>
                            <div class="col-md-6 form-group mb-5">
                                <label for class="col-form-label">Solde Client</label>
                                <input type="text" class="form-control" name="solde" id="solde"
                                    placeholder="Your solde">
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="submit" value="Enregistrer"
                                        class="btn btn-primary rounded-0 py-2 px-4">
                                    <span class="submitting"></span>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-md-4" style="background: #FAE8C4;">
                    <div class="contact-info h-100">
                        <h3 style="color: black;">composants à changer</h3>
                        <ul class="list-unstyled">
                            <li>
                                <p style="color: black;">Image de défaut :</p>
                                <?php
                                if (isset($client_info['image_defaut'])) {
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($client_info['image_defaut']) . '" alt="Image" width="150" height="100">';
                                }
                                ?>
                            </li>
                            <li>
                                <p style="color: black;">Image de nouveau composant :</p>

                                <input type="file" class="form-control-file" name="nouvelle_image" accept="image/*" style="color: black;">


                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>