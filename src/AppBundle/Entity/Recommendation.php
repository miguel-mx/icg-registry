<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recommendation
 *
 * @ORM\Table(name="recommendation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecommendationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Recommendation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="letter", type="text", nullable=true)
     */
    private $letter;

    /**
     * One Registro has One Recomendacion.
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Registry", inversedBy="recomendation")
     * @ORM\JoinColumn(name="registro_id", referencedColumnName="id")
     */
    private $registro;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set letter
     *
     * @param string $letter
     *
     * @return Recommendation
     */
    public function setLetter($letter)
    {
        $this->letter = $letter;

        return $this;
    }

    /**
     * Get letter
     *
     * @return string
     */
    public function getLetter()
    {
        return $this->letter;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedValue()
    {
        $this->created = new \DateTime();
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

     /**
     * @return mixed
     */
    public function getRegistro()
    {
        return $this->registro;
    }

    /**
     * @param mixed $registro
     */
    public function setRegistro($registro)
    {
        $this->registro = $registro;
    }

}

