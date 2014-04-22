<?php
namespace Digmore\TickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Digmore\TickerBundle\Entity\Ticker;
use Digmore\TickerBundle\Entity\CurrencyPair;
use Digmore\TickerBundle\Entity\CurrencyPairRepository;

class DefaultController extends Controller
{
    private $ticker_url = '';

    public function indexAction()
    {
        return $this->render(
            'TickerBundle:Default:index.html.twig',
            array()
        );
    }

    public function viewAction($pairName = null)
    {
        if ($pairName === null) {
            return null; // empty_response?
        }

        $ticker = new Ticker();
        $repository = $this
            ->getDoctrine()
            ->getRepository('TickerBundle:CurrencyPair');

        $pairs = $repository->findAll();
        foreach ($pairs as $pair)
        {
            $tickers[] = $ticker->setPair($pair)->readTick();
        }

        return $this->render(
            'TickerBundle:Default:view.html.twig',
            array(
                'tickers' => $tickers
            )
        );
    }

    public function doSomething($param = null)
    {
        if ($value === null) {
            return null;
        }
    }
}
