<?php

namespace Sumatra;

class SumatraClientFactory
{
    public static function factory(string $wsdl, string $username, string $password, $options = []): \Sumatra\SumatraClient
    {
        $clientFactory = new \Phpro\SoapClient\ClientFactory(\Sumatra\SumatraClient::class);
        $clientBuilder = new \Phpro\SoapClient\ClientBuilder($clientFactory, $wsdl, $options);
        $clientBuilder->withClassMaps(SumatraClassmap::getCollection());
        $clientBuilder->withHandler(\Phpro\SoapClient\Soap\Handler\HttPlugHandle::createWithDefaultClient());
        $clientBuilder->addMiddleware(new \Sumatra\AuthMiddleware($username, $password));

        /** @var \Sumatra\SumatraClient $client */
        $client = $clientBuilder->build();

        return $client;
    }
}
