<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class Questions extends ConnectSource
{
    private string $parameters;

    public function __construct(HttpClientInterface $client)
    {
        parent::__construct($client);
        $this->parameters = 'order=desc&sort=activity&site=stackoverflow';
    }


    public function getQuestions(?string $tagged = null, ?string $fromDate = null, ?string $toDate = null)
    {
        if ($tagged == null) {
            return ['error' => 'Parameter Tagged is required'];
        }

        $this->parameters .= '&tagged=' . $tagged;

        if ($fromDate != null) {
            $this->parameters .= '&fromdate=' . $fromDate;
        }

        if ($toDate != null) {
            $this->parameters .= '&todate=' . $toDate;
        }

        return $this->connect($this->parameters);
    }

}