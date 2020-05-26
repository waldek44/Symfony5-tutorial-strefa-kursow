<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Form\UploadPhotoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     */
    public function index(Request $request)
    {
        // pobieram formularz
        $form = $this->createForm(UploadPhotoType::class);
        // Metoda handleRequest zwraca True jeżeli wyślemy formularz metodą POST.
        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {

                $em = $this->getDoctrine()->getManager();

                // sprawdzam czy użytkownik jest zalogowany 
                if($this->getUser()) {
                    $pictureFileName = $form->get('filename')->getData();
                        if($pictureFileName) {
                            $originalFileName = pathinfo($pictureFileName->getClientOriginalName(), PATHINFO_FILENAME);
                            $safeFileName = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFileName);
                            $newFileName = $safeFileName.'-'.uniqid().'.'.$pictureFileName->guessExtension();
                            // żeby zapisał go w folderze public/images/hosting
                            $pictureFileName->move('images/hosting', $newFileName);
                        
                            $entityPhotos = new Photo();
                            $entityPhotos->setFilename($newFileName);
                            $entityPhotos->setIsPublic($form->get('is_public')->getData());
                            $entityPhotos->setUploadedAt(new \DateTime());
                            $entityPhotos->setUser($this->getUser());

                            $em->persist($entityPhotos);
                            $em->flush();
                        }


                }
            }

        return $this->render('index/index.html.twig', [
            'form'=>$form->createView(),
        ]);
    }
}
