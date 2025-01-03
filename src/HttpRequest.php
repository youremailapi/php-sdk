<?php

namespace Youremailapi\PhpSdk;

use GuzzleHttp\Client;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Federico Juretich <fedejuret@gmail.com>
 */
class HttpRequest
{

    private string $baseUri;
    private array $options;

    public function __construct(string $baseUri, array $options = [])
    {
        $this->baseUri = $baseUri;
        $this->options = $options;
    }

    /**
     * Send POST request
     *
     * @param string $path Path to request
     * @param ?array $data Data to send
     * @param ?array $headers Headers to send
     * @param ?array $files
     *
     * @throws InvalidArgumentException
     * 
     * @return Response
     */
    public function post(string $path, ?array $data = null, ?array $headers = [], ?array $files = null): Response
    {
        if ($data === null && $files === null) {
            throw new InvalidArgumentException("Must send data or files");
        }

        if (!empty($headers)) {
            $this->options['headers'] = array_merge($this->options['headers'], $headers);
        }

        $formData = [];

        if ($data !== null) {
            foreach ($data as $key => $value) {
                $formData[$key] = $value;
            }

            $data = [
                'json' => $formData
            ];
        }

        if (!empty($files)) {
            foreach ($files as $key => $filesPaths) {
                foreach ($filesPaths as $filePath) {
                    $formData[] = [
                        'name'     => $key,
                        'contents' => fopen($filePath, 'r'),
                    ];
                }
            }

            $data = [
                'multipart' => $formData
            ];
        }

        return $this->makeRequest($path, 'post', $data);
    }

    /**
     * Send GET request
     *
     * @param string $path Path to request
     * @param ?array $query Query to send
     * @param ?array $headers Headers to send
     *
     * @return Response
     */
    public function get(string $path, ?array $query = [], ?array $headers = []): Response
    {

        if (!empty($headers)) {
            $this->options['headers'] = array_merge($this->options['headers'], $headers);
        }

        return $this->makeRequest($path, 'get', [
            'query' => $query
        ]);
    }

    /**
     * Send DELETE request with body
     *
     * @param string $path Path to request
     * @param ?array $data Data to send in the request body
     * @param ?array $headers Headers to send
     *
     * @return Response
     */
    public function delete(string $path, ?array $data = null, ?array $headers = []): Response
    {
        if (!empty($headers)) {
            $this->options['headers'] = array_merge($this->options['headers'], $headers);
        }

        return $this->makeRequest($path, 'delete', [
            'json' => $data
        ]);
    }

    /**
     * @param string $path
     * @param string $method
     * @param array $options
     * @return Response
     */
    private function makeRequest(string $path, string $method, array $options): Response
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
            'headers' => $this->options['headers'],
            'http_errors' => false,
        ]);

        /** @var ResponseInterface $response */
        $response = $client->{$method}($path, $options);

        return new Response($response->getStatusCode(), $response->getBody()->getContents());
    }
}
