<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ChurchSuiteService
{
    /**
     * @var Client
     */
    private $client;


    /**
     * @var array
     */
    private $auth_headers = [];

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->set_auth_headers($config);
        $this->client = new Client(['base_uri' => $config['api_url']]);
    }

    /**
     * Sets the array of the auth headers
     * 
     * @param array $config
     */
    public function set_auth_headers(array $config)
    {
        $this->auth_headers = [
            'X-Account' => $config['account'],
            'X-Application' => $config['app'],
            'X-Auth' => $config['key']
        ];
    }

    /**
     * Executes a HTTP GET request to the given $endpoint with the query $data appeneded
     * 
     * @param string $endpoint - the API endpoint to GET
     * @param array $data - query data will be appended to the end of the given endpoint after a ?
     * @return array
     */
    public function get(string $endpoint, array $data = [])
    {
        $endpoint = ltrim($endpoint, '/');

        $response = $this->client->request('GET', $endpoint, [
            'query' => $data,
            'headers' => $this->auth_headers
        ]);

        #TODO: Handle errors? Check status code?

        #TODO: Is this the best way to do this?
        return json_decode($response->getBody()->getContents());
    }
}
