<?php

namespace ThousandMonkeys\LibraryBundle\Controller;

use ThousandMonkeys\LibraryBundle\Entity\Version;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;



class VersionController extends Controller
{
    public function showAction($versionId)
    {
        return $this->render('ThousandMonkeysLibraryBundle:Version:index.html.twig', array('versionId' => $versionId));
    }

    public function addAction()
    {
    	return $this->render('ThousandMonkeysLibraryBundle:Version:add.html.twig', array());
    }

    public function makedummyAction()
    {
        $userId = $this->getUser()->getId;

    	$version = new Version();
    	$version->setVersionName("V1");
    	$version->setWebFileDirPath("http://www.google.com");
    	$version->setUploadedByUserId($userId);

		$em = $this->getDoctrine()->getManager();
    	$em->persist($version);
    	$em->flush();

    	return new Response('Created version with id '.$version->getId());

    }
}
