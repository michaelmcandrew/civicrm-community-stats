<?php

namespace Civi\CommunityStatsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Entity
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
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;

    /**
     * @ORM\ManyToOne(targetEntity="Ping", inversedBy="entities")
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
     * Set count
     *
     * @param integer $count
     * @return Entity
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set ping
     *
     * @param \Civi\CommunityStatsBundle\Entity\Ping $ping
     * @return Entity
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
}
