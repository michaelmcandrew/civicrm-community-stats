<?php
namespace Civi\CommunityStatsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateSitesCommand extends ContainerAwareCommand {

    protected function configure() {

        $this->setName('sites:update');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        //For each site, update the three criteria columns so that we can simply the joins
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $sites = $em->getRepository('CiviCommunityStatsBundle:Site')->findAll();
        foreach ($sites as $site){
            //update the three columns;
        }
    }
}
