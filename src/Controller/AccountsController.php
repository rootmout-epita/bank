<?php

namespace App\Controller;

use App\Entity\Accounts;
use App\Form\AccountFormType;
use App\Repository\AccountsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountsController extends AbstractController
{
    /**
     * @var AccountsRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(AccountsRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/accounts", name="accounts")
     * @return Response
     */
    public function index(): Response
    {
        $user = $this->getUser();
        $account = $this->repository->findBy(['Client' => $user->getId()]);
        $nbr_accounts = sizeof($account);

        return $this->render('accounts/index.html.twig', [
            'accounts' => $account,
            'user' => $user,
            'nbr_accounts' => $nbr_accounts,
        ]);
    }

    /**
     * @Route("/accounts/edit/{id}", name="edit.accounts", methods="GET|POST")
     * @param Accounts $account
     * @return Response
     */
    public function edit(Accounts $accounts, Request $request)
    {
        if($accounts->getClient() == $this->getUser()->getId()) {
            $form = $this->createForm(AccountFormType::class, $accounts);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $transactionAmount = $request->request->get('transactionAmount');
                if($request->request->get('ActionType') == "debit")
                {
                    $transactionAmount *= -1;
                }

                $accounts->setBalance($accounts->getBalance()+$transactionAmount);
                $accounts->setLastOperation(new \DateTime());
                $this->em->flush();
                $this->addFlash('success', 'Le compte a été mis à jour correctement.');
                //return new Response('<body></body>');
                return $this->redirectToRoute('accounts');
            }

            return $this->render('accounts/edit.html.twig', [
                'account' => $accounts,
                'form' => $form->createView(),
            ]);
        }
        else{
            $this->addFlash('error', 'Vous ne pouvez pas modifier ce compte.');
            return $this->redirectToRoute('accounts');
        }
    }


    /**
     * @Route("/accounts/new", name="new.accounts")
     * @return Response
     */
    public function new(Request $request)
    {
        $account = new Accounts();
        $form = $this->createForm(AccountFormType::class, $account);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $account->setLastOperation(new \DateTime());
            $account->setClient($this->getUser()->getId());
            $this->em->persist($account);
            $this->em->flush();
            $this->addFlash('success', 'Le compte a été crée avec succès.');
            return $this->redirectToRoute('accoun');
        }

        return $this->render('accounts/new.html.twig', [
            'account' => $account,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/accounts/edit/{id}", name="delete.accounts", methods="DELETE")
     * @param Accounts $account
     * @return RedirectResponse
     */
    public function delete(Accounts $account)
    {
        if($account->getClient() == $this->getUser()->getId())
        {
            $this->em->remove($account);
            $this->em->flush();
            $this->addFlash('success', 'Le compte a été supprimé avec succès.');
        }
        else
        {
            $this->addFlash('error', 'Vous ne pouvez pas supprimer ce compte.');
        }
        return $this->redirectToRoute('accounts');
    }

}
