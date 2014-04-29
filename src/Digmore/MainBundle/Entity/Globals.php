<?php

namespace Digmore\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Globals
 *
 * @ORM\Table(name="globals")
 * @ORM\Entity
 */
class Globals
{
    /**
     * @var integer
     *
     * @ORM\Column(name="api_port", type="integer", nullable=false)
     */
    private $apiPort;

    /**
     * @var string
     *
     * @ORM\Column(name="api_listen", type="string", length=255, nullable=false)
     */
    private $apiListen;

    /**
     * @var string
     *
     * @ORM\Column(name="blob", type="blob", nullable=false)
     */
    private $blob;

    /**
     * @var integer
     *
     * @ORM\Column(name="miner_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $minerId;



    /**
     * Set apiPort
     *
     * @param integer $apiPort
     * @return Globals
     */
    public function setApiPort($apiPort)
    {
        $this->apiPort = $apiPort;

        return $this;
    }

    /**
     * Get apiPort
     *
     * @return integer 
     */
    public function getApiPort()
    {
        return $this->apiPort;
    }

    /**
     * Set apiListen
     *
     * @param string $apiListen
     * @return Globals
     */
    public function setApiListen($apiListen)
    {
        $this->apiListen = $apiListen;

        return $this;
    }

    /**
     * Get apiListen
     *
     * @return string 
     */
    public function getApiListen()
    {
        return $this->apiListen;
    }

    /**
     * Set blob
     *
     * @param string $blob
     * @return Globals
     */
    public function setBlob($blob)
    {
        $this->blob = $blob;

        return $this;
    }

    /**
     * Get blob
     *
     * @return string 
     */
    public function getBlob()
    {
        return $this->blob;
    }

    /**
     * Get minerId
     *
     * @return integer 
     */
    public function getMinerId()
    {
        return $this->minerId;
    }
}
