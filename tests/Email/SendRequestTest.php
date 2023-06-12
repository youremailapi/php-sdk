<?php

namespace Email;

use Youremailapi\PhpSdk\Email\SendRequest;
use PHPUnit\Framework\TestCase;
use Youremailapi\PhpSdk\DataTransferObjects\Email\SendRequestDTO;

class SendRequestTest extends TestCase
{

    public function testMustSendEmail()
    {
        $to = 'noreply@youremailapi.com';

        $dto = (new SendRequestDTO())
            ->setTemplate('ded580ac7802f8e0b55adcb4b0ee528ebdabe3b544f66262875fc7e85b4ec623')
            ->setSmtpAccount('593065f3f704ff3a1d881fbd5ffb73478ced87daf77b3064981a28d3f421b4a3')
            ->setTo($to)
            ->setSubject('Test Case')
            ->setVariables([
                '%user_first_name%' => 'Federico',
                '%app_name%' => 'YourEmailAPI'
            ]);

        $request = new SendRequest('acf5c2f932bf855723fe68157e20db636bd28713b5a28f475565d0a2dac76b46');

        $response = $request->send($dto);
        $data = $response->getData();

        $this->assertTrue($response->getCode() === 201);
        $this->assertIsArray($data->accepted);
        $this->assertContains($to, $data->accepted);

    }

}
