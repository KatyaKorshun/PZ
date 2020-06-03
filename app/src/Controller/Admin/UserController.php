<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\SearchTestType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\User\UserService;
use FOS\UserBundle\Model\UserManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/show", name="user_index", methods={"POST","GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator, UserRepository $userRepository): Response
    {
        $query = $userRepository->getUsersListQuery();

        $form = $this->createForm(SearchTestType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data  = $form->getData();
            $query = $userRepository->getUsersListQuery($data['name']);
        }

        return $this->render('admin/user/index.html.twig', [
            'users'  => $paginator->paginate($query, $request->query->getInt('page', 1), 10),
            'userId' => $this->getUser()->getId(),
            'form'  => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserManagerInterface $userManager, UserService $userService): Response
    {
        $user = new User();
        $isError =false;
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            if ($userManager->findUserByEmail($user->getEmail())) {
                $form->addError(new FormError('Такой email уже существует'));
                $isError = true;
            } else {
                $userService->setRole($request, $user);
                $userManager->updateUser($user);

                return $this->redirectToRoute('user_index');
            }
        }

        return $this->render('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'isError' => $isError,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, UserService $userService, UserManagerInterface $userManager): Response
    {
        $roleAdmin = (in_array('ROLE_ADMIN', $user->getRoles()));

        $form = $this->createForm(UserType::class, $user, ['attr' => ['roleAdmin' => $roleAdmin]]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $userService->setRole($request, $user);
            $userManager->updateUser($user);

            return $this->redirectToRoute('user_index');
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('user_index');
    }
}
