<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

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

      switch ( $data->type )
      {
        case 'confirmation':
          return getenv('VK_CONFIRMATION_CODE');
          break;

        case 'message_new':
             $slovo = $data->object->body;
             $request_params = array(
               'user_id' => $data->object->user_id,
               'message' => 'непонял',
               'access_token' => getenv('VK_TOKEN')
               'v' => '5.50'
             )
             $problem = array(
               'first' => 'курит'
             );
             

             file_get_content('https://api.vk.com/method/messages.send?' . http_build_query($request_params));


             return 'ok';
             break;
      }


        return "nook";



});

$app->run();
