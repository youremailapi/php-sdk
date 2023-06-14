# Getting started

YouremailAPI PHP Sdk is a tool to interact with the [YouremailAPI api](https://youremailapi.com)

To start using the SDK, you must first have an account on the platform (you can create one for free [here](https://youremailapi.com/auth/sign-up)).

When you already have your account, you will need to upload an SMTP account with which you want to send emails and you will also have to create your first template.
For more details, we recommend reading this [getting started](https://docs.youremailapi.com/docs/getting-started)

## Install this package
```text
composer require youremailapi/php-sdk 
 ```

## Start using it

How to send an email:

```php
use Youremailapi\PhpSdk\DataTransferObjects\Email\SendRequestDTO;
use Youremailapi\PhpSdk\Email\SendRequest;

$sendEmail = new SendRequest('<YOUR API KEY>');

$sendEmail->send(
    (new SendRequestDTO())
        ->setTo('contact@youremailapi.com')
        ->setVariables([
            '%example%' => 'Some text here'
        ])
        ->setSubject('Some subject')
        ->setSmtpAccount('<YOUR SMTP ACCOUNT TOKEN>')
        ->setTemplate('<YOUR TEMPLATE TOKEN>')
);
```

## Info

The project is still in development, but right now, the version you're looking at is usable. It is being used productively in some projects.
Soon more functionalities will be implemented that allow a customizable iteration to be able to create accounts and templates directly from your platform.

If you have any questions or suggestions, you can write to this email: [contact@youremailapi.com](mailto:contact@youremailapi.com)
