<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/data/product")
     */
    public function indexAction()
    {
        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        $em = $this->getDoctrine()->getManager();

        //$em->persist($product);
        //$em->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    /**
     * @param $productId
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("data/product/{productId}")
     */
    public function showAction($productId)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($productId);

        if (!$product)
        {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        $data = array(
            'product' => array(
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'description' => $product->getDescription(),
            ),
        );

        return $this->render('data/product.html.twig', $data);
    }

    /**
     * @param $productId
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("api/product/{productId}")
     */
    public function apiShowAction($productId)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($productId);

        if (!$product)
        {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        return new JsonResponse((array)$product);
    }

    /**
     * @return JsonResponse
     *
     * @Route("api/project/all")
     */
    public function apiShowProjectAction()
    {
        $projects = $this->getDoctrine()
            ->getRepository('AppBundle:Project')
            ->findAll();

        if (!$projects)
        {
            throw $this->createNotFoundException(
                'No projects found.'
            );
        }

        return new JsonResponse($projects);
    }
}
