<?php
                    session_start();

                    if (empty($_POST['mail']) ||
                        empty($_POST['password'])) {

                        $msg = "Erreur : veuillez renseigner tous les champs du formulaire.";

                    } else {

                        include '../inc/db_connect.php';

                        $sql = 'SELECT id, mail, nom, prenom, password, role ';
                        $sql .= 'FROM user ';
                        $sql .= 'WHERE mail = :mail ';

                        $params = array(
                            ':mail' => $_POST['mail'],
                        );
                        try {
                            $dbh = new PDO($dsn, $dbUser, $dbPassword);
                            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        } catch (PDOException $e) {
                            echo 'Connection error : ' . $e->getMessage();
                        }

                        try {
                            $stt = $dbh->prepare($sql);
                            $stt->execute($params);

                            if ($stt->rowCount() == 1) {

                                $user = $stt->fetch(PDO::FETCH_ASSOC);

                                if (password_verify($_POST['password'], $user['password'])) {
                                    $_SESSION['user'] = array(
                                        'id' => $user['id'],
                                        'nom' => $user['nom'],
                                        'prenom' => $user['prenom'],
                                        'role' => $user['role'],
                                    );
                                    header( 'Location: http://www.teammate.dev/?p=profil' );
                                } else { // Le mot de passe est incorrect
                                    $msg = 'Erreur : email ou mot de passe incorrects, veuillez essayer de nouveau.';
                                }
                            } else { // L'authentification a échoué
                                $msg = 'Erreur : email ou mot de passe incorrects, veuillez essayer de nouveau.';
                            }
                        } catch (PDOException $e) {
                            $msg = 'Query error : ' . $e->getMessage();
                        }
                    }
?>
<p><?php echo $msg; ?></p>
