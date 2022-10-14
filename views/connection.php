        <section class="connectForm">
            <form method="POST">
                <legend>Connexion</legend>
                <input type="email" name="email" placeholder="Adresse mail" value="<?=$email ?? ''?>">
                <input type="password" name="password" placeholder="Mot de passe" value="<?=$password ?? ''?>">
                <button type="submit">Connexion</button>
                <a href="../inscription">Pas de compte ?</a>
                <a href="../oubli-mot-de-passe">Mot de passe oublié</a>
            </form>
        </section>
    </main>
    <script src="../../public/assets/js/script.js"></script>
</body>
</html>