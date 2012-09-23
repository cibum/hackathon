<?php

namespace Cibum\ConcursoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cibum:update')
            ->setDescription('Update projects from the api')
            ->addOption('moo', null, InputOption::VALUE_NONE, 'There are no Easter Eggs in this program.')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $updater = $this->getContainer()->get('cibum.updater');
        $updates = $updater->batchUpdate();
        $output->writeln('Se han actualizado ' . $updates . ' registros!');
    }
}
