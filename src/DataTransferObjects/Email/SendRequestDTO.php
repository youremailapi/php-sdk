<?php

namespace Youremailapi\PhpSdk\DataTransferObjects\Email;

class SendRequestDTO
{
    private string $template;
    private string $smtpAccount;
    private string $subject;
    private string $to;
    private ?array $variables;

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     * @return SendRequestDTO
     */
    public function setTemplate(string $template): SendRequestDTO
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
     * @return SendRequestDTO
     */
    public function setSmtpAccount(string $smtpAccount): SendRequestDTO
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
     * @return SendRequestDTO
     */
    public function setSubject(string $subject): SendRequestDTO
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
     * @return SendRequestDTO
     */
    public function setTo(string $to): SendRequestDTO
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
     * @return SendRequestDTO
     */
    public function setVariables(?array $variables): SendRequestDTO
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
     * @return SendRequestDTO
     */
    public function setBcc(?array $bcc): SendRequestDTO
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
     * @return SendRequestDTO
     */
    public function setReplyTo(?array $replyTo): SendRequestDTO
    {
        $this->replyTo = $replyTo;
        return $this;
    }
    private ?array $bcc;
    private ?array $replyTo;
}