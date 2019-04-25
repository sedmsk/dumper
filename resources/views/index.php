<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>Dumper</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://cdn.rawgit.com/tonsky/FiraCode/1.205/distr/fira_code.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <?= mix('css/app.css') ?>
    <?= dumpScripts() ?>
</head>
<body>
<div id="app">
    <App></App>
</div>
<noscript>
    <div class="pre-loader container-fluid h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <h1 class="text-danger">
                JavaScript is Disabled
            </h1>
        </div>
    </div>
</noscript>
<!-- Scripts -->
<?= mix('js/app.js') ?>
</body>
</html>
