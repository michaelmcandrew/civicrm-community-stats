<?php

namespace Civi\CommunityStatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ping
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Ping
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
     * @ORM\Column(type="string", length=255)
     */
    private $uf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $ufversion;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $mysqlversion;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $phpversion;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $paymentprocessors;

    /**
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="pings")
     * @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     */
    private $site;

    /**
     * @ORM\OneToMany(targetEntity="Extension", mappedBy="ping")
     */
    protected $extensions;

    /**
     * @ORM\OneToMany(targetEntity="Entity", mappedBy="ping")
     */
    protected $entities;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $time;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="string")
     */
    private $legacy_stat_id;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $latest = 0;

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
     * Set uf
     *
     * @param string $uf
     * @return Ping
     */
    public function setUf($uf)
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * Get uf
     *
     * @return string 
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return Ping
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
     * Set ufv
     *
     * @param string $ufv
     * @return Ping
     */
    public function setUfv($ufv)
    {
        $this->ufv = $ufv;

        return $this;
    }

    /**
     * Get ufv
     *
     * @return string 
     */
    public function getUfv()
    {
        return $this->ufv;
    }

    /**
     * Set mysql
     *
     * @param string $mysql
     * @return Ping
     */
    public function setMysql($mysql)
    {
        $this->mysql = $mysql;

        return $this;
    }

    /**
     * Get mysql
     *
     * @return string 
     */
    public function getMysql()
    {
        return $this->mysql;
    }

    /**
     * Set php
     *
     * @param string $php
     * @return Ping
     */
    public function setPhp($php)
    {
        $this->php = $php;

        return $this;
    }

    /**
     * Get php
     *
     * @return string 
     */
    public function getPhp()
    {
        return $this->php;
    }

    /**
     * Set pptypes
     *
     * @param string $pptypes
     * @return Ping
     */
    public function setPptypes($pptypes)
    {
        $this->pptypes = $pptypes;

        return $this;
    }

    /**
     * Get pptypes
     *
     * @return string 
     */
    public function getPptypes()
    {
        return $this->pptypes;
    }

    /**
     * Set hash
     *
     * @param string $hash
     * @return Ping
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string 
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set time
     *
     * @param string $time
     * @return Ping
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string 
     */
    public function getTime()
    {
        return $this->time;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->extensions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->entities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set ufversion
     *
     * @param string $ufversion
     * @return Ping
     */
    public function setUfversion($ufversion)
    {
        $this->ufversion = $ufversion;

        return $this;
    }

    /**
     * Get ufversion
     *
     * @return string 
     */
    public function getUfversion()
    {
        return $this->ufversion;
    }

    /**
     * Set mysqlversion
     *
     * @param string $mysqlversion
     * @return Ping
     */
    public function setMysqlversion($mysqlversion)
    {
        $this->mysqlversion = $mysqlversion;

        return $this;
    }

    /**
     * Get mysqlversion
     *
     * @return string 
     */
    public function getMysqlversion()
    {
        return $this->mysqlversion;
    }

    /**
     * Set phpversion
     *
     * @param string $phpversion
     * @return Ping
     */
    public function setPhpversion($phpversion)
    {
        $this->phpversion = $phpversion;

        return $this;
    }

    /**
     * Get phpversion
     *
     * @return string 
     */
    public function getPhpversion()
    {
        return $this->phpversion;
    }

    /**
     * Set paymentprocessors
     *
     * @param string $paymentprocessors
     * @return Ping
     */
    public function setPaymentprocessors($paymentprocessors)
    {
        $this->paymentprocessors = $paymentprocessors;

        return $this;
    }

    /**
     * Get paymentprocessors
     *
     * @return string 
     */
    public function getPaymentprocessors()
    {
        return $this->paymentprocessors;
    }

    /**
     * Set site
     *
     * @param \Civi\CommunityStatsBundle\Entity\Site $site
     * @return Ping
     */
    public function setSite(\Civi\CommunityStatsBundle\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \Civi\CommunityStatsBundle\Entity\Site 
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Add extensions
     *
     * @param \Civi\CommunityStatsBundle\Entity\Extension $extensions
     * @return Ping
     */
    public function addExtension(\Civi\CommunityStatsBundle\Entity\Extension $extensions)
    {
        $this->extensions[] = $extensions;

        return $this;
    }

    /**
     * Remove extensions
     *
     * @param \Civi\CommunityStatsBundle\Entity\Extension $extensions
     */
    public function removeExtension(\Civi\CommunityStatsBundle\Entity\Extension $extensions)
    {
        $this->extensions->removeElement($extensions);
    }

    /**
     * Get extensions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * Add entities
     *
     * @param \Civi\CommunityStatsBundle\Entity\Entity $entities
     * @return Ping
     */
    public function addEntity(\Civi\CommunityStatsBundle\Entity\Entity $entities)
    {
        $this->entities[] = $entities;

        return $this;
    }

    /**
     * Remove entities
     *
     * @param \Civi\CommunityStatsBundle\Entity\Entity $entities
     */
    public function removeEntity(\Civi\CommunityStatsBundle\Entity\Entity $entities)
    {
        $this->entities->removeElement($entities);
    }

    /**
     * Get entities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Ping
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Ping
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set stat_id_legacy
     *
     * @param string $statIdLegacy
     * @return Ping
     */
    public function setStatIdLegacy($statIdLegacy)
    {
        $this->stat_id_legacy = $statIdLegacy;

        return $this;
    }

    /**
     * Get stat_id_legacy
     *
     * @return string 
     */
    public function getStatIdLegacy()
    {
        return $this->stat_id_legacy;
    }

    /**
     * Set legacy_stat_id
     *
     * @param string $legacyStatId
     * @return Ping
     */
    public function setLegacyStatId($legacyStatId)
    {
        $this->legacy_stat_id = $legacyStatId;

        return $this;
    }

    /**
     * Get legacy_stat_id
     *
     * @return string 
     */
    public function getLegacyStatId()
    {
        return $this->legacy_stat_id;
    }

    /**
     * Set latest
     *
     * @param boolean $latest
     * @return Ping
     */
    public function setLatest($latest)
    {
        $this->latest = $latest;

        return $this;
    }

    /**
     * Get latest
     *
     * @return boolean 
     */
    public function getLatest()
    {
        return $this->latest;
    }
}
