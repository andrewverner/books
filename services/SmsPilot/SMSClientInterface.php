<?php

declare(strict_types = 1);

namespace app\services\SmsPilot;

interface SMSClientInterface
{
    public function send(string $phone, string $message): bool;
}
