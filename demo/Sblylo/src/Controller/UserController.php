<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/users")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user = $userRepository->findAll();
        $serializer = SerializerBuilder::create()->build();
        $reponse = $serializer->serialize($user, 'json');
        $reponse = json_decode($reponse);
        return new JsonResponse($reponse);
    }

    /**
     * @Route("", name="user_new", methods={"POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $em = $this->getDoctrine()->getManager();

        $email = $request->request->get('_email');
        $password = $request->request->get('_password');

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($encoder->encodePassword($user, $password));
        $em->persist($user);
        $em->flush();

        return new JsonResponse(['success' => 'New user created']);
    }

    /**
     * @Route("/me", name="user_me", methods={"GET"})
     */
    public function showMe(): Response
    {
        $user = $this->getUser();
        $serializer = SerializerBuilder::create()->build();
        $reponse = $serializer->serialize($user, 'json');
        $reponse = json_decode($reponse);
        return new JsonResponse($reponse);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        $serializer = SerializerBuilder::create()->build();
        $reponse = $serializer->serialize($user, 'json');
        $reponse = json_decode($reponse);
        return new JsonResponse($reponse);
    }

    /**
     * @Route("/{id}", name="user_edit", methods={"PUT"})
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $encoder): Response
    {
        $em = $this->getDoctrine()->getManager();

        $email = $request->request->get('_email');
        $password = $request->request->get('_password');

        $user->setEmail($email);
        $user->setPassword($encoder->encodePassword($user, $password));
        $em->persist($user);
        $em->flush();

        return new JsonResponse(['success' => 'User edited']);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token')) || true) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
