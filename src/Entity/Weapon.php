<?php

namespace App\Entity;

use App\Repository\WeaponRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: WeaponRepository::class)]
class Weapon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 100)]
    public ?string $name = null;

    #[ORM\Column]
    public ?int $mag_capacity = null;

    #[ORM\Column(length: 6)]
    public ?string $wall_penetration = null;

    #[ORM\Column]
    public ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'weapon')]
    #[ORM\JoinColumn(nullable: false)]
    public ?WeaponCategory $weaponCategory = null;

    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'UserWeapon')]
    public Collection $UserWeapon;

    #[ORM\Column]
    public ?float $primary_fire = null;

    #[ORM\Column]
    public ?float $secondary_fire = null;

    public function __construct()
    {
        $this->UserWeapon = new ArrayCollection();
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

    public function getMagCapacity(): ?int
    {
        return $this->mag_capacity;
    }

    public function setMagCapacity(int $mag_capacity): static
    {
        $this->mag_capacity = $mag_capacity;

        return $this;
    }

    public function getWallPenetration(): ?string
    {
        return $this->wall_penetration;
    }

    public function setWallPenetration(string $wall_penetration): static
    {
        $this->wall_penetration = $wall_penetration;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getWeaponCategory(): ?WeaponCategory
    {
        return $this->weaponCategory;
    }

    public function setWeaponCategory(?WeaponCategory $weaponCategory): static
    {
        $this->weaponCategory = $weaponCategory;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserWeapon(): Collection
    {
        return $this->UserWeapon;
    }

    public function addUserWeapon(User $userWeapon): static
    {
        if (!$this->UserWeapon->contains($userWeapon)) {
            $this->UserWeapon->add($userWeapon);
            $userWeapon->addUserWeapon($this);
        }

        return $this;
    }

    public function removeUserWeapon(User $userWeapon): static
    {
        if ($this->UserWeapon->removeElement($userWeapon)) {
            $userWeapon->removeUserWeapon($this);
        }

        return $this;
    }

    public function getPrimaryFire(): ?float
    {
        return $this->primary_fire;
    }

    public function setPrimaryFire(float $primary_fire): static
    {
        $this->primary_fire = $primary_fire;

        return $this;
    }

    public function getSecondaryFire(): ?float
    {
        return $this->secondary_fire;
    }

    public function setSecondaryFire(float $secondary_fire): static
    {
        $this->secondary_fire = $secondary_fire;

        return $this;
    }
}
