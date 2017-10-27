<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace MLFirstBundle\Controller;

use MLFirstBundle\Entity\Advert;
use MLFirstBundle\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('MLFirstBundle:Advert');
        $listAdverts = $repository->findBy(
            array(),                 // Pas de critère
            array('date' => 'desc'), // On trie par date décroissante
            null,                  // On sélectionne $limit annonces
            0
        );

        return $this->render('MLFirstBundle:Advert:index.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }

    public function viewAction($id)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('MLFirstBundle:Advert')
        ;
        $advert = $repository->find($id);
        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
        return $this->render('MLFirstBundle:Advert:view.html.twig', array(
            'advert' => $advert
        ));
    }

    public function addAction(Request $request)
    {
        $advert = new Advert();

        $form = $this->get('form.factory')->create(AdvertType::class, $advert);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
                return $this->redirectToRoute('ml_view', array('id' => $advert->getId()));
            }
        }
        return $this->render('MLFirstBundle:Advert:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('MLFirstBundle:Advert')
        ;

        $advert = $repository->find($id);

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
        $form = $this->get('form.factory')->create(AdvertType::class, $advert);


        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

                return $this->redirectToRoute('ml_view', array('id' => $advert->getId()));
            }
        }
        return $this->render('MLFirstBundle:Advert:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('MLFirstBundle:Advert')->find($id);

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
        $em->remove($advert);
        $em->flush();
        return $this->render('MLFirstBundle:Advert:delete.html.twig');
    }


    public function menuAction($limit)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('MLFirstBundle:Advert')
        ;
        $listAdverts = $repository->findBy(
            array(),                 // Pas de critère
            array('date' => 'desc'), // On trie par date décroissante
            $limit,                  // On sélectionne $limit annonces
            0
        );

        return $this->render('MLFirstBundle:Advert:menu.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }
}