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
        $this->processSites($input, $output);
        $this->processPings($input, $output);
    }

    protected function processSites(InputInterface $input, OutputInterface $output) {
        //For each site, cache values based on the Ping table (means simpler joins)
        $activeSiteCriteria=array(
            'pingCount' => 1,
            'latestPing' => new \DateTime('-100 days'),
            'daysAlive' => 100
        );
        $em = $this->getContainer()->get('doctrine')->getManager();
        $counter = 1;
        echo "Retreiving all sites (this may take a while)...\n";
        $sites = $em->createQuery(
            '
            SELECT s, min(p.time), max(p.time), count(p.id)
            FROM CiviCommunityStatsBundle:Site s
            JOIN s.pings p
            GROUP BY s.id
            '
        )->getResult();
        echo count($sites)." retreived.\n";
        echo "Updating cached values...\n";
        foreach($sites as $site){

            //cache number of pings
            $site[0]->setPingCount($site[3]);
            $firstPing = new \DateTime($site[1]);
            $latestPing = new \DateTime($site[2]);
            $site[1];

            //cache latest ping
            $site[0]->setLatestPing($latestPing);

            //cache days alive
            $daysAlive = $latestPing->diff($firstPing);
            $site[0]->setDaysAlive($daysAlive->format('%a'));
            echo "\r$counter sites processed.";
            $counter++;
            if(
                $site[0]->getPingCount() >= $activeSiteCriteria['pingCount'] &&
                $site[0]->getLatestPing() >= $activeSiteCriteria['latestPing'] &&
                $site[0]->getDaysAlive() >= $activeSiteCriteria['daysAlive']
            ){
                $site[0]->setActive(1);
            }else{
                $site[0]->setActive(0);
            }
        }
        echo "\rAll ($counter) sites processed.\n";
        echo "Updating sites (this may take a while)...\n";
        $em->flush();
        $em->clear();
        echo "All sites updated.\n";
    }

    protected function processPings(InputInterface $input, OutputInterface $output) {
        $em = $this->getContainer()->get('doctrine')->getManager();


        //Find and mark the latest ping for each site
        $counter=1;
        echo "Finding latest pings (this may take a while)...\n";
        //Would normally be done with time, not with ID, but we have a few sites where the
        //site pinged back more than once in a single second. An alternative approach would
        //be to not import more than one ping back for the same site for the same second,
        //but I went with this approach instead, which works because we ensure that when we
        //do the import of the raw stats, we order them by time, hence id and time will
        //have the same effect when it comes to ordering 
        $latestPings = $em->createQuery(
            '
            SELECT p1
            FROM CiviCommunityStatsBundle:Ping p1
            LEFT JOIN CiviCommunityStatsBundle:Ping p2 WITH p1.site=p2.site AND p1.id > p2.id
            WHERE p2.id IS NULL
            '
        )
        ->getResult();
        echo count($latestPings). " pings retreived.\n";
        foreach($latestPings as $ping){
            $ping->setLatest(1);
            echo "\r$counter pings processed.";
            $counter++;
        }
        echo "\rAll ($counter) pings processed.\n";
        echo "Updating pings (this may take a while)...\n";
        $em->flush();
        $em->clear();
        echo "All pings updated.\n";
    }
}
