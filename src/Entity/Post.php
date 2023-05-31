<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // #[ORM\Column(length: 255)]
    // private ?string $title = null;

    // #[ORM\Column(length: 255)]
    // private ?string $type = null;

    // #[ORM\Column(type: Types::TEXT)]
    // private ?string $description = null;

    // #[ORM\Column(length: 255, nullable: true)]
    // private ?string $file = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creation_date = null;

    // #[ORM\Column(length: 255)]
    // private ?string $url = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Interaction::class, orphanRemoval: true)]
    private Collection $interactions;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $nombre_producto = null;

    #[ORM\Column(nullable: true)]
    private ?int $costo_unitario = null;

    #[ORM\Column]
    private ?int $existencia = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $unidad_medida = null;

    public function __construct()
    {
        $this->interactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getTitle(): ?string
    // {
    //     return $this->title;
    // }

    // public function setTitle(string $title): self
    // {
    //     $this->title = $title;

    //     return $this;
    // }

    // public function getType(): ?string
    // {
    //     return $this->type;
    // }

    // public function setType(string $type): self
    // {
    //     $this->type = $type;

    //     return $this;
    // }

    // public function getDescription(): ?string
    // {
    //     return $this->description;
    // }

    // public function setDescription(string $description): self
    // {
    //     $this->description = $description;

    //     return $this;
    // }

    // public function getFile(): ?string
    // {
    //     return $this->file;
    // }

    // public function setFile(?string $file): self
    // {
    //     $this->file = $file;

    //     return $this;
    // }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    // public function getUrl(): ?string
    // {
    //     return $this->url;
    // }

    // public function setUrl(string $url): self
    // {
    //     $this->url = $url;

    //     return $this;
    // }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Interaction>
     */
    public function getInteractions(): Collection
    {
        return $this->interactions;
    }

    public function addInteraction(Interaction $interaction): self
    {
        if (!$this->interactions->contains($interaction)) {
            $this->interactions->add($interaction);
            $interaction->setPost($this);
        }

        return $this;
    }

    public function removeInteraction(Interaction $interaction): self
    {
        if ($this->interactions->removeElement($interaction)) {
            // set the owning side to null (unless already changed)
            if ($interaction->getPost() === $this) {
                $interaction->setPost(null);
            }
        }

        return $this;
    }

    public function getNombreProducto(): ?string
    {
        return $this->nombre_producto;
    }

    public function setNombreProducto(string $nombre_producto): self
    {
        $this->nombre_producto = $nombre_producto;

        return $this;
    }

    public function getCostoUnitario(): ?int
    {
        return $this->costo_unitario;
    }

    public function setCostoUnitario(int $costo_unitario): self
    {
        $this->costo_unitario = $costo_unitario;

        return $this;
    }

    public function getExistencia(): ?int
    {
        return $this->existencia;
    }

    public function setExistencia(int $existencia): self
    {
        $this->existencia = $existencia;

        return $this;
    }

    public function getUnidadMedida(): ?string
    {
        return $this->unidad_medida;
    }

    public function setUnidadMedida(string $unidad_medida): self
    {
        $this->unidad_medida = $unidad_medida;

        return $this;
    }
}
