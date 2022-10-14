        <footer>
            <div class="whiteBrushTop"></div>
            <a href="#"><h2>L'annexe</h2></a>
            <div class="contact">
                <a href="#" class="adressContact">12 rue de la Paix 80000 Amiens</a>
                <a href="#" class="phoneContact">03 12 34 56 78</a>
                <a href="#" class="mailContact">contact@contact.fr</a>
            </div>
            <div class="social">
                <a href="#"><img src="../../public/assets/img/instagram.svg" alt="Logo Instagram"></a>
                <a href="#"><img src="../../public/assets/img/facebook.svg" alt="Logo Facebook"></a>
            </div>
            <div class="legal">
                <div>Copyright © <?=date('Y', time())?> L'annexe. Tous droits réservés.</div>
            </div>
        </footer>
    </main>
    <script src="../../public/assets/js/script.js"></script>
    <?= (!empty($isOnHome)) ? '<script src="../../public/assets/js/menu.js"></script>' : '' ; ?>
    <script src="../../public/assets/js/activeLinksMenu.js"></script>
</body>
</html>