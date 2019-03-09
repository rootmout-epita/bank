<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountsRepository")
 */
class Accounts
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Client;

    /**
     * @ORM\Column(type="integer")
     */
    private $Balance;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Last_Operation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?string
    {
        return $this->Client;
    }

    public function setClient(string $Client): self
    {
        $this->Client = $Client;

        return $this;
    }

    public function getBalance(): ?int
    {
        return $this->Balance;
    }

    public function setBalance(int $Balance): self
    {
        $this->Balance = $Balance;

        return $this;
    }

    public function getLastOperation(): ?\DateTimeInterface
    {
        return $this->Last_Operation;
    }

    public function setLastOperation(\DateTimeInterface $Last_Operation): self
    {
        $this->Last_Operation = $Last_Operation;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
