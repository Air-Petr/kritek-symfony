<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormPageController extends AbstractController
{
    public function index()
    {
        return $this->render('form-page.html.twig');
    }
}