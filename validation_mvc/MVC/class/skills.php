<?php

class Skills extends CoreEntity
{


  # Propriétés

  private int $skillId;
  private string $skillLabel;



  # GETTERS

  public function getSkillId(): int
  {
    return $this->skillId;
  }

  public function getSkillLabel(): string
  {
    return $this->skillLabel;
  }


  # SETTERS

  public function setSkillId(int $skillId): void
  {
    $this->skillId = $skillId;
  }

  public function setSkillLabel(string $skillLabel): void
  {
    $this->skillLabel = $skillLabel;
  }
}
