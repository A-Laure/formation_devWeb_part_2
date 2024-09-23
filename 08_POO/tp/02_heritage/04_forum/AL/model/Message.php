<?php



class Message
{

  private int $messageId;
  private string $messageContent;
  private string $messageDate;
  private string $messageHour;
  private int $messageAuthorfk;
  private int $messageConvFk;


  public function __construct(int $messageId, string $messageContent, string $messageDate, string $messageHour, int $messageAuthorfk, int $messageConvFk)
  {
    $this->messageId = $messageId;
    $this->messageContent = $messageContent;
    $this->messageDate = $messageDate;
    $this->messageHour = $messageHour;
    $this->messageAuthorfk = $messageAuthorfk;
    $this->messageConvFk = $messageConvFk;
  }

  # GETTERS

  public function getMessageId(): int
  {
    return $this->messageId;
  }

  public function getMessageContent(): string
  {
    return $this->messageContent;
  }

  public function getMessageDate(): string
  {
    return $this->messageDate;
  }

  public function getMessageHour(): string
  {
    return $this->messageHour;
  }

  public function getMessageAuthorfk(): int
  {
    return $this->messageAuthorfk;
  }

  public function getMessageConvFk(): int
  {
    return $this->messageConvFk;
  }

  # SETTERS

  public function setMessageId(int $messageId): void
  {
    $this->messageId = $messageId;
  }

  public function setMessageContent(string $messageContent): void
  {
    $this->messageContent = $messageContent;
  }

  public function setMessageDate(string $messageDate): void
  {
    $this->messageDate = $messageDate;
  }

  public function setMessageHour(string $messageHour): void
  {
    $this->messageHour = $messageHour;
  }

  public function setMessageAuthorfk(int $messageAuthorfk): void
  {
    $this->messageAuthorfk = $messageAuthorfk;
  }

  public function setMessageConvFk(int $messageConvFk): void
  {
    $this->messageConvFk = $messageConvFk;
  }
}
