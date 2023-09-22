<?php

include 'vendor/autoload.php';
$conf = include 'config.php';

$bot = new Telegram($conf['bot']['token']);
$db = new PDO("mysql:host=" . $conf['db']['host'] . ";dbname=" . $conf['db']['name'], $conf['db']['user'], $conf['db']['pass']);

$update = $bot->getData();
$text = $bot->Text();
$c_data = $update['callback_query']['data'];
$chat_id = $bot->ChatID();
$user = $db->query("SELECT * FROM users WHERE chat_id=".$chat_id)->fetch();

if ($text == '/start') {
	if (!$user['chat_id']) {
		$db->prepare("INSERT INTO users (chat_id) VALUES (?)")->execute([$chat_id]);
	}

    $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "Welcome!"];
    $bot->sendMessage($content);
}else{
    $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "error!"];
    $bot->sendMessage($content);
}