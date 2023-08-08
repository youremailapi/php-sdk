<?php

namespace Youremailapi\PhpSdk\Email;

use InvalidArgumentException;
use Youremailapi\PhpSdk\Response;
use Youremailapi\PhpSdk\Constants;
use Youremailapi\PhpSdk\HttpRequest;
use Youremailapi\PhpSdk\DataTransferObjects\Email\SendEmailDTO;

/**
 * @author Federico Juretich <fedejuret@gmail.com>
 */
class SendEmail
{

    private string $apikey;

    private string $path = 'mailer';

    public function __construct(string $apikey)
    {
        $this->apikey = $apikey;
    }

    public function send(SendEmailDTO $sendRequestDTO): Response
    {
        $client = new HttpRequest(Constants::API_BASE_URL, [
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        if (!filter_var($sendRequestDTO->getTo(), FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid {$sendRequestDTO->getTo()} email");
        }

        $body = [
            'template' => $sendRequestDTO->getTemplate(),
            'smtp_account' => $sendRequestDTO->getSmtpAccount(),
            'subject' => $sendRequestDTO->getSubject(),
            'to' => $sendRequestDTO->getTo(),
        ];

        if (null !== $sendRequestDTO->getBcc()) {
            $body['bcc'] = $sendRequestDTO->getBcc();
        }

        if ($sendRequestDTO->getVariables() !== null) {
            $body['variables'] = $sendRequestDTO->getVariables();
        }

        if ($sendRequestDTO->getReplyTo() !== null) {
            $body['reply_to'] = $sendRequestDTO->getReplyTo();
        }

        return $client->post($this->path, $body, [
            'apikey' => $this->apikey
        ]);
    }
}
