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
                    <input type="checkbox" name="cgu" class="checkbox" value="1" value="<?=$cgu ?? ''?>">
                    <label><a href="">CGU*</a></label>
                </fieldset>
                <div class="errorMessage"><?= $errors['cgu'] ?? '' ?></div>
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