<?php

namespace App\Controller;

use App\Entity\MangArt;
use App\Entity\ThemArt;
use App\Form\MangArtType;
use App\Repository\MangArtRepository;
use App\Repository\ThemArtRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/mangarts/', name: 'mangarts', methods: ['GET'])]
class MangArtController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('', name: '_index', methods: ['GET'])]
    public function index(MangArtRepository $mangArtRepository, ThemArtRepository $themArtRepository): Response
    {
        $mangArts = $mangArtRepository->findAll();
        $themArts = $themArtRepository->findAll();
        // dd($mangArts);
        return $this->render('picture_manga/index.html.twig', [
            'mangArts' => $mangArts,
            'themArts' => $themArts,
        ]);
    }

    #[Route('new', name: '_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ThemArtRepository $themeRepository, SluggerInterface $slugger): Response
    {
        // Crée une nouvelle instance de la classe MangArt, 
        // crée un formulaire associé à cette instance, 
        // puis gère les données de la requête HTTP pour ce formulaire.
        $mangArt = new MangArt();
        $form = $this->createForm(MangArtType::class, $mangArt);
        $form->handleRequest($request);

        // Vérifie si le formulaire a été soumis avec des données valides, 
        // puis récupère certaines données spécifiques du formulaire.
        if ($form->isSubmitted() && $form->isValid()) {
            $theme = $form->get('theme')->getData();
            $img = $form->get('imageFile')->getData();
            $calqArt = $form->get('calqMangart')->getData();
            $imgName = $form->get('name')->getData();

            // Si le thème existe, 
            // génère de nouveaux noms de fichiers uniques pour l'image principale et le calque MangArt en utilisant le nom d'origine, 
            // le slugger et un identifiant unique.
            if ($theme) {
                $originalFileName = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFileName);
                $newFileName = $safeFilename . '-' . uniqid() . '.' . $img->guessExtension();

                $originalCalqArt = pathinfo($calqArt->getClientOriginalName(), PATHINFO_FILENAME);
                $safeCalqName = $slugger->slug($originalCalqArt);
                $newCalqName = $safeCalqName . '-' . uniqid() . '.' . $calqArt->guessExtension();

                // Définit le thème, 
                // les noms de fichiers pour l'image principale et le calque MangArt, 
                // puis persiste l'objet MangArt dans la base de données.
                $mangArt->setTheme($theme);
                $mangArt->setImageFile($newFileName);
                $mangArt->setcalqMangart($newCalqName);
                $this->entityManager->persist($mangArt);
                $this->entityManager->flush();

                // Tente de déplacer les fichiers image principale et calque MangArt 
                // vers le répertoire de téléchargement spécifié, 
                // tout en gérant les exceptions de type FileException.
                try {
                    $img->move(
                        $this->getParameter('upload_directory'),
                        $newFileName
                    );
                    $calqArt->move(
                        $this->getParameter('upload_directory'),
                        $newCalqName
                    );
                } catch (FileException $e) {
                }

                // Attribue l'image principale, 
                // le calque MangArt et le nom de l'image à l'objet MangArt.
                $mangArt->setImageFile($img);
                $mangArt->setCalqMangart($calqArt);
                $mangArt->setName($imgName);

                return $this->redirectToRoute('mangarts_new');
            } else {
                // error no them
            }
        }

        // Rend la vue 'new.html.twig' en transmettant l'objet MangArt et le formulaire pour l'affichage.
        return $this->render('picture_manga/new.html.twig', [
            'mangArt' => $mangArt,
            'form' => $form,
        ]);
    }

    #[Route('picture/', name: '_show', methods: ['GET'])]
    // Récupère toutes les entrées de la base de données pour les objets MangArt et ThemArt, 
    // puis les transmet à la vue 'index.html.twig' pour affichage.
    public function show(ThemArtRepository $themArtRepository, MangArtRepository $mangArtRepository): Response
    {
        $mangArts = $mangArtRepository->findAll();
        $themArts = $themArtRepository->findAll();
        return $this->render('picture_manga/index.html.twig', [
            'mangArts' => $mangArts,
            'themArts' => $themArts,
        ]);
    }

    #[Route('mangarts/{id}', name: '_delete', methods: ['GET', 'POST'])]
    public function delete(Request $request, MangArt $mangArt): Response
    {
        if ($this->isCsrfTokenValid('delete' . $mangArt->getId(), $request->request->get('_token'))) {
            $entityManager = $this->entityManager;
            $entityManager->remove($mangArt);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mangarts_show');
    }
}
