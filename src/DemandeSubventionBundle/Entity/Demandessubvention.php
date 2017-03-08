<?php

namespace DemandeSubventionBundle\Entity;

use AssociationBundle\AssociationBundle;
use AssociationBundle\Entity\Associations;
use Doctrine\ORM\Mapping as ORM;

/**
 * Demandessubvention
 *
 * @ORM\Table(name="demandessubvention", indexes={@ORM\Index(name="fk_demandessubvention_associations1_idx", columns={"associations_numassoc"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Demandessubvention
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
     * @var float
     *
     * @ORM\Column(name="montant_subvention", type="float")
     */
    private $montantSubvention;

    /**
     * @var string
     *
     * @ORM\Column(name="activites_payantes", type="string", length=255, nullable=true)
     */
    private $activitespayantes;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validee", type="boolean")
     */
    private $validee = false;

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
     * @var \AssociationBundle\Entity\Associations
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="AssociationBundle\Entity\Associations", cascade={"all"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="associations_numassoc", referencedColumnName="numassoc")
     * })
     */
    private $associationsNumassoc;

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
     * @return float
     */
    public function getMontantSubvention()
    {
        return $this->montantSubvention;
    }

    /**
     * @param float $montantSubvention
     */
    public function setMontantSubvention($montantSubvention)
    {
        $this->montantSubvention = $montantSubvention;
    }

    /**
     * @return string
     */
    public function getActivitespayantes()
    {
        return $this->activitespayantes;
    }

    /**
     * @param string $activitespayantes
     */
    public function setActivitespayantes($activitespayantes)
    {
        $this->activitespayantes = $activitespayantes;
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
     * @return \Associations
     */
    public function getAssociationsNumassoc()
    {
        return $this->associationsNumassoc;
    }

    /**
     * @param \Associations $associationsNumassoc
     */
    public function setAssociationsNumassoc($associationsNumassoc)
    {
        $this->associationsNumassoc = $associationsNumassoc;
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
