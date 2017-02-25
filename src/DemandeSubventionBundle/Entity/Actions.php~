<?php

namespace DemandeSubventionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actions
 *
 * @ORM\Table(name="actions", indexes={@ORM\Index(name="fk_actions_demandes_subvention1_idx", columns={"demandessubvention_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Actions
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
     * @var boolean
     *
     * @ORM\Column(name="isnew", type="boolean")
     */
    private $isnew = true;

    /**
     * @var string
     *
     * @ORM\Column(name="objectif", type="text", length=65535, nullable=true)
     */
    private $objectif;

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
    public function getObjectif()
    {
        return $this->objectif;
    }

    /**
     * @param string $objectif
     */
    public function setObjectif($objectif)
    {
        $this->objectif = $objectif;
    }

    /**
     * @return boolean
     */
    public function isIsnew()
    {
        return $this->isnew;
    }

    /**
     * @param boolean $isnew
     */
    public function setIsnew($isnew)
    {
        $this->isnew = $isnew;
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

    /**
     * Get isnew
     *
     * @return boolean
     */
    public function getIsnew()
    {
        return $this->isnew;
    }
}
