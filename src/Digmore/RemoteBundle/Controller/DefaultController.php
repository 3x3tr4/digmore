<?php

namespace Digmore\RemoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RemoteBundle:Default:index.html.twig', array('name' => $name));
    }

    public function apiAction($command = false)
    {
    	$finder = new Finder();
    	$finder
    	->files()
    	->in('/mine')
    	->name('/^([a-f\d]{2}:){5}[a-f\d]{2}.conf$/i');
    	echo '<pre>';
    	foreach ($finder as $file) {
    		$contents = $file->getContents();
    		foreach ($finder as $file) {
    			echo $file->getRelativePathname()."\n";
    			var_dump(
    			json_decode($contents,1)//['pools']
    			);
    		}
    	}

    	$out = shell_exec('/opt/api.sh 192.168.168.4 devs');

    	var_dump($out);
    	echo '</pre>';

    	return $this->render(
    		'RemoteBundle:Default:index.html.twig',
    		array('name' => $name)
    	);
    }
}
