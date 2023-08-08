<?php

namespace Youremailapi\PhpSdk;

use InvalidArgumentException;

/**
 * @author Federico Juretich <fedejuret@gmail.com>
 */
class HttpRequest
{

    private $curl;
    private string $baseUri;
    private array $options;

    public function __construct(string $baseUri, array $options = [])
    {
        $this->baseUri = $baseUri;
        $this->options = $options;
    }

    public function __destruct()
    {
        $this->close();
    }

    /**
     * Send POST request
     *
     * @param string $path Path to request
     * @param ?array $data Data to send
     * @param array $headers Headers to send
     * @param ?array $files
     *
     * @throws InvalidArgumentException
     * 
     * @return Response
     */
    public function post(string $path, ?array $data = null, array $headers = [], ?array $files = null): Response
    {
        if ($data === null && $files === null) {
            throw new InvalidArgumentException("Must send data or files");
        }

        if (!empty($headers)) {
            $this->options['headers'] = array_merge($this->options['headers'], $headers);
        }

        $this->curl = curl_init($this->baseUri . $path);

        $formData = [];

        if ($data !== null) {
            foreach ($data as $key => $value) {
                $formData[$key] = $value;
            }
        }

        if (!empty($files)) {
            foreach ($files as $key => $filePath) {
                $formData[$key][] = new \CURLFile($filePath);
            }
        }

        if (
            isset($this->options['headers']['Content-Type'])
            && $this->options['headers']['Content-Type'] === 'application/json'
        ) {
            $formData = json_encode($formData);
        }

        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $formData);

        return $this->makeRequest();
    }

    /**
     * Send GET request
     *
     * @param string $path Path to request
     * @param ?array $query Query to send
     * @param array $headers Headers to send
     *
     * @return Response
     */
    public function get(string $path, ?array $query = [], array $headers = []): Response
    {

        if (!empty($headers)) {
            $this->options['headers'] = array_merge($this->options['headers'], $headers);
        }

        $url = $this->baseUri . $path;

        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        $this->curl = curl_init($url);

        return $this->makeRequest();
    }

    /**
     * Send DELETE request with body
     *
     * @param string $path Path to request
     * @param ?array $data Data to send in the request body
     * @param array $headers Headers to send
     *
     * @return Response
     */
    public function delete(string $path, ?array $data = null, array $headers = []): Response
    {
        if (!empty($headers)) {
            $this->options['headers'] = array_merge($this->options['headers'], $headers);
        }

        $this->curl = curl_init($this->baseUri . $path);

        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'DELETE');

        if (
            isset($this->options['headers']['Content-Type'])
            && $this->options['headers']['Content-Type'] === 'application/json'
        ) {
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($data));
        } else {
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        return $this->makeRequest();
    }

    /**
     * Get headers to send
     *
     * @return array
     */
    private function getHeaders(): array
    {
        $headers = [];

        if (isset($this->options['headers'])) {
            foreach ($this->options['headers'] as $key => $value) {
                $headers[] = "{$key}: {$value}";
            }
        }

        return array_values($headers);
    }

    /**
     * Close curl connection
     *
     * @return void
     */
    private function close(): void
    {
        if ($this->curl !== null) {
            curl_close($this->curl);
        }
    }

    /**
     * @return Response
     */
    private function makeRequest(): Response
    {
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);

        if (isset($this->options['headers'])) {
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->getHeaders());
        }

        $response = curl_exec($this->curl);
        $code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        return new Response($code, $response);
    }
}
