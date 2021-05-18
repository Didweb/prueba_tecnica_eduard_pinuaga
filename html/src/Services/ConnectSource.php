<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ConnectSource
{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function connect($parameters = '')
    {
        $response = $this->client->request(
            'GET',
            sprintf(
                'https://api.stackexchange.com/questions?%s',
                $parameters
            )
        );

        try {
            $status = $response->getStatusCode();
            if ($status == 200) {
                return $response->toArray();
            } else {
                return ['errorCode' => $status];
            }
        } catch (ClientExceptionInterface $e) {
            return ['errorCode' => $e->getMessage()];
        } catch (RedirectionExceptionInterface $e) {
            return ['errorCode' => $e->getMessage()];
        } catch (ServerExceptionInterface $e) {
            return ['errorCode' => $e->getMessage()];
        } catch (TransportExceptionInterface $e) {
            return ['errorCode' => $e->getMessage()];
        }
    }
}