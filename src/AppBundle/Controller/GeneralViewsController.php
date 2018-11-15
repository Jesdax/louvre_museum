<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 01/06/18
 * Time: 15:18
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class GeneralViewsController extends Controller
{

    /**
     * @Method({"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/gts", name="gts")
     */
    public function generalTermsAction()
    {
        return $this->render('general/gts.html.twig');
    }

    /**
     * @Method({"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/practical-informations", name="practical_informations")
     */
    public function newAction()
    {
        return $this->render('general/pratical-infos.html.twig');
    }

    /**
     * @Method({"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/legal-mentions", name="legal_mentions")
     */
    public function legalMentionsAction()
    {
        return $this->render('general/legal-mentions.html.twig');
    }

    /**
     * @Method({"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/contact-us", name="contact_us")
     */
    public function contactAction()
    {
        return $this->render('general/contact.html.twig');
    }

}