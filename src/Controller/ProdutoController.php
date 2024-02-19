<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ProdutoController extends AbstractController
{
    public function index(EntityManagerInterface $entityManager, CategoriaRepository $categoriaRepository) : Response
    {
        $categoria = $categoriaRepository->find(1); //1 = Categoria Informática
        $produto = new Produto();
        $produto->setNomeproduto("Notebook");
        $produto->setValor(3000);
        $produto->setCategoria($categoria);
        $mensagem = "";

        try{
            $entityManager->persist($produto); //Salvar a persistência em nível de memória
            $entityManager->flush(); //Executar a persistência no BD
            $mensagem = "Produto Cadastrado com sucesso!";
        }catch(Exception $e){
            $mensagem = "Erro ao cadastrar produto!";
        }
        return new Response("<p>".$mensagem."</p>");
    }
}