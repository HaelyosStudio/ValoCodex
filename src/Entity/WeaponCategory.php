<?php

namespace App\Entity;

use App\Repository\WeaponCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeaponCategoryRepository::class)]
class WeaponCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    /**
     * @var Collection<int, Weapon>
     */
    #[ORM\OneToMany(targetEntity: Weapon::class, mappedBy: 'weaponCategory', orphanRemoval: true)]
    private Collection $weapon;

    public function __construct()
    {
        $this->weapon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Weapon>
     */
    public function getWeapon(): Collection
    {
        return $this->weapon;
    }

    public function addWeapon(Weapon $weapon): static
    {
        if (!$this->weapon->contains($weapon)) {
            $this->weapon->add($weapon);
            $weapon->setWeaponCategory($this);
        }

        return $this;
    }

    public function removeWeapon(Weapon $weapon): static
    {
        if ($this->weapon->removeElement($weapon)) {
            // set the owning side to null (unless already changed)
            if ($weapon->getWeaponCategory() === $this) {
                $weapon->setWeaponCategory(null);
            }
        }

        return $this;
    }
}
