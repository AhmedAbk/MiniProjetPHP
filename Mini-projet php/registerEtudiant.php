<?php
    ob_start();
    session_start();
    $pageTitle = 'Registeration';
    include 'init.php';
    $enseignantDB = new C_enseignant();
    $etudiantDB = new C_etudiant();
    $database = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<h1 class="text-center mb-5 mt-4">ster Etudiant</h1>';

    echo '<div class="container mt-3">';
    $name = $_POST['name'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['datenaissance'];
    $class = $_POST['class'];
    $inscription = $_POST['inscription'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    $formErrors = array();

    

        if ($check == 1) {
            echo "<div class='alert alert-success'>Etudiant with the same Prenom already exists in the database.</div>";
        } else {
            // Insert a new etudiant
            $insertResult = $etudiantDB->addEtudiant(
                $name,
                $prenom,
                $dateNaissance,
                $class,
                $inscription,
                $address,
                $email,
                $tel
            );

            if ($insertResult > 0) {
               
                $userId = $_SESSION['uid'];



                $database->updateUserRoleId($userId, $insertResult);

                $_SESSION['verified'] = true;
            

                echo '<div class="alert mb-3 alert-success">Etudiant added successfully!</div>';
            } else {
                echo '<div class="alert alert-danger">Error inserting etudiant record.</div>';
            }
        }
        }
    }

echo '</>';
?>
<?php
    include $tpl . "footer.php";
    ob_end_flush();
?>
