<?php

namespace AssociationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Membresconseiladministration
 *
 * @ORM\Table(name="membresconseiladministration", indexes={@ORM\Index(name="fk_membres_conseiladministration_associations1_idx", columns={"associations_numassoc"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Membresconseiladministration
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
     * @ORM\Column(name="commune_residence", type="string", length=60,nullable=true)
     */
    private $communeResidence;

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
     * @var \AssociationBundle\Entity\Associations
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Associations", cascade={"persist", "merge"})
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
    public function getCommuneResidence()
    {
        return $this->communeResidence;
    }

    /**
     * @param string $communeResidence
     */
    public function setCommuneResidence($communeResidence)
    {
        $this->communeResidence = $communeResidence;
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
