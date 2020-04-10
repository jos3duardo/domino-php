<?php
require_once 'vendor/autoload.php';
use \App\Model\Game;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <title>Domino</title>
</head>
<body>
<br>
<div class="container">
<!--<form action="/app/Controller/PlayerController.php" method="POST">-->
<form method="POST" class="form-inline">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group mb-2">
                <label for="player1">Jogador 1:</label>
                <input type="text" class="form-control"  id="player1" name="player1" placeholder="Nome" required>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group mb-2">
                <label for="player2">Jogador 2:</label>
                <input type="text" class="form-control"  id="player2" name="player2" placeholder="Nome" required>
            </div>
        </div>
        <div class="col-md-2 mt-3">
            <button type="submit" class="btn btn-primary mb-2">Iniciar</button>
        </div>
    </div>
    <div class="row">

    </div>
</form>
<?php
    $player1 = $_POST['player1'];
    $player2 = $_POST['player2'];

    $game = new Game();
    $game->start($player1, $player2);
//    $players = $game-
?>
<hr>
<div class="row">
        <div class="col-md-4">
            <p>Peças do jogador 1: <?= $player1?></p>
            <ul>
                <?php foreach ($game->getPlayers()[0]->getPieces() as $piece){ ?>
                <li>
                    <?= $piece ?>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-4">
            <p>Peças do jogador 2: <?= $player2?></p>
            <ul>
                <?php foreach ($game->getPlayers()[1]->getPieces() as $piece){ ?>
                    <li>
                        <?= $piece ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-4">
            <p>Monte</p>
            <ul>
                <?php foreach ($game->getPile() as $piece){ ?>
                    <li>
                        <?= $piece ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
</div>
</div>
</body>
</html>