<?php

namespace DocumentBundle\Entity;

use AssociationBundle\Entity\Associations;
use DemandeSubventionBundle\Entity\Bilansactivite;
use DemandeSubventionBundle\Entity\Demandessubvention;
use DemandeSubventionBundle\Entity\Travauxinvestissements;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documents
 *
 * @ORM\Table(name="documents")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Documents
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
     * @ORM\Column(name="objet", type="string", length=45, nullable=true)
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    private $temp;

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
     * @var Associations $associationsNumassoc
     *
     * @ORM\ManyToOne(targetEntity="AssociationBundle\Entity\Associations", inversedBy="Documents", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="associations_numassoc", referencedColumnName="numassoc")
     * })
     */
    private $associationsNumassoc;

    /**
     * @var Bilansactivite $bilansactivite
     *
     * @ORM\ManyToOne(targetEntity="DemandeSubventionBundle\Entity\Bilansactivite", inversedBy="Documents", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bilansactivite_id", referencedColumnName="id")
     * })
     */
    private $bilansactivite;

    /**
     * @var Demandessubvention $demandesubvention
     *
     * @ORM\ManyToOne(targetEntity="DemandeSubventionBundle\Entity\Demandessubvention", inversedBy="Documents", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="demandessubvention_id", referencedColumnName="id")
     * })
     */
    private $demandesubvention;

    /**
     * @var Travauxinvestissements $travauxinvestissements
     *
     * @ORM\ManyToOne(targetEntity="DemandeSubventionBundle\Entity\Travauxinvestissements", inversedBy="Documents", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="travauxinvestissements_id", referencedColumnName="id")
     * })
     */
    private $travauxinvestissements;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * @param mixed $temp
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;
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
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * @return Associations
     */
    public function getAssociationsNumassoc()
    {
        return $this->associationsNumassoc;
    }

    /**
     * @param Associations $associationsNumassoc
     */
    public function setAssociationsNumassoc($associationsNumassoc)
    {
        $this->associationsNumassoc = $associationsNumassoc;
    }

    /**
     * @return Bilansactivite
     */
    public function getBilansactivite()
    {
        return $this->bilansactivite;
    }

    /**
     * @param Bilansactivite $bilansactivite
     */
    public function setBilansactivite($bilansactivite)
    {
        $this->bilansactivite = $bilansactivite;
    }

    /**
     * @return Demandessubvention
     */
    public function getDemandesubvention()
    {
        return $this->demandesubvention;
    }

    /**
     * @param Demandessubvention $demandesubvention
     */
    public function setDemandesubvention($demandesubvention)
    {
        $this->demandesubvention = $demandesubvention;
    }

    /**
     * @return Travauxinvestissements
     */
    public function getTravauxinvestissements()
    {
        return $this->travauxinvestissements;
    }

    /**
     * @param Travauxinvestissements $travauxinvestissements
     */
    public function setTravauxinvestissements($travauxinvestissements)
    {
        $this->travauxinvestissements = $travauxinvestissements;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/';
    }

    private function getSubvYear()
    {
        return date('m') <= 2 ? date('Y') : date('Y') + 1;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            if($this->getAssociationsNumassoc() instanceof Associations) {
                $path = $this->getAssociationsNumassoc()->getNumassoc().'/association';
            } else {
                if($this->getBilansactivite() instanceof Bilansactivite) {
                    $path = $this->getBilansactivite()->getDemandessubvention()->getAssociationsNumassoc()->getNumassoc().'/demandessubvention/demandesubvention-'.$this->getSubvYear();
                } elseif ($this->getTravauxinvestissements() instanceof Travauxinvestissements) {
                    $path = $this->getTravauxinvestissements()->getDemandessubvention()->getAssociationsNumassoc()->getNumassoc().'/demandessubvention/demandesubvention-'.$this->getSubvYear();
                } else {
                    $path = $this->getDemandesubvention()->getAssociationsNumassoc()->getNumassoc().'/demandessubvention/demandesubvention-'.$this->getSubvYear();
                }
            }
            $this->nom = $this->getNom();
            $this->path = $path.'/'.$this->getObjet().'/'.$this->nom;
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        if($this->getAssociationsNumassoc() instanceof Associations) {
            $path = $this->getAssociationsNumassoc()->getNumassoc().'/association';
        } else {
            if($this->getBilansactivite() instanceof Bilansactivite) {
                $path = $this->getBilansactivite()->getDemandessubvention()->getAssociationsNumassoc()->getNumassoc().'/demandessubvention/demandesubvention-'.$this->getSubvYear();
            } elseif ($this->getTravauxinvestissements() instanceof Travauxinvestissements) {
                $path = $this->getTravauxinvestissements()->getDemandessubvention()->getAssociationsNumassoc()->getNumassoc().'/demandessubvention/demandesubvention-'.$this->getSubvYear();
            } else {
                $path = $this->getDemandesubvention()->getAssociationsNumassoc()->getNumassoc().'/demandessubvention/demandesubvention-'.$this->getSubvYear();
            }
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadDir().$path.'/'.$this->getObjet().'/', $this->nom);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if (file_exists($file)) {
            unlink($file);
        }
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
