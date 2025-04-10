<?php

namespace App\Entity;

use App\Admin\Grid\ProductGrid;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Resource\Metadata as Sylius;
use Sylius\Resource\Model\ResourceInterface;

#[Sylius\AsResource(
    section: 'admin',
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: '/admin',
    operations: [
        new Sylius\Index(grid: ProductGrid::class),
        new Sylius\Create(),
        new Sylius\Update(),
        new Sylius\Delete(),
        new Sylius\Show(),
        new Sylius\BulkDelete(),
        new Sylius\BulkUpdate(),
    ],
)]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var Collection<int, ProductFile>
     */
    #[ORM\ManyToMany(targetEntity: ProductFile::class)]
    private Collection $files;

    public function __construct()
    {
        $this->files = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, ProductFile>
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(ProductFile $file): static
    {
        if (!$this->files->contains($file)) {
            $this->files->add($file);
        }

        return $this;
    }

    public function removeFile(ProductFile $file): static
    {
        $this->files->removeElement($file);

        return $this;
    }
}
