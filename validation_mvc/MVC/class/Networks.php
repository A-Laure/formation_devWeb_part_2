<?php

class Networks extends CoreEntity
{


  # Propriétés

  private int $networkId;
  private string $networkLabel;
  /* private ?string $networkLink;
 */
  public function __construct(array $data = [])
  {
      $this->networkId = $data['networkId'] ?? 0;
      $this->networkLabel = $data['networkLabel'] ?? '';
      /* $this->networkLink = $data['networkLink'] ?? null; */
  }

  # GETTERS

 public function getNetworkId(): int {return $this->networkId;}

	public function getNetworkLabel(): string {return $this->networkLabel;}

/* 	public function getNetworkLink(): ?string {return $this->networkLink  ?? null;} */

	


  # SETTERS

  public function setNetworkId(int $networkId): void {$this->networkId = $networkId;}

	public function setNetworkLabel(string $networkLabel): void {$this->networkLabel = $networkLabel;}
/* 
	public function setNetworkLink(string $networkLink): void {$this->networkLink = $networkLink;} */

	
}
