<?php

include "vk_api.php";


const VK_KEY = "cae1514d9940a1ecbaaa1e0a001567f6729c910249dff1be7276276262d9c8695a9c7a551eb4e593a4f8e";  // Токен сообщества
const ACCESS_KEY = "d517c2d1";  // Тот самый ключ из сообщества
const VERSION = "5.81"; // Версия API VK


$vk = new vk_api(VK_KEY, VERSION);
$data = json_decode(file_get_contents('php://input'));

if ($data->type == 'confirmation') {
    exit(ACCESS_KEY);
}


$id = $data->object->from_id;
$message = $data->object->text;

 if($data->type == 'message_new')
    {

      if($message == 'Привет')
       {
         $vk->sendMessage($id, "Привет пуся");
       }

      if($message == 'Новости')
        {
           $vk->sendMessage($id, "Новости какого района или города ты хочешь узнать?");
        }
      if($message == 'Тюмень')
      {
        $vk->sendMessage($id, "Ухты в тюмени идет хакатон. https://vk.com/hack_tmn");
      }
    }

exit('ok');
?>
