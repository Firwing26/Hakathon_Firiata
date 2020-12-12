<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));


$app->get('/', function() use($app) {
    return "HELLO WORLD";
});

$app->post('/', function() use($app) {
      $data = json_decode(file_get_contents('php://input'));

      if( !$data )
         return "nook";

      if( $data->secret !== getenv('VK_SECRET_TOKEN') && $data->type !== 'confirmation' )
        return "nook";

      switch ( $data->type) {
        case 'confirmation':
          return getenv('VK_CONFIRMATION_CODE')
          break;

        case 'message_new':



             break;
      }


        return "nook";



});

$app->run();
