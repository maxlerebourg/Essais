<?php

namespace ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Advert
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="ml_advert")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\AdvertRepository")
 */
class Advert
{
    /**
     * @var arrayCollection
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\Image", cascade={"persist"})
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get date
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set title
     * @param string $title
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     * @param string $author
     * @return Advert
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get author
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Advert constructor.
     */
    public function __construct()
    {
        $this->date = new \Datetime();
        $this->image = new ArrayCollection();
    }

    /**
     * Get image
     * @return ArrayCollection
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     * @param ArrayCollection $image
     * @return Advert
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }
    public function addImage(Image $image)
    {
        $this->image->add($image);
    }
    public function removeImage(Image $image)
    {
        $this->image->$this->removeElement($image);
    }



    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Advert
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
}
