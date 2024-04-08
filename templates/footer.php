</main>
<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
        <img src="assets/images/logo.png" alt="Votre Logo" class="mb-3 me-2 mb-md-0" width="30" height="24">
        <span class="mb-3 mb-md-0 text-body-secondary">2023 DJPAK, Inc</span>
    </div>
    <div class=" ">
        <?php if (isset($_SESSION["user"])) : ?>
            <a href="logout.php" class="nav-link">Déconnexion</a>
        <?php else : ?>
            <a href="admin/index.php" class="nav-link">Espace Pro</a>
        <?php endif; ?>
    </div>


    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex align-items-center">
        <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.youtube.com/results?search_query=djpak"><img src="assets/images/youtube.png" alt="YouTube" width="24"></a></li>
        <li class="ms-3 text-center"><a class="text-body-secondary" href="#"><img src="assets/images/tiktok.png" alt="TikTok" width="26"></a></li>
        <li class="ms-3 text-center"><a class="text-body-secondary" href="https://www.instagram.com/djpakafro/"><img src="assets/images/instagram.jpg" alt="Instagram" width="34"></a></li>
    </ul>
    </footer>

</div>
    <!-- Contenu de la politique de confidentialité -->
    <!-- <div id="privacy-policy-popup">
        <h2>Votre politique de confidentialité </h2>
        <div class="overflow-auto" style="max-height: 300px;">
            <p> Dernière mise à jour : 10/2023
                Bienvenue sur notre site exploitant le garage VParrot. Nous nous engageons à protéger la confidentialité de vos informations. Cette politique de confidentialité explique comment nous collectons, utilisons et protégeons vos informations lorsque vous utilisez notre site et notamment lorsque vous faites des demandes d'informations sur des voitures d'occasion spécifiques via notre formulaire de contact.
                
            </p>
        </div>
        <button id="close-popup">Fermer</button>
    </div> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="assets/js/musicHome.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/opinionScript.js"></script>
<!-- <script src="/assets/js/private_politicy.js"></script> -->

</body>
</html>