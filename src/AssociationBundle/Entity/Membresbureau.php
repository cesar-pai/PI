<?php

namespace AssociationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Membresbureau
 *
 * @ORM\Table(name="membresbureau", indexes={@ORM\Index(name="fk_membresbureau_bureaux1_idx", columns={"bureaux_id"}), @ORM\Index(name="fk_membresbureau_role1_idx", columns={"roles_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Membresbureau
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45,nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=45,nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=80,nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=45,nullable=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=45,nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="profession", type="string", length=45,nullable=true)
     */
    private $profession;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \AssociationBundle\Entity\Bureaux
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Bureaux")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bureaux_id", referencedColumnName="id")
     * })
     */
    private $bureaux;

    /**
     * @var \AssociationBundle\Entity\Roles
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Roles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="roles_id", referencedColumnName="id")
     * })
     */
    private $roles;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @param string $profession
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \Bureaux
     */
    public function getBureaux()
    {
        return $this->bureaux;
    }

    /**
     * @param \Bureaux $bureaux
     */
    public function setBureaux($bureaux)
    {
        $this->bureaux = $bureaux;
    }

    /**
     * @return \Roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param \Roles $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }
}
