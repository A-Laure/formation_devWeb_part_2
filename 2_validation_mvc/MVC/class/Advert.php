<?php

class Advert extends CoreEntity
{


  # Propriétés

  private int $jobAdvertId;
  private int $userId;
  private string $jobLabel;
  private string $jobEmail;
  private string $jobContractType;
  private string $jobDescription;
  private string $jobAdvantages;
  private string $jobTown;
  private string $jobStatus;
  private array $skills = []; // Ajout de la liste de compétences
  private array $networks = []; // Ajout de la liste de compétences
 



  # GETTERS

 public function getJobAdvertId(): int {return $this->jobAdvertId;}

	public function getUserId(): int {return $this->userId;}

	public function getJobLabel(): string {return $this->jobLabel;}

	public function getJobEmail(): string {return $this->jobEmail;}

	public function getJobContractType(): string {return $this->jobContractType;}

	public function getJobDescription(): string {return $this->jobDescription;}

	public function getJobAdvantages(): string {return $this->jobAdvantages;}

	public function getJobTown(): string {return $this->jobTown;}

	public function getJobStatus(): string {return $this->jobStatus;}
  public function getSkills(): array { return $this->skills; } 
  public function getNetworks(): array { return $this->networks; } 

	

	
	
	

	
  # SETTERS

public function setJobAdvertId(int $jobAdvertId): void {$this->jobAdvertId = $jobAdvertId;}

	public function setUserId(int $userId): void {$this->userId = $userId;}

	public function setJobLabel(string $jobLabel): void {$this->jobLabel = $jobLabel;}

	public function setJobEmail(string $jobEmail): void {$this->jobEmail = $jobEmail;}

	public function setJobContractType(string $jobContractType): void {$this->jobContractType = $jobContractType;}

	public function setJobDescription(string $jobDescription): void {$this->jobDescription = $jobDescription;}

	public function setJobAdvantages(string $jobAdvantages): void {$this->jobAdvantages = $jobAdvantages;}

	public function setJobTown(string $jobTown): void {$this->jobTown = $jobTown;}

	public function setJobStatus(string $jobStatus): void {$this->jobStatus = $jobStatus;}

    // Setter pour ajouter des compétences
    public function setSkills(array $skills): void {
      $this->skills = $skills;
    }
   
    public function setNetworks(array $networks): void {
      $this->networks = $networks;
    }
  }




