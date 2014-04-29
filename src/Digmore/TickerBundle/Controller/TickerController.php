<?php
namespace Digmore\TickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Digmore\TickerBundle\Entity\Ticker;
use Digmore\TickerBundle\Entity\CurrencyPair;
use Digmore\TickerBundle\Entity\CurrencyPairRepository;

class TickerController extends Controller
{
    public function listAction()
    {
        return $this->render(
            'TickerBundle:Default:index.html.twig',
            array()
        );
    }

    public function addAction()
    {
    }

    public function viewAction($pairName = false)
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

    public function editAction($id = false)
    {
    }

    public function removeAction($id = false)
    {
    }
}
