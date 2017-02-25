<?php

namespace DemandeSubventionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Miseadisposition
 *
 * @ORM\Table(name="miseadisposition", indexes={@ORM\Index(name="fk_mise_a_disposition_demandes_subvention1_idx", columns={"demandessubvention_id"}), @ORM\Index(name="fk_mise_a_disposition_types_mise_a_disposition1_idx", columns={"typesmiseadisposition_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Miseadisposition
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
     * @ORM\Column(name="nom", type="string", length=45, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=45, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="freq_util", type="string", length=45, nullable=true)
     */
    private $freqUtil;

    /**
     * @var string
     *
     * @ORM\Column(name="horaires_util", type="string", length=45, nullable=true)
     */
    private $horairesUtil;

    /**
     * @var boolean
     *
     * @ORM\Column(name="appartient_ville", type="boolean")
     */
    private $appartientVille = false;

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
     * @ORM\ManyToOne(targetEntity="Demandessubvention", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="demandessubvention_id", referencedColumnName="id")
     * })
     */
    private $demandessubvention;

    /**
     * @var \DemandeSubventionBundle\Entity\Typesmiseadisposition
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Typesmiseadisposition", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="typesmiseadisposition_id", referencedColumnName="id")
     * })
     */
    private $typesmiseadisposition;

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
    public function getFreqUtil()
    {
        return $this->freqUtil;
    }

    /**
     * @param string $freqUtil
     */
    public function setFreqUtil($freqUtil)
    {
        $this->freqUtil = $freqUtil;
    }

    /**
     * @return string
     */
    public function getHorairesUtil()
    {
        return $this->horairesUtil;
    }

    /**
     * @param string $horairesUtil
     */
    public function setHorairesUtil($horairesUtil)
    {
        $this->horairesUtil = $horairesUtil;
    }

    /**
     * @return boolean
     */
    public function isAppartientVille()
    {
        return $this->appartientVille;
    }

    /**
     * @param boolean $appartientVille
     */
    public function setAppartientVille($appartientVille)
    {
        $this->appartientVille = $appartientVille;
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
     * @return \Typesmiseadisposition
     */
    public function getTypesmiseadisposition()
    {
        return $this->typesmiseadisposition;
    }

    /**
     * @param \Typesmiseadisposition $typesmiseadisposition
     */
    public function setTypesmiseadisposition($typesmiseadisposition)
    {
        $this->typesmiseadisposition = $typesmiseadisposition;
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


    /**
     * Get appartientVille
     *
     * @return boolean
     */
    public function getAppartientVille()
    {
        return $this->appartientVille;
    }
}
