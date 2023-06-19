<?php

namespace Youremailapi\PhpSdk\Tests\Email;

use PHPUnit\Framework\TestCase;
use Youremailapi\PhpSdk\Tests\Constants;
use Youremailapi\PhpSdk\Email\SendRequest;
use Youremailapi\PhpSdk\DataTransferObjects\Email\SendRequestDTO;

class SendRequestTest extends TestCase
{

    public function testMustSendSimpleMail()
    {

        $response = $this->getRequest()->send($this->getDto());
        $data = $response->getData();

        $this->assertTrue($response->getCode() === 201);
        $this->assertIsArray($data->accepted);
        $this->assertContains(Constants::DEFAULT_TO_EMAIL, $data->accepted);
    }

    public function testMustSendCompleteEmail()
    {

        $dto = $this->getDto()
            ->setBcc([
                'sometestemail@gmail.com'
            ])
            ->setReplyTo([
                'Federico Juretich <fedejuret@gmail.com>'
            ]);

        $response = $this->getRequest()->send($dto);
        $data = $response->getData();

        $this->assertTrue($response->getCode() === 201);
        $this->assertIsArray($data->accepted);
        $this->assertContains(Constants::DEFAULT_TO_EMAIL, $data->accepted);
    }

    public function testMustThrowInvalidArgumentException()
    {

        $dto = $this->getDto()
            ->setBcc([
                'sometestemail@gmail.com'
            ])
            ->setReplyTo([
                'Federico Juretich <fedejuret@gmail.com>'
            ])
            ->setTo('INVALID_EMAIL');

        try {
            $this->getRequest()->send($dto);
        } catch (\Throwable $th) {
            $this->assertInstanceOf('InvalidArgumentException', $th);
        }
    }

    private function getDto(): SendRequestDTO
    {
        return (new SendRequestDTO())
            ->setTemplate(Constants::DEFAULT_TEMPLATE)
            ->setSmtpAccount(Constants::DEFAULT_SMTP_ACCOUNT)
            ->setTo(Constants::DEFAULT_TO_EMAIL)
            ->setSubject('Test Case')
            ->setVariables([
                '%user_first_name%' => 'Federico',
                '%app_name%' => 'YourEmailAPI'
            ]);
    }

    private function getRequest(): SendRequest
    {
        return new SendRequest(Constants::APIKEY);
    }
}
