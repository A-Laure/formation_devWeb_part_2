<?php

class User extends CoreEntity
{

  # Propriétés
  private int $userId;
  private string $userStatus; // entreprise, étudiant, admin
  private string $userEnvrnt; // Designer, 
  private string $userEmail;
  private string $userPwd;
  private string $userFirstName;
  private string $userLastName;
  private string $userTextaera;
  private string $userSpeciality;
  private string $userAdr1;
  private string $userAdr2;
  private string $userTown;
  private int $userCp;
  private array $skills = []; 
  private array $networks = []; 





  # Getters

public function getUserId(): int {return $this->userId;}

	public function getUserStatus(): string {return $this->userStatus;}

	public function getUserEnvrnt(): string {return $this->userEnvrnt;}

	public function getUserEmail(): string {return $this->userEmail;}

	public function getUserPwd(): string {return $this->userPwd;}

	public function getUserFirstName(): string {return $this->userFirstName;}

	public function getUserLastName(): string {return $this->userLastName;}

	public function getUserTextaera(): string {return $this->userTextaera;}

	public function getUserSpeciality(): string {return $this->userSpeciality;}

	public function getUserAdr1(): string {return $this->userAdr1;}

	public function getUserAdr2(): string {return $this->userAdr2;}

	public function getUserTown(): string {return $this->userTown;}

	public function getUserCp(): int {return $this->userCp;}

  public function setNetworks(array $networks)
    {
        $this->networks = $networks;
    }

    public function setSkills(array $skills)
    {
        $this->skills = $skills;
    }

	

	
	
  # Setters
public function setUserId(int $userId): void {$this->userId = $userId;}

	public function setUserStatus(string $userStatus): void {$this->userStatus = $userStatus;}

	public function setUserEnvrnt(string $userEnvrnt): void {$this->userEnvrnt = $userEnvrnt;}

	public function setUserEmail(string $userEmail): void {$this->userEmail = $userEmail;}

	public function setUserPwd(string $userPwd): void {$this->userPwd = $userPwd;}

	public function setUserFirstName(string $userFirstName): void {$this->userFirstName = $userFirstName;}

	public function setUserLastName(string $userLastName): void {$this->userLastName = $userLastName;}

	public function setUserTextaera(string $userTextaera): void {$this->userTextaera = $userTextaera;}

	public function setUserSpeciality(string $userSpeciality): void {$this->userSpeciality = $userSpeciality;}

	public function setUserAdr1(string $userAdr1): void {$this->userAdr1 = $userAdr1;}

	public function setUserAdr2(string $userAdr2): void {$this->userAdr2 = $userAdr2;}

	public function setUserTown(string $userTown): void {$this->userTown = $userTown;}

	public function setUserCp(int $userCp): void {$this->userCp = $userCp;}

  public function getSkills(): array  {return $this->skills;  }
  
  public function getNetworks(): array  {return $this->networks;
    }

	
	
}