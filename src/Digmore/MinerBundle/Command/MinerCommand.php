<?php

namespace Digmore\MinerBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Hello World command for demo purposes.
 *
 * You could also extend from Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand
 * to get access to the container via $this->getContainer().
 *
 * @author Tobias Schultze <http://tobion.de>
 */
class MinerCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('miner:conf')
            ->setDescription('This is a Miner configuration command.')
            ->addArgument('arg1', InputArgument::OPTIONAL, ' tets argument.', 'Def val 1')
            ->setHelp(<<<EOF
The <info>%command.name%</info> command configures miner:

<info>php %command.full_name%</info>

The optional argument specifies testing data:

<info>php %command.full_name%</info> Testing, two..
EOF
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('Miner configure command execute(), arg1 = <comment>%s</comment>!', $input->getArgument('arg1')));
    }
}
