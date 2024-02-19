<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{
    public function index()
    {
        $data['titulo'] = 'Página inicial';
        $data['mensagem'] = 'Aprendendo templates no Symfony';
        $data['frutas'] = [
            [
                'nome' => 'laranja',
                'valor' => 1.99
            ],
            [
                'nome' => 'uva',
                'valor' => 2.99
            ]
        ];

        return $this->render("hello/index.html.twig", $data);
    }
    public function helloname($name)
    {
        $data['titulo'] = 'Nome da pessoa';
        $data['nome'] = $name;
        return $this->render("hello/helloname.html.twig", $data);
    }
}