<?php

namespace App\Entity;

use App\Repository\NFTRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NFTRepository::class)]
class NFT
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $drop_date = null;

    #[ORM\OneToMany(mappedBy: 'nft', targetEntity: NFTPurchase::class)]
    private Collection $purchases;

    #[ORM\OneToMany(mappedBy: 'nft', targetEntity: PriceInfos::class)]
    private Collection $priceInfos;

    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'NFT')]
    private Collection $categories;

    public function __construct()
    {
        $this->purchases = new ArrayCollection();
        $this->priceInfos = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getDropDate(): ?\DateTimeInterface
    {
        return $this->drop_date;
    }

    public function setDropDate(\DateTimeInterface $drop_date): static
    {
        $this->drop_date = $drop_date;

        return $this;
    }

    /**
     * @return Collection<int, NFTPurchase>
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(NFTPurchase $purchase): static
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases->add($purchase);
            $purchase->setNft($this);
        }

        return $this;
    }

    public function removePurchase(NFTPurchase $purchase): static
    {
        if ($this->purchases->removeElement($purchase)) {
            // set the owning side to null (unless already changed)
            if ($purchase->getNft() === $this) {
                $purchase->setNft(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PriceInfos>
     */
    public function getPriceInfos(): Collection
    {
        return $this->priceInfos;
    }

    public function addPriceInfo(PriceInfos $priceInfo): static
    {
        if (!$this->priceInfos->contains($priceInfo)) {
            $this->priceInfos->add($priceInfo);
            $priceInfo->setNft($this);
        }

        return $this;
    }

    public function removePriceInfo(PriceInfos $priceInfo): static
    {
        if ($this->priceInfos->removeElement($priceInfo)) {
            // set the owning side to null (unless already changed)
            if ($priceInfo->getNft() === $this) {
                $priceInfo->setNft(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addNFT($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeNFT($this);
        }

        return $this;
    }
}
