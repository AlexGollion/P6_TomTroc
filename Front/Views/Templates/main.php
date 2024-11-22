<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomTroc</title>
    <link rel="stylesheet" href="./Front/css/style.css">
</head>

<body>

    <?= TomTroc\Front\Component::header(isset($_SESSION['user'])); ?>

    <main>    
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>
    
    <footer>
        
    </footer>

</body>
</html>