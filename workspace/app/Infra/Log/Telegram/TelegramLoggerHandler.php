<?php

declare(strict_types=1);

namespace App\Infra\Log\Telegram;

use Monolog\Logger;
use Monolog\LogRecord;
use App\Infra\Api\Telegram\TelegramBotApi;
use Monolog\Handler\AbstractProcessingHandler;

final class TelegramLoggerHandler extends AbstractProcessingHandler
{
    protected string $chatId;
    protected string $token;

    public function __construct(array $config)
    {
        $level = Logger::toMonologLevel($config['level']);
        parent::__construct($level);
        $this->chatId = $config['chat_id'];
        $this->token = $config['token'];
        //$this->setFormatter(new TelegramLoggerFormatter($config));
    }

    protected function write(LogRecord $record): void
    {
        TelegramBotApi::sendMessage($this->token, $this->chatId, $record->message);
    }
}