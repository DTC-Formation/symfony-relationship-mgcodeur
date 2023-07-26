<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use App\Repository\AddressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/address', name: 'address.')]
class AddressController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(AddressRepository $addressRepository): Response
    {
        return $this->render('address/index.html.twig', [
            'addresses' => $addressRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Address $address): Response
    {
        return $this->render('address/show.html.twig', [
            'address' => $address,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Address $address, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);
        
        $formIsValid = $form->isSubmitted() && $form->isValid();

        if ($formIsValid) {
            $entityManager->flush();

            return $this->redirectToRoute('address.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('address/edit.html.twig', [
            'address' => $address,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Address $address, EntityManagerInterface $entityManager): Response
    {
        $csrfTokenIsValid = $this->isCsrfTokenValid('delete'.$address->getId(), $request->request->get('_token'));
        
        if ($csrfTokenIsValid) {
            $user = $address->getUser();
            $user->setAddress(null);

            $entityManager->remove($address);
            $entityManager->flush();
        }

        return $this->redirectToRoute('address.index', [], Response::HTTP_SEE_OTHER);
    }
}
