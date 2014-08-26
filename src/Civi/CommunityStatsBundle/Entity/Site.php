<?php

namespace Civi\CommunityStatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Site
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
     * @ORM\Column(name="hash", type="string", length=255)
     */
    private $hash;

    /**
     * @ORM\OneToMany(targetEntity="Ping", mappedBy="site")
     */
    protected $pings;

    /**
     * Get id
     *
     * @return integer 
     */

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $daysAlive;

    /**
     * @var integer
     *
     * @ORM\Column(type="datetime")
     */
    private $mostRecentPing;

    /**
     * @var DateTime
     * @ORM\Column(type="integer")
     *
     */
    private $pingCount;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set hash
     *
     * @param string $hash
     * @return Site
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
     * Constructor
     */
    public function __construct()
    {
        $this->pings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pings
     *
     * @param \Civi\CommunityStatsBundle\Entity\Ping $pings
     * @return Site
     */
    public function addPing(\Civi\CommunityStatsBundle\Entity\Ping $pings)
    {
        $this->pings[] = $pings;

        return $this;
    }

    /**
     * Remove pings
     *
     * @param \Civi\CommunityStatsBundle\Entity\Ping $pings
     */
    public function removePing(\Civi\CommunityStatsBundle\Entity\Ping $pings)
    {
        $this->pings->removeElement($pings);
    }

    /**
     * Get pings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPings()
    {
        return $this->pings;
    }

    /**
     * Set daysAlive
     *
     * @param integer $daysAlive
     * @return Site
     */
    public function setDaysAlive($daysAlive)
    {
        $this->daysAlive = $daysAlive;

        return $this;
    }

    /**
     * Get daysAlive
     *
     * @return integer 
     */
    public function getDaysAlive()
    {
        return $this->daysAlive;
    }

    /**
     * Set mostRecentPing
     *
     * @param integer $mostRecentPing
     * @return Site
     */
    public function setMostRecentPing($mostRecentPing)
    {
        $this->mostRecentPing = $mostRecentPing;

        return $this;
    }

    /**
     * Get mostRecentPing
     *
     * @return integer 
     */
    public function getMostRecentPing()
    {
        return $this->mostRecentPing;
    }

    /**
     * Set pingCount
     *
     * @param \DateTime $pingCount
     * @return Site
     */
    public function setPingCount($pingCount)
    {
        $this->pingCount = $pingCount;

        return $this;
    }

    /**
     * Get pingCount
     *
     * @return \DateTime 
     */
    public function getPingCount()
    {
        return $this->pingCount;
    }
}