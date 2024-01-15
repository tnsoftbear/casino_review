<?php

declare(strict_types=1);

namespace App\Infra\Api\Telegram;

use Illuminate\Support\Facades\Http;

final class TelegramBotApi
{
    private const HOST = 'https://api.telegram.org/bot';

    public static function sendMessage(string $token, string $chatId, string $text): void
    {
        Http::get(self::HOST . $token . '/sendMessage', [
            'chat_id' => $chatId,
            'text' => $text,
        ]);
    }
}