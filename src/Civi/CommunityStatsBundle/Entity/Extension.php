<?php

namespace Civi\CommunityStatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Extension
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Extension
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
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $version;

    /**
     * @ORM\ManyToOne(targetEntity="Ping", inversedBy="extensions")
     * @ORM\JoinColumn(name="ping_id", referencedColumnName="id")
     */
    private $ping;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Extension
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return Extension
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set ping
     *
     * @param \Civi\CommunityStatsBundle\Entity\Ping $ping
     * @return Extension
     */
    public function setPing(\Civi\CommunityStatsBundle\Entity\Ping $ping = null)
    {
        $this->ping = $ping;

        return $this;
    }

    /**
     * Get ping
     *
     * @return \Civi\CommunityStatsBundle\Entity\Ping 
     */
    public function getPing()
    {
        return $this->ping;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Extension
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}
