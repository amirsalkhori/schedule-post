<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BlogRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read_user"}},
 *     denormalizationContext={"groups"={"write_user"}},
 *     collectionOperations={
 *     "get",
 *     "post",
 *      },
 *     itemOperations={
 *     "get",
 *     "delete"={"security"="is_granted('ROLE_USER')"},
 *     "put"={"security"="is_granted('ROLE_USER')"},
 *     }
 * )
 * @ORM\Entity(repositoryClass=BlogRepository::class)
 */
class Blog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read_user"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read_user", "write_user"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read_user", "write_user"})
     */
    private $body;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read_user", "write_user"})
     */
    private $schedule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getSchedule(): ?\DateTimeInterface
    {
        return $this->schedule;
    }

    public function setSchedule(?\DateTimeInterface $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }
}
