<?php

namespace App\Entity;

use App\Entity\Profil;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 *  @ApiResource(
 * collectionOperations={
 * "get_apprenants"={
 * "method"="GET",
 * "path"="/apprenants" ,
 * "normalization_context"={"groups":"apprenant:read"},
 * "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 * "access_control_message"="Vous n'avez pas access à cette Ressource",
 * "route_name"="apprenant_liste"
 *
 * },
 *"get_apprenants_id"={
 * "method"="{GET}",
 * "path"="/apprenants/{id}" ,
 * "normalization_context"={"groups":"apprenant:read"},
 * "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 * "access_control_message"="Vous n'avez pas access à cette Ressource",
 * "route_name"="apprenant_recup",
 *
 * },
 *"get_apprenants_id"={
 * "method"="DELETE",
 * "path"="/apprenants/{id}" ,
 * "normalization_context"={"groups":"apprenant:read"},
 * "access_control"="(is_granted('ROLE_ADMIN'))",
 * "access_control_message"="Vous n'avez pas access à cette Ressource",
 * "route_name"="apprenant_delete",
 * },
 * "get_formateurs"={
 * "method"="GET",
 * "path"="/formateurs" ,
 * "normalization_context"={"groups":"formateur:read"},
 * "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_CM'))",
 * "access_control_message"="Vous n'avez pas access à cette Ressource",
 * "route_name"="formateur_liste",
 * },
 * "get_formateurs_id"={
 * "method"="GET",
 * "path"="/formateurs/{id}" ,
 * "normalization_context"={"groups":"formateur:read"},
 * "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_CM'))",
 * "access_control_message"="Vous n'avez pas access à cette Ressource",
 * "route_name"="formateur_id",
 * },
 * "get_admins"={
 * "method"="GET",
 * "path"="/admins" ,
 * "normalization_context"={"groups":"admin:read"},
 * "access_control"="(is_granted('ROLE_ADMIN'))",
 * "access_control_message"="Vous n'avez pas access à cette Ressource",
 * "route_name"="admin_liste",
 * },
 * "get_users"={
 * "method"="{GET|POST}",
 * "path"="/admins/users" ,
 * "normalization_context"={"groups":"admin:read"},
 * "access_control"="(is_granted('ROLE_ADMIN'))",
 * "access_control_message"="Vous n'avez pas access à cette Ressource",
 * "route_name"="user_liste",
 * },
 * "get_admins_id"={
 * "method"="GET",
 * "path"="/admins/{id}" ,
 * "normalization_context"={"groups":"admin:read"},
 * "access_control"="(is_granted('ROLE_ADMIN'))",
 * "access_control_message"="Vous n'avez pas access à cette Ressource",
 * "route_name"="admin_id",
 *
 * }

 * },
 * itemOperations={
 *"get_apprenants_id"={
 * "method"="{PUT}",
 * "path"="/apprenants/{id}" ,
 * "normalization_context"={"groups":"apprenant:read"},
 * "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 * "access_control_message"="Vous n'avez pas access à cette Ressource",
 * "route_name"="apprenant_update",
 *
 * },

 * })
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({""})
     */
    private $email;


    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=true)
     */
    private $profil;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_' . $this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
