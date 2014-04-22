<?php

namespace Digmore\MinerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Miner
 *
 * @ORM\Table(name="miner")
 * @ORM\Entity
 */
class Miner
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
     * @ORM\Column(name="name", type="string", length=40, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=40, nullable=true)
     */
    private $ip;

    /**
     * @var integer
     *
     * @ORM\Column(name="port", type="integer", nullable=true)
     */
    private $port;

    /**
     * @var boolean
     *
     * @ORM\Column(name="alert", type="boolean", nullable=true)
     */
    private $alert;

    /**
     * @var string
     *
     * @ORM\Column(name="mac", type="string", length=40, nullable=true)
     */
    private $mac;

    /**
     * @var string
     *
     * @ORM\Column(name="pool_login", type="string", length=40, nullable=true)
     */
    private $poolLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="pool_pass", type="string", length=40, nullable=true)
     */
    private $poolPass;

    /**
     * @var string
     *
     * @ORM\Column(name="pool_id", type="string", length=40, nullable=true)
     */
    private $poolId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_local", type="boolean", nullable=true)
     */
    private $isLocal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_new", type="boolean", nullable=true)
     */
    private $isNew;

    /**
     * Set name
     *
     * @param string $name
     * @return Miner
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

    /**
     * Set ip
     *
     * @param string $ip
     * @return Miner
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set port
     *
     * @param integer $port
     * @return Miner
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set alert
     *
     * @param boolean $alert
     * @return Miner
     */
    public function setAlert($alert)
    {
        $this->alert = $alert;

        return $this;
    }

    /**
     * Get alert
     *
     * @return boolean
     */
    public function getAlert()
    {
        return $this->alert;
    }

    /**
     * Set mac
     *
     * @param string $mac
     * @return Miner
     */
    public function setMac($mac)
    {
        $this->mac = $mac;

        return $this;
    }

    /**
     * Get mac
     *
     * @return string
     */
    public function getMac()
    {
        return $this->mac;
    }

    /**
     * Set poolLogin
     *
     * @param string $poolLogin
     * @return Miner
     */
    public function setPoolLogin($poolLogin)
    {
        $this->poolLogin = $poolLogin;

        return $this;
    }

    /**
     * Get poolLogin
     *
     * @return string
     */
    public function getPoolLogin()
    {
        return $this->poolLogin;
    }

    /**
     * Set poolPass
     *
     * @param string $poolPass
     * @return Miner
     */
    public function setPoolPass($poolPass)
    {
        $this->poolPass = $poolPass;

        return $this;
    }

    /**
     * Get poolPass
     *
     * @return string
     */
    public function getPoolPass()
    {
        return $this->poolPass;
    }

    /**
     * Set poolId
     *
     * @param string $poolId
     * @return Miner
     */
    public function setPoolId($poolId)
    {
        $this->poolId = $poolId;

        return $this;
    }

    /**
     * Get poolId
     *
     * @return string
     */
    public function getPoolId()
    {
        return $this->poolId;
    }

    /**
     * Set isLocal
     *
     * @param boolean $isLocal
     * @return Miner
     */
    public function setIsLocal($isLocal)
    {
        $this->isLocal = $isLocal;

        return $this;
    }

    /**
     * Get isLocal
     *
     * @return boolean
     */
    public function getIsLocal()
    {
        return $this->isLocal;
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
     * Set isNew
     *
     * @param boolean $isNew
     * @return Miner
     */
    public function setIsNew($isNew)
    {
        $this->isNew = $isNew;

        return $this;
    }

    /**
     * Get isNew
     *
     * @return boolean
     */
    public function getIsNew()
    {
        return $this->isNew;
    }

}
