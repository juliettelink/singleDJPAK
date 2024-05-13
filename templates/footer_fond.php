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
                <li class="ms-3 text-center"><a class="text-body-secondary" href="https://open.spotify.com/intl-fr/artist/7L70NlXQPcsZrGWo2SCE9G"><i class="fa-brands fa-spotify fa-xl"></i></a></li>
                <li class="ms-3 text-center"><a class="text-body-secondary" href="https://on.soundcloud.com/S4mfY"><i class="fa-brands fa-soundcloud fa-xl"></i></a></li>
                <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.youtube.com/results?search_query=djpak"><i class="fa-brands fa-youtube fa-xl"></i></a></li>
                <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.tiktok.com/@djpakafro?_t=8lPlQKN5Pay&_r=1"><i class="fa-brands fa-tiktok fa-xl"></i></a></li>
                <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.instagram.com/djpakafro/"><i class="fa-brands fa-square-instagram fa-xl"></i></a></li>
                <li class="ms-3 text-center"><a class="text-body-secondary" href="https://deezer.page.link/3pjUi2PFdkgEXv5A6"><i class="fa-brands fa-deezer fa-xl"></i></a></li>
                <li class="ms-3 text-center"><a class="text-body-secondary" href="https://music.apple.com/us/album/dance-to-the-rythme-single/1738869257"><i class="fa-solid fa-music fa-xl"></i></i></a></li>
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
    <h2>Politique de confidentialité de DJPAK </h2>
    <div class="overflow-auto" style="max-height: 300px;">
        <p> La confidentialité des visiteurs de DJPAK est très importante pour nous. Cette politique de confidentialité décrit les types d'informations personnelles collectées et enregistrées par DJPAK et la manière dont nous les utilisons.

Si vous avez des questions supplémentaires ou avez besoin de plus d'informations sur notre politique de confidentialité, n'hésitez pas à nous contacter via l'onglet de contact sur notre site web.

Consentement

En utilisant notre site web, vous consentez à notre politique de confidentialité et acceptez ses conditions.

Informations que nous collectons

Lorsque vous visitez DJPAK, nous collectons et enregistrons automatiquement certaines informations sur votre appareil, votre navigateur et votre comportement sur le site. Ces informations peuvent inclure votre adresse IP, le type de navigateur, les pages que vous avez visitées et d'autres statistiques.

De plus, si vous choisissez de nous fournir des informations personnelles via notre formulaire de contact, notre formulaire d'avis ou notre formulaire d'inscription à la newsletter, nous collecterons les informations que vous fournissez volontairement, telles que votre nom, votre adresse e-mail et d'autres détails que vous choisissez de nous communiquer.

Utilisation des informations

Les informations que nous collectons sur DJPAK sont utilisées pour améliorer l'expérience des utilisateurs en personnalisant notre site web et en fournissant du contenu et des publicités pertinents. Nous utilisons également ces informations pour communiquer avec vous, répondre à vos demandes et vous envoyer des newsletters si vous avez choisi de vous y abonner.

Nous ne partageons pas vos informations personnelles avec des tiers, sauf si cela est nécessaire pour répondre à une demande que vous avez soumise ou si cela est exigé par la loi.

Conservation des données

Nous conservons les informations collectées aussi longtemps que nécessaire pour fournir les services demandés par les utilisateurs et pour respecter nos obligations légales.

Vos droits

Vous avez le droit de demander l'accès, la correction ou la suppression de vos informations personnelles que nous détenons. Vous avez également le droit de retirer votre consentement à tout moment.

Mises à jour de la politique de confidentialité

Nous nous réservons le droit de mettre à jour ou de modifier notre politique de confidentialité à tout moment. Les modifications apportées à cette politique seront affichées sur cette page et entreront en vigueur dès leur publication.

En continuant à utiliser DJPAK après la publication de ces modifications, vous acceptez ces modifications et reconnaissez avoir pris connaissance de la politique de confidentialité mise à jour.

Contactez-nous

Si vous avez des questions ou des préoccupations concernant notre politique de confidentialité ou notre utilisation de vos informations personnelles, veuillez nous contacter via l'onglet de contact sur notre site web.
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

