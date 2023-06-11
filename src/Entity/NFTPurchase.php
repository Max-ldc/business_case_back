<?php

namespace App\Entity;

use App\Repository\NFTPurchaseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NFTPurchaseRepository::class)]
class NFTPurchase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $eth_purchase_price = null;

    #[ORM\Column]
    private ?float $eur_purchase_price = null;

    #[ORM\ManyToOne(inversedBy: 'purchases')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'purchases')]
    #[ORM\JoinColumn(nullable: false)]
    private ?NFT $nft = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getEthPurchasePrice(): ?float
    {
        return $this->eth_purchase_price;
    }

    public function setEthPurchasePrice(float $eth_purchase_price): static
    {
        $this->eth_purchase_price = $eth_purchase_price;

        return $this;
    }

    public function getEurPurchasePrice(): ?float
    {
        return $this->eur_purchase_price;
    }

    public function setEurPurchasePrice(float $eur_purchase_price): static
    {
        $this->eur_purchase_price = $eur_purchase_price;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getNft(): ?NFT
    {
        return $this->nft;
    }

    public function setNft(?NFT $nft): static
    {
        $this->nft = $nft;

        return $this;
    }
}
