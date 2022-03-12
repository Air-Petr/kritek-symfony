<?php

namespace App\Controller;

use App\Form\InvoiceType;
use App\Entity\Invoice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class FormPageController extends AbstractController
{
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        // just set up a fresh $task object (remove the example data)
        $invoice = new Invoice();

        $form = $this->createForm(InvoiceType::class, $invoice);

        $form->handleRequest($request);
        $errors = [];

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $invoice = $form->getData();

                $entityManager = $doctrine->getManager();
                $entityManager->persist($invoice);
                $entityManager->flush();
            } else {
                $errors = $form->getErrors(true);
            }
        }

        return $this->renderForm('form-page.html.twig', [
            'form' => $this->createForm(InvoiceType::class),
            'errors' => $errors
        ]);
    }
}