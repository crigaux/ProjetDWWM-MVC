        <section class="connectForm forgotPwd">
            <form method="POST">
                <legend>Mot de passe oublié</legend>
                <input type="email" name="email" placeholder="Adresse mail" value="<?=$email ?? ''?>">
                <button type="submit">Nouveau mot de passe</button>
                <a href="../connexion">Connexion</a>
            </form>
        </section>
    </main>
    <script src="../../public/assets/js/script.js"></script>
</body>
</html>