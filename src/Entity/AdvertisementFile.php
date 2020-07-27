<?php

namespace App\Entity;

use App\Repository\AdvertisementFileRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

// constraints
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="advertisement_file")
 * @ORM\Entity(repositoryClass=AdvertisementFileRepository::class)
 * @Vich\Uploadable()
 * @ORM\HasLifecycleCallbacks
 */
class AdvertisementFile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @var File
     * @Vich\UploadableField(mapping="ad_picture", fileNameProperty="picture")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @var File
     * @Vich\UploadableField(mapping="ad_video", fileNameProperty="video")
     */
    private $videoFile;

    /**
     * @Assert\Type(
     *     "string",
     *     message="Valeur non conforme."
     * )
     * 
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Vous devez saisir au maximum {{ limit }} caractères.",
     * )
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pictureSize;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Advertisement::class, inversedBy="advertisementFiles")
     */
    private $advertisement;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param File|null $imageFile
     * @return AdvertisementFile
     */
    public function setImageFile(?File $imageFile = null): AdvertisementFile
    {
        $this->imageFile = $imageFile;
        
        if(null !== $imageFile){
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    
    /**
     * Set picture for advertisementFile
     *
     * @param string|null $picture
     * @return AdvertisementFile
     */
    public function setPicture(?string $picture): AdvertisementFile
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * If exist, return the advertisementFile picture or none if not exist
     *
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param File|null $videoFile
     * @return AdvertisementFile
     */
    public function setVideoFile(?File $videoFile = null): AdvertisementFile
    {
        $this->videoFile = $videoFile;
        
        if(null !== $videoFile){
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getVideoFile(): ?File
    {
        return $this->videoFile;
    }
    
    /**
     * Set video for advertisementFile
     *
     * @param string|null $video
     * @return AdvertisementFile
     */
    public function setVideo(?string $video): AdvertisementFile
    {
        $this->video = $video;
        return $this;
    }

    /**
     * If exist, return the advertisementFile video or none if not exist
     *
     * @return string|null
     */
    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function getPictureSize(): ?string
    {
        return $this->pictureSize;
    }

    public function setPictureSize(string $pictureSize): self
    {
        $this->pictureSize = $pictureSize;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * Undocumented function
     *
     * @param \DateTimeInterface $updatedAt
     * @return self
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAdvertisement(): ?Advertisement
    {
        return $this->advertisement;
    }

    public function setAdvertisement(?Advertisement $advertisement): self
    {
        $this->advertisement = $advertisement;

        return $this;
    }


}
