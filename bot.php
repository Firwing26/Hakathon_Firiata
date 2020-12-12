<?php

include "vk_api.php";


const VK_KEY = "5aa6dad050355119b482d9214a5fba1a5f2e272f64be00f11e7923f430e9037ab27d7163cf0dad57541bf";  // Токен сообщества
const ACCESS_KEY = "dcd7d221";  // Тот самый ключ из сообщества
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

    }

exit('ok');
?>
