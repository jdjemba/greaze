<?php

namespace App\Entity;

use App\Entity\Trait\BaseTrait;
use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    use BaseTrait;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Artwork $artwork = null;

    /**
     * @var Collection<int, Artist>
     */
    #[ORM\ManyToMany(targetEntity: Artist::class, inversedBy: 'albums')]
    private Collection $artists;

    #[ORM\Column(length: 255)]
    private ?string $releaseDate = null;

    #[ORM\Column]
    private ?bool $isSingle = null;

    #[ORM\Column]
    private array $genreNames = [];

    #[ORM\Column]
    private ?int $trackCount = null;

    /**
     * @var Collection<int, Track>
     */
    #[ORM\OneToMany(targetEntity: Track::class, mappedBy: 'album')]
    private Collection $tracks;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->tracks = new ArrayCollection();
    }

    public function getArtwork(): ?Artwork
    {
        return $this->artwork;
    }

    public function setArtwork(?Artwork $artwork): static
    {
        $this->artwork = $artwork;

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): static
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        $this->artists->removeElement($artist);

        return $this;
    }

    public function getReleaseDate(): ?string
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(string $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function isSingle(): ?bool
    {
        return $this->isSingle;
    }

    public function setSingle(bool $isSingle): static
    {
        $this->isSingle = $isSingle;

        return $this;
    }

    public function getGenreNames(): array
    {
        return $this->genreNames;
    }

    public function setGenreNames(array $genreNames): static
    {
        $this->genreNames = $genreNames;

        return $this;
    }

    public function getTrackCount(): ?int
    {
        return $this->trackCount;
    }

    public function setTrackCount(int $trackCount): static
    {
        $this->trackCount = $trackCount;

        return $this;
    }

    /**
     * @return Collection<int, Track>
     */
    public function getTracks(): Collection
    {
        return $this->tracks;
    }

    public function addTrack(Track $track): static
    {
        if (!$this->tracks->contains($track)) {
            $this->tracks->add($track);
            $track->setAlbum($this);
        }

        return $this;
    }

    public function removeTrack(Track $track): static
    {
        if ($this->tracks->removeElement($track)) {
            // set the owning side to null (unless already changed)
            if ($track->getAlbum() === $this) {
                $track->setAlbum(null);
            }
        }

        return $this;
    }
}
