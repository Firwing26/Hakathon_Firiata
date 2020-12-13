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
               'access_token' => getenv('VK_TOKEN'),
               'v' => '5.50'
             );
             $problem = array(
               'first' => 'курит',
               'sekond' => 'сбегает',
               'sleng'  => 'сленг'
             );

              if ($slovo == 'привет')  {
                 $request_params['message'] = 'Приветствую на пути просвещения.🤔
                Я готов помочь в трудную минуту непониания детей и родителе подсказав что могло стать причиной, как этого избежать и как это исправить.  Я помогу поддержав добрым словом.
                Если хочешь пообщаться то я отвечаю только на ключевые слова, их можно комбенировать и получать инной ответ не жели спрашивать о них в отдельности.
                Я знаю такие ключевые слова:
                курит
                сбегает
                Помимо этого я могу расказать о значении сленговых слов. Просто напиши сленг' ;
               }

             if ($slovo == $problem['sleng'])  {
                $request_params['message'] = 'Здесь будут распологаться слова и их значения которые сейчас находятся в обиходе молодежи' ;
              }

             if ($slovo == 'курит сбегает' or $slovo == 'курит сбегает')  {
                 $request_params['message'] = 'Данные события могли выйти из тяжелых душевных волнений' ;
              }

             if ($slovo == $problem['sekond']) {
                $request_params['message'] = 'К этому могло привести непонимание в семье.
                 Возможно ребенок увидел какое отношение между его друзьями и их родителями и сделав вывод о том что в его жизни что то не так решил путем побега начать все с чистого листа';
             }
             if ($slovo == $problem['first']) {
                $request_params['message'] = 'Причиной этого могло стать малое количество уделенного ребенку внимания или ограничение его от данной плохой привычки вместо того чтобы конкретно объяснить что такое курение и к чему оно может привести';
             }


             file_get_contents('https://api.vk.com/method/messages.send?' . http_build_query($request_params));


             return 'ok';
             break;
      }


        return "nook";


        exit('ok');

});

$app->run();
