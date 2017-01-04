<?php

namespace AssociationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Associations
 *
 * @ORM\Table(name="associations", uniqueConstraints={@ORM\UniqueConstraint(name="numassoc_UNIQUE", columns={"numassoc"})}, indexes={@ORM\Index(name="fk_associations_services1_idx", columns={"services_id"}), @ORM\Index(name="fk_associations_users1_idx", columns={"users_id"})})
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"numassoc", "siren", "nom"},
 *     message="Cette valeur existe déjà !"
 * )
 * @ORM\HasLifecycleCallbacks
 */
class Associations
{
    /**
     * @var string
     *
     * @ORM\Column(name="numassoc", type="string")
     * @ORM\Id
     */
    private $numassoc;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="sigle", type="string", length=45,nullable=true)
     */
    private $sigle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecrea", type="date")
     */
    private $datecrea;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=100)
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=100)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=45,nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=60,nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="horaires", type="string", length=45,nullable=true)
     */
    private $horaires;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datepubJO", type="date",nullable=true)
     */
    private $datepubjo;

    /**
     * @var string
     *
     * @ORM\Column(name="villedecl", type="string", length=45,nullable=true)
     */
    private $villedecl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedecl", type="date",nullable=true)
     */
    private $datedecl;

    /**
     * @var string
     *
     * @ORM\Column(name="SIREN", type="string", length=45)
     */
    private $siren;

    /**
     * @var string
     *
     * @ORM\Column(name="SIRET", type="string", length=45,nullable=true)
     */
    private $siret;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_utilitepub", type="date",nullable=true)
     */
    private $dateUtilitepub;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_sportive", type="boolean")
     */
    private $isSportive = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validee", type="boolean")
     */
    private $validee = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var \UserBundle\Entity\Users
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Services")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="services_id", referencedColumnName="id")
     * })
     */
    private $services;

    /**
     * @var \UserBundle\Entity\Users
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="users_id", referencedColumnName="id")
     * })
     */
    private $users;

    /**
     * @return int
     */
    public function getNumassoc()
    {
        return $this->numassoc;
    }

    /**
     * @param int $numassoc
     */
    public function setNumassoc($numassoc)
    {
        $this->numassoc = $numassoc;
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
    public function getSigle()
    {
        return $this->sigle;
    }

    /**
     * @param string $sigle
     */
    public function setSigle($sigle)
    {
        $this->sigle = $sigle;
    }

    /**
     * @return \DateTime
     */
    public function getDatecrea()
    {
        return $this->datecrea;
    }

    /**
     * @param \DateTime $datecrea
     */
    public function setDatecrea($datecrea)
    {
        $this->datecrea = $datecrea;
    }

    /**
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * @param string $objet
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;
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
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return string
     */
    public function getHoraires()
    {
        return $this->horaires;
    }

    /**
     * @param string $horaires
     */
    public function setHoraires($horaires)
    {
        $this->horaires = $horaires;
    }

    /**
     * @return \DateTime
     */
    public function getDatepubjo()
    {
        return $this->datepubjo;
    }

    /**
     * @param \DateTime $datepubjo
     */
    public function setDatepubjo($datepubjo)
    {
        $this->datepubjo = $datepubjo;
    }

    /**
     * @return string
     */
    public function getVilledecl()
    {
        return $this->villedecl;
    }

    /**
     * @param string $villedecl
     */
    public function setVilledecl($villedecl)
    {
        $this->villedecl = $villedecl;
    }

    /**
     * @return \DateTime
     */
    public function getDatedecl()
    {
        return $this->datedecl;
    }

    /**
     * @param \DateTime $datedecl
     */
    public function setDatedecl($datedecl)
    {
        $this->datedecl = $datedecl;
    }

    /**
     * @return string
     */
    public function getSiren()
    {
        return $this->siren;
    }

    /**
     * @param string $siren
     */
    public function setSiren($siren)
    {
        $this->siren = $siren;
    }

    /**
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * @param string $siret
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    }

    /**
     * @return \DateTime
     */
    public function getDateUtilitepub()
    {
        return $this->dateUtilitepub;
    }

    /**
     * @param \DateTime $dateUtilitepub
     */
    public function setDateUtilitepub($dateUtilitepub)
    {
        $this->dateUtilitepub = $dateUtilitepub;
    }

    /**
     * @return boolean
     */
    public function isIsSportive()
    {
        return $this->isSportive;
    }

    /**
     * @param boolean $isSportive
     */
    public function setIsSportive($isSportive)
    {
        $this->isSportive = $isSportive;
    }

    /**
     * @return boolean
     */
    public function isValidee()
    {
        return $this->validee;
    }

    /**
     * @param boolean $validee
     */
    public function setValidee($validee)
    {
        $this->validee = $validee;
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
     * @return \Services
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param \Services $services
     */
    public function setServices($services)
    {
        $this->services = $services;
    }

    /**
     * @return \Users
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param \Users $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @return ArrayCollection
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @param ArrayCollection $documents
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;
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


    /**
     * Get isSportive
     *
     * @return boolean
     */
    public function getIsSportive()
    {
        return $this->isSportive;
    }

    /**
     * Get validee
     *
     * @return boolean
     */
    public function getValidee()
    {
        return $this->validee;
    }
}
