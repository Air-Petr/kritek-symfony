<?php

namespace App\Controller;

use App\Form\InvoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class FormPageController extends AbstractController
{
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(InvoiceType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $invoice = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->renderForm('form-page.html.twig', [
            'form' => $form
        ]);
    }
}