<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CategoriaController extends AbstractController
{
    public function index(CategoriaRepository $categoriaRepository) : Response
    {
        $data['categorias'] = $categoriaRepository->findAll();
        $data['titulo'] = 'Categorias';

        return $this->render('categoria/index.html.twig', $data);
    }

    public function create(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $categoria = new Categoria();
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);
        $data['msg'] = "";

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($categoria);
            $entityManager->flush();
            $data['msg'] = 'Categoria Cadastrada com sucesso';
        }

        $data['titulo'] = 'Adicionar nova categoria';
        $data['form'] = $form->createView();

        dump($data['msg']);

        return $this->render('categoria/form.html.twig', $data);
    }

    public function edit(
        $id, 
        Request $request, 
        EntityManagerInterface $entityManager, 
        CategoriaRepository $categoriaRepository) : Response
    {
        $msg = "";
        $categoria = $categoriaRepository->find($id);
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($categoria);
            $entityManager->flush();
            $msg = "Categoria atualizada com sucesso!";
        }
        $data["msg"] = $msg;
        $data["titulo"] = "Editar categoria: " . $categoria->getDescricaocategoria();
        $data["form"] = $form->createView();

        return $this->render("categoria/form.html.twig", $data);
    }

    public function delete(
        $id, 
        EntityManagerInterface $entityManager,
        CategoriaRepository $categoriaRepository) : Response
    {
        $categoria = $categoriaRepository->find($id);
        $entityManager->remove($categoria);
        $entityManager->flush();

        return $this->redirectToRoute("categoria");
    }
}