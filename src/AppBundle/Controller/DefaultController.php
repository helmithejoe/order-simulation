<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
 
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        if($request->get('login')) {
            $entity = ucfirst($request->get('type'));
            $username = $request->get('username');
            
            $data = $this->getDoctrine()->getManager()
                    ->getRepository('AppBundle:'.$entity)
                    ->findOneByUsername($username);
            
            if(empty($data)) return $this->redirect($this->generateUrl('login'));
            
            if($data->getPassword() == $request->get('password'))
                return $this->redirect($this->generateUrl($request->get('type'), [$request->get('type').'_id'=>$data->getId()]));
        }
        
        // replace this example code with whatever you need
        return $this->render('login.html.twig', array(
            
        ));
    }
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
        return $this->redirect($this->generateUrl('login'));
    }
    
    /**
     * @Route("/", name="home")
     */
    public function homeAction(Request $request)
    {
        return $this->redirect($this->generateUrl('login'));
    }
    
    /**
     * @Route("/user/{user_id}", name="user")
     */
    public function indexAction($user_id, Request $request)
    {
        
        $data = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:User')
                ->find($user_id);
        
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'api_endpoint' => $this->container->getParameter('api_endpoint'),
            'user_id' => $user_id,
            'data' => $data
        ));
    }
    
    /**
     * @Route("/driver/{driver_id}", name="driver")
     */
    public function driverAction($driver_id, Request $request)
    {
        $data = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:Driver')
                ->find($driver_id);
        
        // replace this example code with whatever you need
        return $this->render('default/driver.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'api_endpoint' => $this->container->getParameter('api_endpoint'),
            'driver_id' => $driver_id,
            'data' => $data
        ));
    }
}
