<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Category
{
    #[ORM\Id]//indica que es la clave primaria
    #[ORM\GeneratedValue]// genera automaticamente el valor de la clave primaria (id)
    #[ORM\Column] // mapea una propiedad de tu clase a una columna específica
    private ?int $id = null;

    #[ORM\Column(lenght: 255)]
    private ?string $name = null;

    #[ORM\Column(lenght: 20)]
    private ?string $iconKey = null;

    //Define relacion uno a muchos, entre la entidad actual 'Category' y otra entidad 'FortuneCookie'
    #[ORM\OneToMany(mappedBy: 'category', targetEntity: FortuneCookie::class)]
    private Collection $fortuneCookies;

    public function __construct()
    {
        $this->fortuneCookies = new ArrayCollection();
    }

    //Métodos getter y setters
    public function getId(): ?int
    {
        return $this->id;
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

    public function getIconKey(): ?string
    {
        return $this->iconKey;
    }

    public function setIconKey(string $iconKey): self
    {
        $this->iconKey = $iconKey;

        return $this;
    }

    /**
     * @return Collection<int, FortuneCookie>
     */
    public function getFortuneCookies(): Collection
    {
        return $this->fortuneCookies;
    }

    public function addFortuneCookie(FortuneCookie $fortuneCookie): self
    {
        if (!$this->fortuneCookies->contains($fortuneCookie)) {// Busca un valor específico en toda la colección
            $this->fortuneCookies->add($fortuneCookie);// Añade un elemento a la colección
            $fortuneCookie->setCategory($this);
        }

        return $this;
    }

    public function removeFortuneCookie(FortuneCookie $fortuneCookie): self
    {
        if ($this->fortuneCookies->removeElement($fortuneCookie)) {
            // set the owning side to null (unless already changed)
            if ($fortuneCookie->getCategory() === $this) {
                $fortuneCookie->setCategory(null);
            }
        }

        return $this;
    }
}