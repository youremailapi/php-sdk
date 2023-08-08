<?php

namespace Youremailapi\PhpSdk\Attachments;

use Youremailapi\PhpSdk\Response;
use Youremailapi\PhpSdk\Constants;
use Youremailapi\PhpSdk\HttpRequest;
use Youremailapi\PhpSdk\Exceptions\FileNotFoundException;

/**
 * @author Federico Juretich <fedejuret@gmail.com>
 */
class Attachments
{

    private string $apikey;
    private string $path = 'files';
    private HttpRequest $client;

    public function __construct(string $apikey)
    {
        $this->apikey = $apikey;
        $this->client = new HttpRequest(Constants::API_BASE_URL, [
            'headers' => [
                'Content-Type' => 'multipart/form-data'
            ]
        ]);
    }

    /**
     * @param array<string> $filesPaths Absolute path to files
     * 
     * @throws FileNotFoundException
     */
    public function upload(array $filesPaths): Response
    {
        foreach ($filesPaths as $filePath) {
            if (!file_exists($filePath)) {
                throw new FileNotFoundException("File $filePath not found");
            }
        }

        return $this->client->post(
            $this->path,
            null,
            [
                'apikey' => $this->apikey
            ],
            [
                "files" => $filesPaths
            ]
        );
    }

    /**
     * @return Response
     */
    public function get(): Response
    {
        return $this->client->get(
            'files',
        );
    }

    /**
     * @param array<string> $files
     * 
     * @return Response
     */
    public function delete(array $files): Response
    {
        return $this->client->delete(
            'files',
            [
                "files" => $files
            ],
            [
                'Content-Type' => 'application/json'
            ]
        );
    }

    public function setClient($client)
    {
        $this->client = $client;
    }
}
