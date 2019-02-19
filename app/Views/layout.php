<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>O'Quiz</title>
        <link rel="icon" href="<?= $basePath ?>assets/images/favicon.ico">
        <link rel="stylesheet" href="<?= $basePath ?>assets/css/reset.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
        <link rel="stylesheet" href="<?= $basePath ?>assets/css/style.css">
        <script>var BASE_PATH="<?= $basePath ?>";</script>
    </head>

    <body>
        <header>
            <?= $this->insert('partials/nav')?>
        </header>

        <main>
            <?= $this->section('content')?>
        </main>

        <footer>&copy; Copyright 2018 - O'clock</footer>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="<?= $basePath ?>assets/js/app.js"></script>
    </body>
</html>
