<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USERNAME', fields: ['username'])]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Assert\Length(
        min: 2,
        max: 16,
        minMessage: 'Your username must be at least {{ limit }} characters long',
        maxMessage: 'Your username cannot be longer than {{ limit }} characters',
    )]
    private ?string $username = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\Length(
        min: 6,
        max: 60,
        minMessage: 'Your password must be at least {{ limit }} characters long',
        maxMessage: 'Your password cannot be longer than {{ limit }} characters',
    )]
    private ?string $password = null;

    #[ORM\Column]
    #[Assert\Length(
        min: 0,
        max: 9999,
        minMessage: 'Your wallet cannot have less than {{ limit }}',
        maxMessage: 'Your wallet cannot have more than {{ limit }}',
    )]
    private ?int $wallet = null;

    #[ORM\Column(length: 320)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Agent $agent = null;

    /**
     * @var Collection<int, Weapon>
     */
    #[ORM\ManyToMany(targetEntity: Weapon::class, inversedBy: 'UserWeapon')]
    private Collection $UserWeapon;

    public function __construct()
    {
        $this->UserWeapon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getWallet(): ?int
    {
        return $this->wallet;
    }

    public function setWallet(int $wallet): static
    {
        $this->wallet = $wallet;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getAgent(): ?Agent
    {
        return $this->agent;
    }

    public function setAgent(?Agent $agent): static
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * @return Collection<int, Weapon>
     */
    public function getUserWeapon(): Collection
    {
        return $this->UserWeapon;
    }

    public function addUserWeapon(Weapon $userWeapon): static
    {
        if (!$this->UserWeapon->contains($userWeapon)) {
            $this->UserWeapon->add($userWeapon);
        }

        return $this;
    }

    public function removeUserWeapon(Weapon $userWeapon): static
    {
        $this->UserWeapon->removeElement($userWeapon);

        return $this;
    }
}
