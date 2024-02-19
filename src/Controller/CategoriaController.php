<?php

namespace App\Controller;

use App\Entity\Categoria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CategoriaController extends AbstractController
{
    public function index(EntityManagerInterface $entityManager) : Response
    {
        //$entityManager é o objeto que vai auxiliar a executar as ações no BD
        $categoria = new Categoria();
        $categoria->setDescricaocategoria("Informática");
        $mensagem = "";

        try{
            $entityManager->persist($categoria); //Salvar a persistência em nível de memória
            $entityManager->flush(); //Executar a persistência no BD
            $mensagem = "Categoria Cadastrada com sucesso!";
        }catch(Exception $e){
            $mensagem = "Erro ao cadastrar categoria!";
        }
        return new Response("<p>".$mensagem."</p>");
    }
}