<?php

namespace Pixel\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Sulu\Component\Persistence\Model\AuditableInterface;
use Sulu\Component\Persistence\Model\AuditableTrait;
use Pixel\GalleryBundle\Entity\Album;
use Pixel\GalleryBundle\Repository\AlbumRepository;


#[ORM\Entity(repositoryClass: AlbumRepository::class)]
#[ORM\Table(name: 'gallery_album_translation')]
#[Serializer\ExclusionPolicy('all')]

class AlbumTranslation implements AuditableInterface
{
    use AuditableTrait;

    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: 'integer')]
    #[Serializer\Expose()]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Album::class, inversedBy: 'translations')]
    #[ORM\JoinColumn(nullable: false)]
    private Album $album;

    #[ORM\Column(type: 'string', length: 5)]
    private string $locale;


    #[ORM\Column(type: 'string', length: 255)]
    #[Serializer\Expose()]
    private string $name;


    #[ORM\Column(type: 'text', nullable: true)]
    #[Serializer\Expose()]
    private ?string $description;


    #[ORM\Column(type: 'string', length: 255)]
    #[Serializer\Expose()]
    private string $routePath;

    #[ORM\Column(type: 'json', nullable: true)]
    #[Serializer\Expose()]
    private ?array $seo = null;


    public function __construct(Album $album, string $locale)
    {
        $this->album = $album;
        $this->locale = $locale;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlbum(): Album
    {
        return $this->album;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getRoutePath(): string
    {
        return $this->routePath ?? '';
    }

    public function setRoutePath(string $routePath): void
    {
        $this->routePath = $routePath;
    }

    /**
    #[return array<mixed>|null
     */
    public function getSeo(): ?array
    {
        return $this->seo;
    }

    /**
    #[param array<mixed>|null $seo
     */
    public function setSeo(?array $seo): void
    {
        $this->seo = $seo;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }
}
