<?php

class Display extends CoreEntity
{
    # Propriétés
    private int $userId;
    private ?int $networkId; 
    private ?string $networkLink;

    public function __construct(array $data = [])
    {
        $this->userId = $data['userId'] ?? 0;
        $this->networkId = isset($data['networkId']) ? (int)$data['networkId'] : null; // Gestion nullable
        $this->networkLink = $data['networkLink'] ?? null;
    }

    # GETTERS
    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getNetworkId(): ?int 
    {
        return $this->networkId;
    }

    public function getNetworkLink(): ?string
    {
        return $this->networkLink;
    }

    # SETTERS
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setNetworkId(?int $networkId): void 
    {
        $this->networkId = $networkId;
    }

    public function setNetworkLink(?string $networkLink): void // Gestion nullable
    {
        $this->networkLink = $networkLink;
    }
}
