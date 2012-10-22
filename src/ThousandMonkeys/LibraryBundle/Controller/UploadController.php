<?php

namespace ThousandMonkeys\LibraryBundle\Controller;

use ThousandMonkeys\LibraryBundle\Entity\Game;
use ThousandMonkeys\LibraryBundle\Entity\Document;
use ThousandMonkeys\LibraryBundle\Entity\Version;
use ThousandMonkeys\LibraryBundle\Form\Type\GameType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UploadController extends Controller
{
    public function indexAction()
    {
        $game = new Game();
        $document = new Document();
        $version = new Version();

        $game->addDocument($document);
        $document->addVersion($version);

        $userId = ($this->getUser() != null) ? $this->getUser()->getId() : -1;

    	$form = $this->createForm(new GameType(), $game);

    	if ($this->getRequest()->getMethod() === 'POST') 
    	{
        	$form->bindRequest($this->getRequest());

        	$uploadAbsoluteFileDirPath = $this->container->getParameter('version_upload_absolute_path');
        	$uploadWebFileDirPath = $this->container->getParameter('version_upload_web_path');


        	if ($form->isValid()) 
        	{
            	$em = $this->getDoctrine()->getEntityManager();

                $version->setAbsoluteFileDirPath($uploadAbsoluteFileDirPath);
                $version->setWebFileDirPath($uploadWebFileDirPath);
                $version->setUploadedByUserId($userId);

                
            $this->container->get('logger')->info('game', array(var_export($game, true)));


            	$em->persist($game);
            	$em->flush();
        	}
            else {
                $this->container->get('logger')->info('itsnotvalid', array('invalid'));
            }
    	}

		return $this->render('ThousandMonkeysLibraryBundle:Upload:index.html.twig', 
							  array('form' => $form->createView()));
    }
}

