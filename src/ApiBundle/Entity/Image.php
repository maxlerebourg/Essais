<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ExclusionPolicy("all")
 * @ORM\Table(name="ml_image")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ImageRepository")
 *
 */
class Image
{
    /**
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\Advert")
     */
    private $advert;

    /**
     * @return mixed
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * @param mixed $advert
     */
    public function setAdvert($advert)
    {
        $this->advert = $advert;
    }


    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @expose
     */
    private $id;

    /**
     * @ORM\Column(name="url", type="string", length=255)
     * @expose
     */
    private $url;

    /**
     * @expose
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->advert = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add advert
     *
     * @param \ApiBundle\Entity\Advert $advert
     *
     * @return Image
     */
    public function addAdvert(\ApiBundle\Entity\Advert $advert)
    {
        $this->advert[] = $advert;

        return $this;
    }

    /**
     * Remove advert
     *
     * @param \ApiBundle\Entity\Advert $advert
     */
    public function removeAdvert(\ApiBundle\Entity\Advert $advert)
    {
        $this->advert->removeElement($advert);
    }
}
