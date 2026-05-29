<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:: FortuneCookieRepository::class)]
class FortuneCookie
{
    #[ORM\Id]//indica que es la clave primaria
    #[ORM\GeneratedValue]// genera automaticamente el valor de la clave primaria (id)
    #[ORM\Column] // mapea una propiedad de tu clase a una columna específica
    private ?int $id = null;

    #[ORM\Column(lenght: 255)]
    private ?string $fortune = null;

    #[ORM\Column]
    private ?int $numberPrinted = null;

    #[ORM\Column]
    private bool $discontinued = false;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(inversedBy: 'fortuneCookies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    // DateTimeInmutable Maneja fecha y horas inmutables, una vez que se crea el objeto, su valor nunca cambia,
    // cualquier modificación devuleve un nuevo objeto en lugar de alterar el original
    // la barra invertida indica que se está llamando a una clase ubicada en el espacio de nombres global (root namespace) de php
    /**
     * @param \DateTimeImmutable|null $createdAt
     */
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFortune(): ?string
    {
        return $this->fortune;
    }

    //:self indica que retorna una instacia de la misma clase en la que está definido
    // permite encadenamiento de métodos (methid chaining, permite ejeutar varios métodos de forma consecutiva en una sola línea de código
    // ya que cada método devuelve el objeto listo para el siguiente.
    public function setFortune(string $fortune): self
    {
        $this->fortune = $fortune;

        return $this;
    }

    public function getNumberPrinted(): ?int
    {
        return $this->numberPrinted;
    }

    public function setNumberPrinted(int $numberPrinted): self
    {
        $this->numberPrinted = $numberPrinted;

        return $this;
    }

    public function isDiscontinued(): bool
    {
        return $this->discontinued;
    }

    public function setDiscontinued(bool $discontinued): self
    {
        $this->discontinued = $discontinued;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}