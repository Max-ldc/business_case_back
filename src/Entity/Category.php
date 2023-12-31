<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: NFT::class, inversedBy: 'categories')]
    private Collection $NFT;

    public function __construct()
    {
        $this->NFT = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, NFT>
     */
    public function getNFT(): Collection
    {
        return $this->NFT;
    }

    public function addNFT(NFT $nFT): static
    {
        if (!$this->NFT->contains($nFT)) {
            $this->NFT->add($nFT);
        }

        return $this;
    }

    public function removeNFT(NFT $nFT): static
    {
        $this->NFT->removeElement($nFT);

        return $this;
    }
}
