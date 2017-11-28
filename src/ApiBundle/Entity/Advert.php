<?php

namespace ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Doctrine\ORM\Mapping as ORM;

/**
 * Advert
 * @ExclusionPolicy("all")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="ml_advert")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\AdvertRepository")
 */
class Advert
{
    /**
     * @expose
     * @var arrayCollection
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\Image", cascade={"persist"})
     */
    private $image;
    /**
     * @var arrayCollection
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User", cascade={"persist"})
     */
    private $user;

    /**
     * @var int
     * @expose
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @expose
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     * @expose
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


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
     * Advert constructor.
     */
    public function __construct()
    {
        $this->date = new \Datetime();
        $this->image = new ArrayCollection();
        $this->user = new ArrayCollection();
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

    /**
     * @return ArrayCollection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param ArrayCollection $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function getUserId()
    {
        return null;
    }
    public function setUserId($user_id)
    {
        return null;
    }
}
