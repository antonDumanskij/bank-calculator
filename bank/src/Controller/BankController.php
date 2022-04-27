<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\CreateBankType;
use App\Model\Bank;
use App\UseCase\BankInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BankController extends AbstractController
{
    private BankInteractor $bankInteractor;

    public function __construct(BankInteractor $bankInteractor)
    {
        $this->bankInteractor = $bankInteractor;
    }

    /**
     * @Route("/bank/new", name="bank.new", methods={"GET", "POST"})
     */
    public function createBank(Request $request): Response
    {
        $bank = new Bank();
        $form = $this->createForm(CreateBankType::class, $bank);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->bankInteractor->create($bank, $this->getUser());

            return $this->redirectToRoute('home');
        }

        return $this->render('editBank.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/bank/{id}/edit", name="bank.edit", methods={"GET", "POST"}, requirements={"id": "^\d+$"})
     */
    public function edit(Request $request, int $id): Response
    {
        if (!$this->bankInteractor->isOwner($this->getUser(), $id)) {
            return $this->render("home.html.twig", [ 'errors' => "You haven't permission for edit"]);
        }
        try {
            $bank = $this->bankInteractor->findById($id);
        } catch (\Exception $e) {
            return $this->render('home.html.twid', ["errors" => "Error"]);
        }

        $modal = Bank::serializationEntity($bank);
        $form = $this->createForm(CreateBankType::class, $modal);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->bankInteractor->edit($id,$modal);

            return $this->redirectToRoute('home');
        }

        return $this->render('editBank.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/bank/{id}/delete", methods={"DELETE"}, requirements={"id": "^\d+$"}, name="bank.delete")
     */
    public function delete(Request $request, int $id): Response
    {
        if (!$this->bankInteractor->isOwner($this->getUser(), $id)) {
            return $this->render("home.html.twig", [ 'errors' => "You haven't permission for delete"]);
        }

        try {
            $this->bankInteractor->delete($id);
        } catch (\Exception $e) {
            return $this->render("home.html.twig", [ 'errors' => "something went wrong maybe you entered a non-existent bank"]);
        }

        return $this->redirectToRoute('home');
    }


}