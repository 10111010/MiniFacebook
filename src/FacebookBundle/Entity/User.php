<?php

namespace FacebookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;



/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    protected $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    protected $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="age" , type="integer")
     */
    protected $age;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=255)
     */
    protected $race;

    /**
     * @var string
     *
     * @ORM\Column(name="nourriture", type="string", length=255)
     */
    protected $nourriture;

   /**
    *
    * @ORM\ManyToMany(targetEntity="User",  inversedBy="id")
    * @ORM\JoinTable(name="user_amis",
    * joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
    * inverseJoinColumns={@ORM\JoinColumn(name="user_amis_id", referencedColumnName="id")}
    * )
    */
    private $amis;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return User
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set race
     *
     * @param string $race
     *
     * @return User
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set nourriture
     *
     * @param string $nourriture
     *
     * @return User
     */
    public function setNourriture($nourriture)
    {
        $this->nourriture = $nourriture;

        return $this;
    }

    /**
     * Get nourriture
     *
     * @return string
     */
    public function getNourriture()
    {
        return $this->nourriture;
    }



    /**
     * Add ami
     *
     * @param \FacebookBundle\Entity\User $ami
     *
     * @return User
     */
    public function addAmi(\FacebookBundle\Entity\User $ami)
    {
        $this->amis[] = $ami;

        return $this;
    }

    /**
     * Remove ami
     *
     * @param \FacebookBundle\Entity\User $ami
     */
    public function removeAmi(\FacebookBundle\Entity\User $ami)
    {
        $this->amis->removeElement($ami);
    }

    /**
     * Get amis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAmis()
    {
        return $this->amis;
    }
}
