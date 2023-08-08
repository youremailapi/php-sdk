<?php

namespace Youremailapi\PhpSdk\DataTransferObjects\Email;

/**
 * @author Federico Juretich <fedejuret@gmail.com>
 */
class SendEmailDTO
{
    private string $template;
    private string $smtpAccount;
    private string $subject;
    private string $to;
    private ?array $variables = null;
    private ?array $bcc = null;
    private ?array $replyTo = null;

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     * @return SendEmailDTO
     */
    public function setTemplate(string $template): SendEmailDTO
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return string
     */
    public function getSmtpAccount(): string
    {
        return $this->smtpAccount;
    }

    /**
     * @param string $smtpAccount
     * @return SendEmailDTO
     */
    public function setSmtpAccount(string $smtpAccount): SendEmailDTO
    {
        $this->smtpAccount = $smtpAccount;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return SendEmailDTO
     */
    public function setSubject(string $subject): SendEmailDTO
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     * @return SendEmailDTO
     */
    public function setTo(string $to): SendEmailDTO
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getVariables(): ?array
    {
        return $this->variables;
    }

    /**
     * @param array|null $variables
     * @return SendEmailDTO
     */
    public function setVariables(?array $variables): SendEmailDTO
    {
        $this->variables = $variables;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getBcc(): ?array
    {
        return $this->bcc;
    }

    /**
     * @param array|null $bcc
     * @return SendEmailDTO
     */
    public function setBcc(?array $bcc): SendEmailDTO
    {
        $this->bcc = $bcc;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getReplyTo(): ?array
    {
        return $this->replyTo;
    }

    /**
     * @param array|null $replyTo
     * @return SendEmailDTO
     */
    public function setReplyTo(?array $replyTo): SendEmailDTO
    {
        $this->replyTo = $replyTo;
        return $this;
    }
}
