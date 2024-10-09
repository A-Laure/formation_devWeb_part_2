<?php

class Advert extends CoreEntity
{


  # Propriétés

  private int $jobAdvertId;
  private string $jobLabel;
  private string $jobEmail;
  private string $jobContractType;
  private string $jobDescription;
  private string $jobAdvantages;
  private string $jobTown;
  private string $jobStatus;
  private array $skills = []; 
  private array $networks = []; 



  # GETTERS

 public function getJobAdvertId(): int {return $this->jobAdvertId;}

	public function getJobLabel(): string {return $this->jobLabel;}

	public function getJobEmail(): string {return $this->jobEmail;}

	public function getJobContractType(): string {return $this->jobContractType;}

	public function getJobDescription(): string {return $this->jobDescription;}

	public function getJobAdvantages(): string {return $this->jobAdvantages;}

	public function getJobTown(): string {return $this->jobTown;}

	public function getJobStatus(): string {return $this->jobStatus;}

	
  public function setNetworks(array $networks)
  {
      $this->networks = $networks;
  }

  public function setSkills(array $skills)
  {
      $this->skills = $skills;
  }

	
	

	
  # SETTERS

public function setJobAdvertId(int $jobAdvertId): void {$this->jobAdvertId = $jobAdvertId;}

	public function setJobLabel(string $jobLabel): void {$this->jobLabel = $jobLabel;}

	public function setJobEmail(string $jobEmail): void {$this->jobEmail = $jobEmail;}

	public function setJobContractType(string $jobContractType): void {$this->jobContractType = $jobContractType;}

	public function setJobDescription(string $jobDescription): void {$this->jobDescription = $jobDescription;}

	public function setJobAdvantages(string $jobAdvantages): void {$this->jobAdvantages = $jobAdvantages;}

	public function setJobTown(string $jobTown): void {$this->jobTown = $jobTown;}

	public function setJobStatus(string $jobStatus): void {$this->jobStatus = $jobStatus;}
	

  public function getSkills(): array  {return $this->skills;  }
  
  public function getNetworks(): array  {return $this->networks;
    }


	
	


}