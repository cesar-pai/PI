<?php

namespace DemandeSubventionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Faitsmarquants
 *
 * @ORM\Table(name="faitsmarquants", indexes={@ORM\Index(name="fk_faitsmarquants_bilansactivite1_idx", columns={"bilansactivite_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Faitsmarquants
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

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
     * @var \DemandeSubventionBundle\Entity\Bilansactivite
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Bilansactivite", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bilansactivite_id", referencedColumnName="id")
     * })
     */
    private $bilansactivite;

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return \Bilansactivite
     */
    public function getBilansactivite()
    {
        return $this->bilansactivite;
    }

    /**
     * @param \Bilansactivite $bilansactivite
     */
    public function setBilansactivite($bilansactivite)
    {
        $this->bilansactivite = $bilansactivite;
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
