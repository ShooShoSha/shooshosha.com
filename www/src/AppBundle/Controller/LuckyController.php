<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 6/6/16
 * Time: 2:56 PM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number/{count}")
     */
    public function numberAction($count = 1)
    {
        $numbers = array();
        for ($i = 0; $i < $count; $i++)
        {
            $numbers[] = rand(0, 100);
        }
        $numbersList = implode(', ', $numbers);

        $html = $this->render(
            'lucky/number.html.twig',
            array('luckyNumbersList' => $numbersList)
        );

        return new Response($html);
    }

    /**
     * @Route("/api/lucky/number")
     */
    public function apiNumberAction()
    {
        $data = array(
            'lucky_number' => rand(0, 100),
        );

        return new JsonResponse($data);
    }

    /**
     * @Route("api/darksoulscraft/version")
     */
    public function apiDarkSouls()
    {
        $data = array(
            '0.1.0' => array(
                'minecraft' => '1.7.10',
                'forge' => '10.13.4.1558',
            ),
            '0.1.1' => array(
                'minecraft' => '1.7.10',
                'forge' => '10.13.4.1614'
            ),
        );

        return new JsonResponse($data);
    }
}