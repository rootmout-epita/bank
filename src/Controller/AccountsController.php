<?php

namespace App\Controller;

use App\Entity\Accounts;
use App\Entity\User;
use App\Form\AccountFormType;
use App\Repository\AccountsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
     * @Route("/accounts/{id}", name="edit.accounts")
     * @param Accounts $account
     * @return Response
     */
    public function edit(Accounts $accounts, Request $request)
    {
        $form = $this->createForm(AccountFormType::class, $accounts);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            return $this->redirectToRoute('accounts');
        }

        return $this->render('accounts/edit.html.twig', [
            'account' => $accounts,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/accounts/new", name="new.accounts")
     *
     */
    public function new(Request $request)
    {
        $account = new Accounts();
        $form = $this->createForm(AccountFormType::class, $account);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($account);
            $this->em->flush();
            return $this->redirectToRoute('accounts');
        }

        return $this->render('accounts/new.html.twig', [
            'account' => $accounts,
            'form' => $form->createView(),
        ]);
    }
}
