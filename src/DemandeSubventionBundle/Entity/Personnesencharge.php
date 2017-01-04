<?php

namespace DemandeSubventionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personnesencharge
 *
 * @ORM\Table(name="personnesencharge", indexes={@ORM\Index(name="fk_personne_en_charge_demandes_subvention1_idx", columns={"demandessubvention_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Personnesencharge
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
     * @ORM\Column(name="nom", type="string", length=45)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=45)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="qualite", type="string", length=45, nullable=true)
     */
    private $qualite;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=80, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=45, nullable=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=45, nullable=true)
     */
    private $telephone;

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
     * @var \DemandeSubventionBundle\Entity\Demandessubvention
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Demandessubvention")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="demandessubvention_id", referencedColumnName="id")
     * })
     */
    private $demandessubvention;

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
    public function getQualite()
    {
        return $this->qualite;
    }

    /**
     * @param string $qualite
     */
    public function setQualite($qualite)
    {
        $this->qualite = $qualite;
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
     * @return \Demandessubvention
     */
    public function getDemandessubvention()
    {
        return $this->demandessubvention;
    }

    /**
     * @param \Demandessubvention $demandessubvention
     */
    public function setDemandessubvention($demandessubvention)
    {
        $this->demandessubvention = $demandessubvention;
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
