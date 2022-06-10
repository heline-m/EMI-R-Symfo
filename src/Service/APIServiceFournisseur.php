<?php
//Service qui va me servir à récupérer les données
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class APIServiceFournisseur
{
    //création d'un client
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getData(): array
    {
        //on crée une variable $response qui va stocker notre appel à l'api
        //on fait une requete Get sur l'apoint de notre API
        $response = $this->client->request(
            'GET',
            'https://localhost:44313/Fournisseurs'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }
}