<?php

namespace Digmore\TickerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticker
 *
 * @ORM\Table(name="ticker")
 * @ORM\Entity
 */
class Ticker
{
    private $urlApi = 'https://btc-e.com/api/2';

    private $name;

    private $pairNames = array(
        1 => 'eur_usd',
        2 => 'ltc_btc',
        3 => 'ltc_eur',
        4 => 'btc_eur'
    );

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="date", nullable=false)
     */
    private $time;

    /**
     * @var float
     *
     * @ORM\Column(name="high", type="float", precision=10, scale=0, nullable=true)
     */
    private $high;

    /**
     * @var float
     *
     * @ORM\Column(name="low", type="float", precision=10, scale=0, nullable=true)
     */
    private $low;

    /**
     * @var float
     *
     * @ORM\Column(name="avg", type="float", precision=10, scale=0, nullable=true)
     */
    private $avg;

    /**
     * @var float
     *
     * @ORM\Column(name="vol", type="float", precision=10, scale=0, nullable=true)
     */
    private $vol;

    /**
     * @var float
     *
     * @ORM\Column(name="vol_cur", type="float", precision=10, scale=0, nullable=true)
     */
    private $volCur;

    /**
     * @var float
     *
     * @ORM\Column(name="last", type="float", precision=10, scale=0, nullable=true)
     */
    private $last;

    /**
     * @var float
     *
     * @ORM\Column(name="buy", type="float", precision=10, scale=0, nullable=true)
     */
    private $buy;

    /**
     * @var float
     *
     * @ORM\Column(name="sell", type="float", precision=10, scale=0, nullable=true)
     */
    private $sell;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bool_param", type="boolean", nullable=true)
     */
    private $boolParam;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Digmore\TickerBundle\Entity\CurrencyPair
     *
     * @ORM\ManyToOne(targetEntity="Digmore\TickerBundle\Entity\CurrencyPair")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pair_id", referencedColumnName="id")
     * })
     */
    private $pair;

    /**
     * Set name
     *
     * @param string $name
     * @return Ticker
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

    public function getURL()
    {
        return
        $this->urlApi.
        '/'.
        $this->pairNames[$this->pairId].
        '/ticker';
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     * @return Ticker
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set high
     *
     * @param float $high
     * @return Ticker
     */
    public function setHigh($high)
    {
        $this->high = $high;

        return $this;
    }

    /**
     * Get high
     *
     * @return float
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * Set low
     *
     * @param float $low
     * @return Ticker
     */
    public function setLow($low)
    {
        $this->low = $low;

        return $this;
    }

    /**
     * Get low
     *
     * @return float
     */
    public function getLow()
    {
        return $this->low;
    }

    /**
     * Set avg
     *
     * @param float $avg
     * @return Ticker
     */
    public function setAvg($avg)
    {
        $this->avg = $avg;

        return $this;
    }

    /**
     * Get avg
     *
     * @return float
     */
    public function getAvg()
    {
        return $this->avg;
    }

    /**
     * Set vol
     *
     * @param float $vol
     * @return Ticker
     */
    public function setVol($vol)
    {
        $this->vol = $vol;

        return $this;
    }

    /**
     * Get vol
     *
     * @return float
     */
    public function getVol()
    {
        return $this->vol;
    }

    /**
     * Set volCur
     *
     * @param float $volCur
     * @return Ticker
     */
    public function setVolCur($volCur)
    {
        $this->volCur = $volCur;

        return $this;
    }

    /**
     * Get volCur
     *
     * @return float
     */
    public function getVolCur()
    {
        return $this->volCur;
    }

    /**
     * Set last
     *
     * @param float $last
     * @return Ticker
     */
    public function setLast($last)
    {
        $this->last = $last;

        return $this;
    }

    /**
     * Get last
     *
     * @return float
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * Set buy
     *
     * @param float $buy
     * @return Ticker
     */
    public function setBuy($buy)
    {
        $this->buy = $buy;

        return $this;
    }

    /**
     * Get buy
     *
     * @return float
     */
    public function getBuy()
    {
        return $this->buy;
    }

    /**
     * Set sell
     *
     * @param float $sell
     * @return Ticker
     */
    public function setSell($sell)
    {
        $this->sell = $sell;

        return $this;
    }

    /**
     * Get sell
     *
     * @return float
     */
    public function getSell()
    {
        return $this->sell;
    }

    /**
     * Set boolParam
     *
     * @param boolean $boolParam
     * @return Ticker
     */
    public function setBoolParam($boolParam)
    {
        $this->boolParam = $boolParam;

        return $this;
    }

    /**
     * Get boolParam
     *
     * @return boolean
     */
    public function getBoolParam()
    {
        return $this->boolParam;
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

    public function readTick()
    {
        $url = $this->getURL();

        $stream = fopen($url, 'r');
        $data = stream_get_contents($stream);
        fclose($stream);

        $ret = json_decode($data, 1)['ticker'];
        $ret['pair'] = $this->pairNames[$this->pairId];
        $ret['url'] = $url;

        return $ret;
    }

    /**
     * Set pair
     *
     * @param \Digmore\TickerBundle\Entity\CurrencyPair $pair
     * @return Ticker
     */
    public function setPair(\Digmore\TickerBundle\Entity\CurrencyPair $pair = null)
    {
        $this->pair = $pair;

        return $this;
    }

    /**
     * Get pair
     *
     * @return \Digmore\TickerBundle\Entity\CurrencyPair
     */
    public function getPair()
    {
        return $this->pair;
    }

    /**
     * Get pair name
     *
     * @return string
     */
    public function getPairName()
    {
        new CurrencyPair();
        return $this->getPair()
        ? strtoupper(strreplace('_', '/', $this->pairNames[$this->pairId]))
        : 'N/A';
    }

}
