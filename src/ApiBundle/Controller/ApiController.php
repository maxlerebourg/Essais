<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Image;
use ApiBundle\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use ApiBundle\Entity\Advert;

class ApiController extends Controller
{
    /**
     * @Rest\View(serializerGroups={"price"})
     * @Rest\Get("/adverts")
     */
    public function getAdvertsAction(Request $request)
    {
        $adverts = $this->get('doctrine.orm.entity_manager')
            ->getRepository('ApiBundle:Advert')
            ->findAll();
        /* @var $adverts Advert[] */

        return $adverts;
    }
    /**
     * @Rest\View()
     * @Rest\Get("/advert/{id}")
     */
    public function getAdvertAction(Request $request)
    {
        $advert = $this->get('doctrine.orm.entity_manager')
            ->getRepository('ApiBundle:Advert')
            ->find($request->get('id')); // L'identifiant en tant que paramétre n'est plus nécessaire
        /* @var $advert Advert */

        if (empty($advert)) {
            return new JsonResponse(['message' => 'Advert not found'], Response::HTTP_NOT_FOUND);
        }

        return $advert;
    }
    /**
    * @Rest\View()
    * @Rest\Get("/images")
    */
    public function getImagesAction(Request $request)
    {
        $images = $this->get('doctrine.orm.entity_manager')
            ->getRepository('ApiBundle:Image')
            ->findAll();
        /* @var $image Image[] */

        return $images;
    }
    /**
     * @Rest\View()
     * @Rest\Get("/image/{id}")
     */
    public function getImageAction(Request $request)
    {
        $image = $this->get('doctrine.orm.entity_manager')
            ->getRepository('ApiBundle:Image')
            ->find($request->get('id')); // L'identifiant en tant que paramétre n'est plus nécessaire
        /* @var $image Image */

        if (empty($image)) {
            return new JsonResponse(['message' => 'Advert not found'], Response::HTTP_NOT_FOUND);
        }

        return $image;
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/adverts")
     */
    public function postAdvertsAction(Request $request)
    {
        $advert = new Advert();
        $form = $this->createForm(AdvertType::class, $advert);

        $form->submit($request->request->all());
        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($advert);
            $em->flush();
            return $advert;
        } else {
            return $form;
        }
    }
    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/advert/{id}")
     */
    public function removeAdvertAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $advert = $em->getRepository('ApiBundle:Advert')
            ->find($request->get('id'));
        /* @var $advert Advert */

        if($advert)
        {
            foreach ($advert->getImage() as $image) {
                $em->remove($image);
            }
            $em->remove($advert);
            $em->flush();
        }
    }
    /**
     * @Rest\View()
     * @Rest\Put("/adverts/{id}")
     */
    public function updateAdvertAction(Request $request)
    {
        return $this->updateAdvert($request, true);
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/adverts/{id}")
     */
    public function patchAdvertAction(Request $request)
    {
        return $this->updateAdvert($request, false);
    }

    private function updateAdvert(Request $request, $clearMissing)
    {
        $advert = $this->get('doctrine.orm.entity_manager')
            ->getRepository('ApiBundle:Advert')
            ->find($request->get('id')); // L'identifiant en tant que paramètre n'est plus nécessaire
        /* @var $advert Advert */

        if (empty($advert)) {
            return new JsonResponse(['message' => 'Advert not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(AdvertType::class, $advert);

        $form->submit($request->request->all(), $clearMissing);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($advert);
            $em->flush();
            return $advert;
        } else {
            return $form;
        }
    }
}