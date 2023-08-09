<?php

namespace Youremailapi\PhpSdk\Tests\Attachments;

use PHPUnit\Framework\TestCase;
use Youremailapi\PhpSdk\Response;
use Youremailapi\PhpSdk\HttpRequest;
use Youremailapi\PhpSdk\Attachments\Attachments;

class AttachmentsTest extends TestCase
{

    public function testMustUploadFiles()
    {
        $apiClientMock = $this->getMockBuilder(HttpRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apiClientMock->expects($this->once())
            ->method('post')
            ->with(
                $this->equalTo("files"),
                $this->isNull(),
                $this->isNull(),
                $this->equalTo([
                    "files" => [
                        __DIR__ . '/../../README.md'
                    ]
                ])
            );

        $attachments = new Attachments("SOME_API_KEY");
        $attachments->setClient($apiClientMock);

        $result = $attachments->upload([__DIR__ . '/../../README.md']);

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testMustGetFiles()
    {
        $apiClientMock = $this->getMockBuilder(HttpRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apiClientMock->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo("files")
            );

        $attachments = new Attachments("SOME_API_KEY");
        $attachments->setClient($apiClientMock);

        $result = $attachments->get();

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testMustDeleteFiles()
    {
        $apiClientMock = $this->getMockBuilder(HttpRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $apiClientMock->expects($this->once())
            ->method('delete')
            ->with(
                $this->equalTo("files"),
                $this->equalTo([
                    "files" => [
                        "SOME_FILE_TOKEN"
                    ]
                ]),
                $this->equalTo([
                    'Content-Type' => 'application/json'
                ])
            );

        $attachments = new Attachments("SOME_API_KEY");
        $attachments->setClient($apiClientMock);

        $result = $attachments->delete(["SOME_FILE_TOKEN"]);

        $this->assertInstanceOf(Response::class, $result);
    }
}
