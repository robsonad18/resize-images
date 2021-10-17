<?php 

require __DIR__.'/vendor/autoload.php';

use App\Image\Resize;

$obResize = new Resize(__DIR__.'/img/fundomacos.png');

$obResize->resize(100);

$obResize->print(9);

// $obResize->save(__DIR__.'/img/nova-imagem2.png',5);