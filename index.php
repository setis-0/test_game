<?php

    require('./rule.php');
    require('./user.php');
    require('./game.php');


    Rule::build();
    $game = new Game();
    $game->run(false,2 );
