<?php

declare(strict_types=1);

namespace app\services\SmsPilot;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Yii;

class SMSPilotClient implements SMSClientInterface
{
    /**
     * @throws GuzzleException
     */
    public function send(string $phone, string $message): bool
    {
        $client = new Client();

        $response = $client->request(
            method: 'GET',
            uri: 'https://smspilot.ru/api.php',
            options: [
                RequestOptions::QUERY => [
                    'send' => $message,
                    'to' => $phone,
                    'apikey' => Yii::$app->params['SMSPilotAPIKey'],
                ],
            ],
        );

        if ($response->getStatusCode() !== 200) {
            //Logging should be here
            return false;
        }

        $contents = $response->getBody()->getContents();
        $json = json_decode(json: $contents, associative: true);

        if (!$json || array_key_exists(key: 'error', array: $json)) {
            //Logging should be here
            return false;
        }

        return true;
    }
}
