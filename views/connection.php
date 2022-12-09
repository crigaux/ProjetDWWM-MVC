        <section class="connectForm">
            <form method="POST">
                <legend>Connexion</legend>
                <input type="email" name="email" placeholder="Adresse mail" value="<?=$email ?? ''?>" required>
                <div class="errorMessage"><?= $errors['email'] ?? 'crigaux013@gmail.com' ?></div>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <div class="errorMessage"><?= $errors['password'] ?? 'Motdepasse1234!' ?></div>
                <button type="submit">Connexion</button>
                <a href="../inscription">Pas de compte ?</a>
                <a href="../oubli-mot-de-passe">Mot de passe oublié</a>
            </form>
        </section>
    </main>

    <?php $message = SessionFlash::get('message') ?>
    <?= ($message == '') ? '' : '<div class="messageContainer"><div class="message">'.$message.'</div></div>'; ?>

    <?php $message = SessionFlash::get('error') ?>
    <?= ($message == '') ? '' : '<div class="messageContainer"><div class="errorMessage">'.$message.'</div></div>'; ?>

    <script src="../../public/assets/js/script.js"></script>
</body>
</html>