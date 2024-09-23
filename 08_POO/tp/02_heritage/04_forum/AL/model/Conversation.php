<?php


class Conversation
{

  private int $convId;
  private string $convDate;
  private int $conStatus;

  public function __construct(int $convId, string $convDate, int $conStatus)
  {
    $this->convId = $convId;
    $this->convDate = $convDate;
    $this->conStatus = $conStatus;
  }


  # GETTERS

  public function getConvId(): int
  {
    return $this->convId;
  }

  public function getConvDate(): string
  {
    return $this->convDate;
  }

  public function getConStatus(): int
  {
    return $this->conStatus;
  }



  # SETTERS

  public function setConvId(int $convId): void
  {
    $this->convId = $convId;
  }

  public function setConvDate(string $convDate): void
  {
    $this->convDate = $convDate;
  }

  public function setConStatus(int $conStatus): void
  {
    $this->conStatus = $conStatus;
  }
}
