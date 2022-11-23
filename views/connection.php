        <section class="connectForm">
            <form method="POST">
                <legend>Connexion</legend>
                <input type="email" name="email" placeholder="Adresse mail" value="<?=$email ?? ''?>" required>
                <div class="errorMessage"><?= $errors['email'] ?? '' ?></div>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <div class="errorMessage"><?= $errors['password'] ?? '' ?></div>
                <button type="submit">Connexion</button>
                <a href="../inscription">Pas de compte ?</a>
                <a href="../oubli-mot-de-passe">Mot de passe oublié</a>
            </form>
        </section>
    </main>
    <script src="../../public/assets/js/script.js"></script>
</body>
</html>