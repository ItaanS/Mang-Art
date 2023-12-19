<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MangArtRepository;
use App\Repository\ThemArtRepository;
// use App\Entity\MangArt;
// use App\Entity\ThemArt;
// use App\Form\MangArtType;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\File\Exception\FileException;
// use Symfony\Component\String\Slugger\SluggerInterface;

class ImageController extends AbstractController
{
    #[Route('/mangarts/{id}', name: 'app_mangarts_show')]
    public function image(ThemArtRepository $themArtRepository, MangArtRepository $mangArtRepository, $id): Response
    {
        $mangArts = $mangArtRepository->find($id);
        return $this->render('image/image.html.twig', [
            'mangArts' => $mangArts,
        ]);
    }
}
