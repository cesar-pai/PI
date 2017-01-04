<?php

namespace AssociationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agrementsadministratifs
 *
 * @ORM\Table(name="agrementsadministratifs", indexes={@ORM\Index(name="fk_agrementsadministratifs_associations1_idx", columns={"associations_numassoc"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Agrementsadministratifs
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
     * @ORM\Column(name="typeagrement", type="string", length=45, nullable=true)
     */
    private $typeagrement;

    /**
     * @var string
     *
     * @ORM\Column(name="attribuepar", type="string", length=45,nullable=true)
     */
    private $attribuepar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateattribution", type="date",nullable=true)
     */
    private $dateattribution;

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
     * @ORM\OneToOne(targetEntity="Associations")
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
     * @return string
     */
    public function getTypeagrement()
    {
        return $this->typeagrement;
    }

    /**
     * @param string $typeagrement
     */
    public function setTypeagrement($typeagrement)
    {
        $this->typeagrement = $typeagrement;
    }

    /**
     * @return string
     */
    public function getAttribuepar()
    {
        return $this->attribuepar;
    }

    /**
     * @param string $attribuepar
     */
    public function setAttribuepar($attribuepar)
    {
        $this->attribuepar = $attribuepar;
    }

    /**
     * @return \DateTime
     */
    public function getDateattribution()
    {
        return $this->dateattribution;
    }

    /**
     * @param \DateTime $dateattribution
     */
    public function setDateattribution($dateattribution)
    {
        $this->dateattribution = $dateattribution;
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
