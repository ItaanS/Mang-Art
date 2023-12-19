<?php

namespace App\Controller;

use App\Entity\ThemArt;
use App\Repository\MangArtRepository;
use App\Repository\ThemArtRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ThemArtController extends AbstractController
{
    #[Route('/them/art/', name: 'them_art')]
    public function index(MangArtRepository $mangArtRepository, ThemArtRepository $themArtRepository): Response
    {
        $mangArts = $mangArtRepository->findAll();
        $themArts = $themArtRepository->findAll();
        return $this->render('them_art/index.html.twig', [
            'mangArts' => $mangArts,
            'themArts' => $themArts,
        ]);
    }

    #[Route('showConcept/{theme}', name: '_Concept')]
    public function showConcept(ThemArt $theme): Response
    {
        return $this->render('them_art/mangArt_show.html.twig', [
            "mangArts" => $theme->getMangArts()
        ]);
    }
}
