<?php 
    require_once __DIR__ ."/../../config.php";
    require_once __DIR__ ."/../../lib/session.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Pro DJPak</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
    <link rel="stylesheet" href="../assets/css/styles.css">
    
</head>
<body>

<?php 
$mainmenu =[
    'inscription.php'=>['label'=> 'Création de compte', 'icon'=>'fa-arrow-right-to-bracket'],
    'singles.php' => ['label' => 'Musique', 'icon' => 'fa-music'],
    'opinions.php' => ['label' => 'Avis', 'icon' => 'fa-pen-to-square'],
    'forms.php' => ['label' => 'Messages Clients', 'icon' => 'fa-message'],
    '../logout.php'=>  ['label' => 'Déconnexion', 'icon' => 'fa-sign-out']
];



$page_active = basename($_SERVER["SCRIPT_NAME"]);
 
?>

<div class="container">
    <div class="row">
        <nav class="col-md-3 col-lg-3 d-md-block bg-dark sidebar">
            <div class="sidebar-sticky">
                <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                    <span class="title-nav">Musique DJPak</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <?php foreach ($mainmenu as $page => $data) { ?>
                    <li class="nav-item <?php echo ($page_active == $page) ? 'active' : ''; ?>">
                        <a href="<?php echo $page; ?>" class="nav-link <?php echo ($page_active == $page) ? 'text-danger' : 'text-white'; ?>">
                            <i class="fa-solid <?php echo $data['icon']; ?> fa-sm me-2" style="color: #ffffff;"></i>
                            <?php echo $data['label']; ?>
                        </a>
                    </li>
                    <?php }; ?>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4">