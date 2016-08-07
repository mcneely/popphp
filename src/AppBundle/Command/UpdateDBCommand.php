<?php
/**
 * Created by IntelliJ IDEA.
 * User: mcneely
 * Date: 8/6/16
 * Time: 1:19 PM
 */

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateDBCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:updateDB')
            ->setDescription('Pulls data from Github and updates the database')
            ->setHelp("");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $status = "Database Updated.";
        try {
            $this->getContainer()->get('github.service')->updateDB();
        } catch (Exception $e) {
            $status = "Error: $e\n";
        }
        $output->writeln($status);
    }
}