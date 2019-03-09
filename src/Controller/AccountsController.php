<?php

namespace App\Controller;

use App\Entity\Accounts;
use App\Entity\User;
use App\Repository\AccountsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    public function __construct(AccountsRepository $repository)
    {
        $this->repository = $repository;
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
}
