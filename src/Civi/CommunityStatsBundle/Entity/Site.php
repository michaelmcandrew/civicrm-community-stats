<?php

namespace Civi\CommunityStatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site
 *
 * @ORM\Table()
 * @ORM\Entity()
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
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $daysAlive;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $latestPing;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     *
     */

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $active = 0;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     *
     */
    private $pingCount;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pings = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set latestPing
     *
     * @param \DateTime $latestPing
     * @return Site
     */
    public function setLatestPing($latestPing)
    {
        $this->latestPing = $latestPing;

        return $this;
    }

    /**
     * Get latestPing
     *
     * @return \DateTime 
     */
    public function getLatestPing()
    {
        return $this->latestPing;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Site
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set pingCount
     *
     * @param integer $pingCount
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
     * @return integer 
     */
    public function getPingCount()
    {
        return $this->pingCount;
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
}
