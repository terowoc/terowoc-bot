<?php

return [
    'uz' => [
        'start' => "Tilni tanlang:",
        'keyboard' => [
            [
                ['text' => "🇺🇿 O'zbekcha", 'callback_data' => 'lang#uz'],
                ['text' => "🇷🇺 Ruscha", 'callback_data' => 'lang#ru'],
                ['text' => "🇺🇸 Inglizcha", 'callback_data' => 'lang#en'],
            ],
        ],
        'lang' => "🇺🇿 *O'zbek tili tanlandi!*",
        'welcome' => "👋 Salom :name!\n\n🤖 Men [Azimboev Abdulloh](https://t.me/terowoc)'ning' chat boti va do‘stiman.",
        'info' => [
            'text' => "Quyida [Azimboev Abdulloh](https://t.me/terowoc)'ning havolalari 👇",
            'keyboard' => [
                [['text' => "📱 Telegram", 'url' => 'https://t.me/terowoc']],
                [['text' => "📸 Instagram", 'url' => 'https://instagram.com/azimbo_ev']],
                [['text' => "🐈‍⬛ GitHub", 'url' => 'https://github.com/terowoc']],
                [['text' => "📃 Blog", 'url' => 'https://blog.azimboev.uz']],
                [['text' => "🌐 Veb sayt", 'url' => 'https://azimboev.uz']],
            ],
        ],
        'message' => "*Xabaringiz bo'lsa yozib qoldirishingiz mumkin, men esa tezda uni egasiga yetkazaman :)*",
        'message-send' => "Xabaringiz yuborildi.",
    ],
    
    'ru' => [
        'start' => "Выберите язык:",
        'keyboard' => [
            [
                ['text' => "🇺🇿 Узбекский", 'callback_data' => 'lang#uz'],
                ['text' => "🇷🇺 Русский", 'callback_data' => 'lang#ru'],
                ['text' => "🇺🇸 Английский", 'callback_data' => 'lang#en'],
            ],
        ],
        'lang' => "🇷🇺 Русский язык выбран!",
        'welcome' => "👋 Привет, :name!\n\n🤖 Я чат-бот и друг [Азимбоева Абдуллоха](https://t.me/terowoc).",
        'info' => [
            'text' => "Ниже ссылки [Азимбоева Абдуллоха](https://t.me/terowoc) 👇",
            'keyboard' => [
                [['text' => "📱 Телеграм", 'url' => 'https://t.me/terowoc']],
                [['text' => "📸 Инстаграм", 'url' => 'https://instagram.com/azimbo_ev']],
                [['text' => "🐈‍⬛ Гитхаб", 'url' => 'https://github.com/terowoc']],
                [['text' => "📃 Блог", 'url' => 'https://blog.azimboev.uz']],
                [['text' => "🌐 Веб-сайт", 'url' => 'https://azimboev.uz']],
            ],
        ],
        'message' => "*Если у вас есть сообщение, вы можете написать его, и я быстро передам владельцу :)*",
        'message-send' => "Ваше сообщение отправлено.",
    ],

    'en' => [
        'start' => "Choose language:",
        'keyboard' => [
            [
                ['text' => "🇺🇿 Uzbek", 'callback_data' => 'lang#uz'],
                ['text' => "🇷🇺 Russian", 'callback_data' => 'lang#ru'],
                ['text' => "🇺🇸 English", 'callback_data' => 'lang#en'],
            ],
        ],
        'lang' => "🇺🇸 *English is selected!*",
        'welcome' => "👋 Hello :name!\n\n🤖 I am [Azimboev Abdullah](https://t.me/terowoc)'s chat bot and friend.",
        'info' => [
            'text' => "Below are the links of [Azimboev Abdullah](https://t.me/terowoc) 👇",
            'keyboard' => [
                [['text' => "📱 Telegram", 'url' => 'https://t.me/terowoc']],
                [['text' => "📸 Instagram", 'url' => 'https://instagram.com/azimbo_ev']],
                [['text' => "🐈‍⬛ GitHub", 'url' => 'https://github.com/terowoc']],
                [['text' => "📃 Blog", 'url' => 'https://blog.azimboev.uz']],
                [['text' => "🌐 Website", 'url' => 'https://azimboev.uz']],
            ],
        ],
        'message' => "*If you have amessage, you can write it down and I will quickly pass it on to the owner :)*",
        'message-send' => "Your message has been sent.",
    ],
];