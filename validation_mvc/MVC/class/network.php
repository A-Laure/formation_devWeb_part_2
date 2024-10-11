<?php

class networks extends CoreEntity
{


  # Propriétés

  private int $networkId;
  private string $networkLabel;



  # GETTERS

  public function getNetworkId(): int
  {
    return $this->networkId;
  }

  public function getNetworkLabel(): string
  {
    return $this->networkLabel;
  }


  # SETTERS

  public function setNetworkId(int $networkId): void
  {
    $this->networkId = $networkId;
  }

  public function setNetworkLabel(string $networkLabel): void
  {
    $this->networkLabel = $networkLabel;
  }
}
