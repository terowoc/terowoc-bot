<?php

require 'vendor/autoload.php';
$botConfig = require 'config/bot.php';
$dbConfig = require 'config/database.php';
$langConfig = require 'config/language.php';

try {
    $bot = new \TelegramBot\Api\Client($botConfig['token']);
    $conn = \Doctrine\DBAL\DriverManager::getConnection($dbConfig);

    $bot->command('start', function ($message) use ($bot, $conn, $langConfig, $botConfig) {
        $message_id = $message->getMessageId();
        $chat_id = $message->getFrom()->getId();
        $text = $message->getText();
        
        if ($chat_id == $botConfig['admin']) {
            $options = [
                ["Statistika"],
            ];
            $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup($options, true, true);

            $bot->sendMessage($chat_id, "*Admin Panel:*", 'markdown', false, null, $keyboard);
        }else{
            $userLanguage = $conn->createQueryBuilder()
                ->select('lang')
                ->from('users')
                ->where('chat_id = :chat_id')
                ->setParameter('chat_id', $chat_id)
                ->execute()
                ->fetchOne();

            if (!$userLanguage) {
                $conn->createQueryBuilder()
                    ->insert('users')
                    ->values([
                        'chat_id' => ':chat_id',
                    ])
                    ->setParameter('chat_id', $chat_id)
                    ->execute();

                $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup($langConfig[$message->getFrom()->getLanguageCode()]['keyboard']);
                $bot->sendMessage($chat_id, $langConfig[$message->getFrom()->getLanguageCode()]['start'], null, false, null, $keyboard);

                exit();
            }

            $bot->sendMessage($chat_id, str_replace(':name', $message->getFrom()->getFirstName(), $langConfig[$userLanguage]['welcome']), 'markdown');
            sleep(1);

            $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup($langConfig[$userLanguage]['info']['keyboard']);
            $bot->sendMessage($chat_id, $langConfig[$userLanguage]['info']['text'], 'markdown', true, null, $keyboard);
            sleep(2);

            $bot->sendMessage($chat_id, $langConfig[$userLanguage]['message'], 'markdown');            
        }
    });

    $bot->callbackQuery(function ($callbackQuery) use ($bot, $conn, $langConfig) {
        $callbackQueryData = $callbackQuery->getData();
        $callbackQueryId = $callbackQuery->getId();
        $callbackQueryChatId = $callbackQuery->getMessage()->getChat()->getId();
        $callbackQueryChatName = $callbackQuery->getFrom()->getFirstName();
        $callbackQueryMessageId = $callbackQuery->getMessage()->getMessageId();

        if ($callbackQueryData == "delete") {
            $bot->answerCallbackQuery($callbackQueryId, 'Deleted!');
            $bot->deleteMessage($callbackQueryChatId, $callbackQueryMessageId);
        } elseif (preg_match("/^(lang).([a-z]+|[a-z]+.[a-zA-Z]*)$/", $callbackQueryData)) {
            $langConfiguageCode = explode("#", $callbackQueryData)[1];
            $bot->deleteMessage($callbackQueryChatId, $callbackQueryMessageId);

            $conn->createQueryBuilder()
                ->update('users')
                ->set('lang', ':lang')
                ->where('chat_id = :chat_id')
                ->setParameter('lang', $langConfiguageCode)
                ->setParameter('chat_id', $callbackQueryChatId)
                ->execute();

            $bot->sendMessage($callbackQueryChatId, $langConfig[$langConfiguageCode]['lang'], 'markdown');
            sleep(1);

            $bot->sendMessage($callbackQueryChatId, str_replace(':name', $callbackQueryChatName, $langConfig[$langConfiguageCode]['welcome']), 'markdown');
            sleep(1);

            $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup($langConfig[$langConfiguageCode]['info']['keyboard']);
            $bot->sendMessage($callbackQueryChatId, $langConfig[$langConfiguageCode]['info']['text'], 'markdown', true, null, $keyboard);
            sleep(2);

            $bot->sendMessage($callbackQueryChatId, $langConfig[$langConfiguageCode]['message'], 'markdown');
        }
    });

    $bot->on(function (\TelegramBot\Api\Types\Update $update) use ($bot, $conn, $langConfig, $botConfig) {
        $message = $update->getMessage();
        $message_id = $message->getMessageId();
        $chat_id = $message->getFrom()->getId();
        $text = $message->getText();
        $replyToMessageId = $message->getReplyToMessage()?->getMessageId() - 1;

        if ($chat_id == $botConfig['admin']) {
            if ($text == 'Statistika') {
                $bot_users_count = $conn->createQueryBuilder()
                    ->select('COUNT(id)')
                    ->from('users')
                    ->fetchOne();
                $bot->sendMessage($chat_id, "Bot a'zolari soni: {$bot_users_count}", 'markdown', false, $message_id);
                
            }else{
                $replyToMessageUserId = $conn->createQueryBuilder()
                    ->select('chat_id')
                    ->from('messages')
                    ->where('message_id = ' . $replyToMessageId)
                    ->fetchOne();

                $bot->sendMessage($replyToMessageUserId, $text, 'markdown', false, $replyToMessageId);
            }
        } else {
            $userLanguage = $conn->createQueryBuilder()
                ->select('lang')
                ->from('users')
                ->where('chat_id = :chat_id')
                ->setParameter('chat_id', $chat_id)
                ->execute()
                ->fetchOne();

            $bot->forwardMessage($botConfig['admin'], $chat_id, $message_id, false, true);
            $conn->createQueryBuilder()
                ->insert('messages')
                ->values([
                    'chat_id' => ':chat_id',
                    'message_id' => ':message_id',
                ])
                ->setParameter('chat_id', $chat_id)
                ->setParameter('message_id', $message_id)
                ->execute();

            $bot->sendMessage($chat_id, $langConfig[$userLanguage]['message-send'], 'markdown');
        }
    }, function () {
        return true;
    });

    $bot->run();
} catch (\TelegramBot\Api\Exception $e) {
    $e->getMessage();
}
