<?php

declare(strict_types=1);

namespace App\Controller;

use App\UseCase\BankInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListBanksController extends AbstractController
{
    private BankInteractor $bankInteractor;

    public function __construct(BankInteractor $bankInteractor)
    {
        $this->bankInteractor = $bankInteractor;
    }

    /**
     * @Route("", name="home", methods={"GET", "POST"})
     */
    public function lissdts(Request $request): Response
    {
        $bankSelect = new \BankSelection();
        $form = $this->createForm(\BankSelectionType::class, $bankSelect);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $banks = $this->bankInteractor->search($bankSelect, $this->getUser());
            $monthlyPayments = $this->bankInteractor->calculMonthlyPayments($banks, $bankSelect);
            return $this->render('bankList.html.twig', ['banks' => $banks, "monthlyPayments" => $monthlyPayments  ,'form' => $form->createView()]);
        }
        $banks = $this->bankInteractor->getAll($this->getUser());

        return $this->render('bankList.html.twig', ['banks' => $banks, 'form' => $form->createView()]);
    }


}