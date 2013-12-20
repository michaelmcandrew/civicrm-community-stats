<?php

namespace Civi\CommunityStatsBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/")
 * @Template("")
 */
class DefaultController extends Controller
{


 /**
  * @Route("total")
  * @Template("")
  */
    public function totalAction()
    {
        $sites = $qb->getQuery()->getResult();
        return array('sites' => $sites);
    }
}
