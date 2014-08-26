<?php

namespace Civi\CommunityStatsBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/sites")
 * @Template("")
 */
class SitesController extends Controller
{


    /**
     * @Route("index")
     * @Template("")
     */
    public function indexAction() {
        return array('actions' => 1, 'contexts' => 1);
    }

    /**
     * @Route("/active")
     * @Template("")
     */
    public function activeSitesAction() {
        $em = $this->getDoctrine()->getManager();
        $activeSites = $em->createQuery(
            "
            SELECT count(s.id)
            FROM CiviCommunityStatsBundle:Site s
            JOIN s.pings p WITH s.active=1 AND p.latest=1 AND p.version NOT LIKE '%alpha%' AND p.version NOT LIKE '%beta%'
            "
        )->getSingleScalarResult();
        return new JsonResponse($activeSites);
    }

    /**
     * @Route("/summary/{var}")
     * @Template("")
     */
    public function summaryAction($var) {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select(array('p.'.$var, 'count(p.id) AS total'))
            ->from('CiviCommunityStatsBundle:Ping', 'p')
            ->join('p.site', 's', 'WITH', 's.active=1 AND p.latest=1')
            ->groupBy('p.'.$var);
        $summary = $qb->getQuery()->getResult();
        foreach($summary as $line){
            $result[$line[$var]]=$line['total'];
        }
        return new JsonResponse($result);
    }
}
