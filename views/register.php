<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/7194bdd5cb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../public/assets/css/mobile.css">
    <link rel="stylesheet" href="../public/assets/css/desktop.css">
    <title>L'annexe</title>
</head>
<body>
    <main>
        <div class="overlayMenuBurger">
            <div class="overlay">
                <div class="overlayMenuContent">
                    <div class="topContainer">
                        <img class="close" src="../public/assets/img/close.svg" alt="">
                    </div>
                    <div class="menuLinks">
                        <a href="../accueil"><h3>Home</h3></a>
                        <a href="../menu"><h3>Menu</h3></a>
                        <a href="../commentaires"><h3>Commentaires</h3></a>
                        <a href="../commentaires"><h3>Galerie</h3></a>
                        <div class="connect">
                            <a href="../connexion"><h3>Connexion</h3></a>
                            <a href="../inscription"><h3>Inscription</h3></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header class="connectHeader">

            <!-- Barre de navigation -->

            <nav>
                <a href="../controllers/homeController.php#reservation"><button>Réservation</button></a>
                <div class="burgerMenuIcon">
                    <div class="menu">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"> </div>
                    </div>
                </div>
                <div class="menuLinksDesktop">
                    <a href="../accueil"><h3>Home</h3></a>
                    <a href="../menu"><h3>Menu</h3></a>
                    <a href="../commentaires"><h3>Commentaires</h3></a>
                    <a href="../commentaires"><h3>Galerie</h3></a>
                    <div class="connect">
                        <a href="../connexion"><button>Connexion</button></a>
                        <!-- <a href="../inscription"><button>Inscription</button></a> -->
                    </div>
                </div>
            </nav>

        </header>

        <section class="inscriptionForm">
            <form method="POST" action="">
                <legend>Inscription</legend>
                <input type="text" name="name" placeholder="Nom*" value="<?=$name ?? ''?>">
                <div class="errorMessage"><?= $errors['name'] ?? '' ?></div>
                <input type="text" name="firstname" placeholder="Prénom*" value="<?=$firstname ?? ''?>">
                <div class="errorMessage"><?= $errors['firstname'] ?? '' ?></div>
                <input type="email" name="email" placeholder="Adresse mail*" value="<?=$email ?? ''?>">
                <div class="errorMessage"><?= $errors['email'] ?? '' ?></div>
                <input type="password" id="password" name="password" placeholder="Mot de passe*" value="<?=$password ?? ''?>">
                <div class="errorMessage"><?= $errors['password'] ?? '' ?></div>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmation*" value="<?=$confirmPassword ?? ''?>">
                <div class="errorMessage"><?= $errors['confirmPassword'] ?? '' ?></div>
                <fieldset>
                    <input type="checkbox" name="cgu" class="checkbox" id="cgu" value="1" value="<?=$cgu ?? ''?>">
                    <label for="cgu">CGU*</label>
                </fieldset>
                <div class="errorMessage"><?= $errors['cgu'] ?? '' ?></div>
                <!-- <fieldset>
                    <input type="checkbox" class="checkbox">
                    <span>CGU</span>
                </fieldset> -->
                <button type="submit">Inscription</button>
                <a href="../connexion">Déjà inscrit ?</a>
            </form>
            
            <!-- Message d'erreur si le mot de passe ne correspond pas aux prérequis  -->
            <div class="passwordRequires">
                <div class="passwordLength">8 caractères minimum</div>
                <div class="passwordUpper">1 majuscule</div>
                <div class="passwordNumber">1 chiffre</div>
                <div class="passwordSpecial">1 caractère spécial</div>
            </div>
        </section>
    </main>
    <script src="../../public/assets/js/script.js"></script>
    <script src="../../public/assets/js/pwdTest.js"></script>
</body>
</html>