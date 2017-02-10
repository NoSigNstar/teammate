<?php
    if (empty($_POST['pseudo']) ||
        empty($_POST['commentaire']) ||
        empty($_FILES['avatar'])){

        $msg = "Erreur : veuillez renseigner tous les champs du formulaire.";

    }else{
        print_r($_FILES['avatar']);
        // Vérification de l'upload correct du fichier
        $uploadSucceed = is_uploaded_file($_FILES['avatar']['tmp_name']);
        if ($uploadSucceed == true) {

            // Copie du fichier dans le répertoire 'couvertures'
            $tmpFilename = uniqid() . ".jpg";

            $uploadSucceed = copy($_FILES['avatar']['tmp_name'], "../../../media/avatar" . $tmpFilename);
            if ($uploadSucceed == true) {
                try {
                    $stt = $dbh->prepare($sql);
                    $stt->execute($sql);

                    if ($stt->rowCount() == 1) {
                        $avatar_id = $dbh->lastInsertId();

                        $prevFilename = '../../../media/avatar' . $tmpFilename;
                        $finalFilename = '../../../media/avatar' . $avatar_id . '.jpg';

                        $resizedWidth = 50;
                        $image = imagecreatefromjpeg($prevFilename);
                        $width = imagesx($image);
                        $height = imagesy($image);

                        $resizedHeight = 50;

                        $resizedImage = imagecreatetruecolor($resizedWidth, $resizedHeight);
                        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $resizedWidth, $resizedHeight, $width, $height);

                        imagejpeg($resizedImage, $finalFilename);

                        unlink($prevFilename);

                        $sql = 'INSERT INTO livre (speudo, description, avatar) ';
                        $sql .= 'VALUES (:speudo, :description, :avatar_id) ';

                        $params = array(
                            ':speudo' => $_POST['speudo'],
                            ':description' => $_POST['description'],
                            ':avatar_id' => $avatar_id,
                        );

                        try {
                            $stt = $dbh->prepare($sql);
                            $stt->execute($params);
                        } catch (PDOException $e) {
                            echo 'Query error : ' . $e->getMessage();
                        }

                        if ($stt->rowCount() == 1) {
                            $msg = "Le profil a bien été enregistré.";
                            header( 'Location: http://www.teammate.dev/?p=profil' );
                        } else {
                            $msg = "Une erreur est survenue au moment de l'enregistrement du profil.01";
                        }


                    } else {
                        $msg = "Une erreur est survenue au moment de l'enregistrement de l'avatar du profil.02";
                    }
                } catch (PDOException $e) {
                    echo 'Query error : ' . $e->getMessage();
                }
            } else {
                $msg = "Une erreur est survenue au moment de l'enregistrement de l'avatar du profil.03";
            }
        } else {
            $msg = "Une erreur est survenue au moment de l'enregistrement de l'avatar du profil.04";
        }
    }
?>
<p><?php echo $msg; ?></p>
