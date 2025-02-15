<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomTroc</title>
    <link rel="stylesheet" href="./Front/css/main.css">
    <script src="https://kit.fontawesome.com/177a696033.js" crossorigin="anonymous"></script>
</head>

<body>

    <?= TomTroc\Front\Components\Component::render(['component' => 'header']); ?>

    <main>    
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>
    
    <?= TomTroc\Front\Components\Component::render(['component' => 'footer']); ?>

    <script type="module" src="./Front/js/main.js"></script>
</body>
</html>