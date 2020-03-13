<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Registry
 *
 * @ORM\Table(name="registry")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RegistryRepository")
 */
class Registry
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     *
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     *
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="citizenship", type="string", length=255)
     */
    private $citizenship;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=10)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="affiliation", type="string", length=255)
     */
    private $affiliation;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="interest", type="string", length=255, nullable=true)
     */
    private $interest;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="advisor", type="string", length=255, nullable=true)
     */
    private $advisor;

   /**
     * @var string
     *
     * @ORM\Column(name="advisorEmail", type="string", length=255, nullable=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $advisorEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="speaker", type="string", length=4, nullable=true)
     */
    private $speaker;

    /**
     * @var string
     *
     * @ORM\Column(name="other", type="text", nullable=true)
     */
    private $other;

    /**
     * One registro One Recommendation
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Recommendation", mappedBy="registro")
     */
    private $recommendation;

    /**
     * @Gedmo\Slug(fields={"name", "surname"})
     * @ORM\Column(length=128, unique=false)
     */
    private $slug;

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
     * Set name
     *
     * @param string $name
     *
     * @return Registry
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return Registry
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Registry
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set citizenship
     *
     * @param string $citizenship
     *
     * @return Registry
     */
    public function setCitizenship($citizenship)
    {
        $this->citizenship = $citizenship;

        return $this;
    }

    /**
     * Get citizenship
     *
     * @return string
     */
    public function getCitizenship()
    {
        return $this->citizenship;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Registry
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set affiliation
     *
     * @param string $affiliation
     *
     * @return Registry
     */
    public function setAffiliation($affiliation)
    {
        $this->affiliation = $affiliation;

        return $this;
    }

    /**
     * Get affiliation
     *
     * @return string
     */
    public function getAffiliation()
    {
        return $this->affiliation;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Registry
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set interest
     *
     * @param string $interest
     *
     * @return Registry
     */
    public function setInterest($interest)
    {
        $this->interest = $interest;

        return $this;
    }

    /**
     * Get interest
     *
     * @return string
     */
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Registry
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set advisor
     *
     * @param string $advisor
     *
     * @return Registry
     */
    public function setAdvisor($advisor)
    {
        $this->advisor = $advisor;

        return $this;
    }

    /**
     * Get advisor
     *
     * @return string
     */
    public function getAdvisor()
    {
        return $this->advisor;
    }

    /**
     * Set advisorEmail
     *
     * @param string $advisorEmail
     *
     * @return Registry
     */
    public function setAdvisorEmail($advisorEmail)
    {
        $this->advisorEmail = $advisorEmail;

        return $this;
    }

    /**
     * Get advisorEmail
     *
     * @return string
     */
    public function getAdvisorEmail()
    {
        return $this->advisorEmail;
    }

   /**
     * Set speaker
     *
     * @param string $speaker
     *
     * @return Registry
     */
    public function setSpeaker($speaker)
    {
        $this->speaker = $speaker;

        return $this;
    }

    /**
     * Get speaker
     *
     * @return string
     */
    public function getSpeaker()
    {
        return $this->speaker;
    }

   /**
     * Set other
     *
     * @param string $other
     *
     * @return Registry
     */
    public function setOther($other)
    {
        $this->other = $other;

        return $this;
    }

   /**
     * @return mixed
     */
    public function getRecommendation()
    {
        return $this->recommendation;
    }

    /**
     * @param mixed $recommendation
     */
    public function setRecommendation($recommendation)
    {
        $this->recommendation = $recommendation;
    }

    /**
     * Get other
     *
     * @return string
     */
    public function getOther()
    {
        return $this->other;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }
    public function getSlug()
    {
        return $this->slug;
    }
}

