<?php

namespace App\Entity;

use App\Repository\PriceInfosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PriceInfosRepository::class)]
class PriceInfos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $eth_price = null;

    #[ORM\ManyToOne(inversedBy: 'priceInfos')]
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

    public function getEthPrice(): ?float
    {
        return $this->eth_price;
    }

    public function setEthPrice(float $eth_price): static
    {
        $this->eth_price = $eth_price;

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
