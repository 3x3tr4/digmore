<?php

namespace Digmore\TickerBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Digmore\TickerBundle\Entity\Ticker;
use Digmore\TickerBundle\Entity\CurrencyPair;

/**
 * Hello World command for demo purposes.
 *
 * You could also extend from Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand
 * to get access to the container via $this->getContainer().
 *
 * @author Tobias Schultze <http://tobion.de>
 */
class TickerRefreshCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('ticker:refresh')
            ->setDescription('Read ticker values via btc-e API.')
            ->addArgument('pairName', InputArgument::OPTIONAL, 'Currency pair name curr1_curr2.', 'ltc_btc')
            ->setHelp(<<<EOF
The <info>%command.name%</info> command refreshes ticker values for defined currency pairs:

<info>php %command.full_name%</info>

The optional argument specifies currency pair:

<info>php %command.full_name%</info> ltc_btc
EOF
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ticker = new Ticker();

        $out = 'Calling btc-e API';

        $pairName = $input->getArgument('pairName');

        if (! empty($pairName))
        {
            $repository = $this
                ->getContainer()
                ->get('doctrine')
                ->getRepository('TickerBundle:CurrencyPair');

            $pair = $repository->findOneBy(array('name' => $pairName));

            $out .= sprintf("\n" . ' <comment>%s</comment>', $pair->getName());
            $ticker->setPair($pair);
            $ticker->readTick();
        }



        $output->writeln($out);
    }
}
