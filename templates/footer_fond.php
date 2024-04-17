    <div class="container">
        <footer>
            <div class="d-md-flex d-sm-block flex-wrap justify-content-between align-items-center py-4 border-top justify-content-center">
                <div class="col-md-4 d-md-flex d-sm-block align-items-center">
                    <div class="ms-3">
                        <a class="text-body-secondary" href="#" id="privacy-policy-link">Politique de confidentialité</a>
                    </div>
                    <div class="ms-3 ">
                        <?php if (isset($_SESSION["user"])) : ?>
                            <a href="logout.php" class="nav-link">Déconnexion</a>
                        <?php else : ?>
                            <a href="login.php" class="nav-link">Espace Pro</a>
                        <?php endif; ?>
                    </div>
                </div>

                <ul class="nav col-md-4 justify-content-end list-unstyled align-items-center m-3">
                    <li class="ms-3 text-center"><a class="text-body-secondary" href="https://open.spotify.com/intl-fr/artist/7L70NlXQPcsZrGWo2SCE9G"><img src="assets/images/spotify.png" alt="Spotify" width="24"></a></li>
                    <li class="ms-3 text-center"><a class="text-body-secondary" href="https://on.soundcloud.com/S4mfY"><img src="assets/images/soundCloud.png" alt="Souncloud" width="24"></a></li>
                    <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.youtube.com/results?search_query=djpak"><img src="assets/images/youtube.png" alt="YouTube" width="24"></a></li>
                    <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.tiktok.com/@djpakafro?_t=8lPlQKN5Pay&_r=1"><img src="assets/images/tiktok.png" alt="TikTok" width="26"></a></li>
                    <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.instagram.com/djpakafro/"><img src="assets/images/instagram.jpg" alt="Instagram" width="34"></a></li>
                </ul>
            </div>
            <div class="text-center">
                <img src="assets/images/logo.png" alt="Votre Logo" class="mb-3 me-2 mb-md-0" width="40">
                <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 DJPAK</span>
            </div>
        </footer>
    </div>
</div>
<!-- Contenu de la politique de confidentialité -->
<div id="privacy-policy-popup">
    <h2>Votre politique de confidentialité </h2>
    <div class="overflow-auto" style="max-height: 300px;">
        <p> Dernière mise à jour : 10/2023
            
            Lorsque vous utilisez notre formulaire de contact pour demander des informations sur une voiture d'occasion spécifique, nous collectons les informations que vous fournissez volontairement, telles que votre nom, votre adresse e-mail et votre numéro de téléphone.
            Finalité de la collecte :
            Les informations collectées sont utilisées exclusivement pour répondre à votre demande d'informations sur la voiture d'occasion spécifique que vous avez mentionnée dans le formulaire.
            Utilisation des informations :
            Nous utilisons les informations que vous fournissez pour vous fournir les détails demandés sur la voiture d'occasion spécifique et pour faciliter la communication relative à votre demande.
            Conservation des données :
            Les informations fournies dans le cadre de votre demande sont conservées pendant six mois à des fins de suivi et de communication ultérieure.
            Communication additionnelle :
            En fournissant vos informations, vous consentez à recevoir des communications additionnelles de notre part, notamment des mises à jour sur de nouvelles arrivées de voitures d'occasion et des offres promotionnelles.
            Sécurité des informations :
            Nous prenons des mesures de sécurité appropriées pour protéger vos informations, y compris des technologies de sécurité et des pratiques de gestion sécurisées.
            Partage d'informations :
            Nous ne partageons pas vos informations avec des tiers sans votre consentement, sauf si cela est nécessaire pour répondre à votre demande spécifique (par exemple, pour fournir un rapport d'historique de véhicule).
            En utilisant notre site et en fournissant vos informations, vous consentez à notre politique de confidentialité. Nous nous réservons le droit de mettre à jour cette politique de confidentialité à tout moment. Veuillez consulter cette page régulièrement pour être informé des éventuelles modifications.
            Si vous avez des questions ou des préoccupations concernant notre politique de confidentialité, veuillez nous contacter.
        </p>
    </div>
    <button id="close-popup">Fermer</button>
</div>

<script src="https://kit.fontawesome.com/811f02e2f8.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="assets/js/musicHome.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/opinionScript.js"></script>
<script src="assets/js/private_politicy.js"></script>
<script src="assets/js/passwordVisibility.js"></script>

</body>
</html>

