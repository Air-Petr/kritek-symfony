<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class InvoiceController extends AbstractController
{
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $invoice = $doctrine
            ->getManager()
            ->getRepository(Invoice::class)
            ->find($request->get('id'));

        return $this->render('invoice-page.html.twig', [
            'invoice' => $invoice
        ]);
    }
}