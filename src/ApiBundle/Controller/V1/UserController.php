<?php  
namespace ApiBundle\Controller\V1;
 
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use AppBundle\Entity\User;
use AppBundle\Type\UserType;
 
class UserController extends FOSRestController
{
    /**
    * @return array
    * @Rest\Get("/user/{id}.{_format}")
    * @Rest\View
    */
    public function getUserAction($id=0)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:User');
        
        $data = $id ? $repo->find($id) : $repo->findAll();

        return array('data' => $data);
    }
    
    /**
     * POST Route annotation.
     * @Rest\Post("/user/new.{_format}")
     * @Rest\View
     * @return array
     */
    public function newUserAction(Request $request)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        
        //$user = new User();
        
        $form = $this->createForm(new UserType(), $user);
     
        $form->handleRequest($request);
     
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
     
            return array('data' => $user);
        }
     
        return View::create($form, 400);
    }
    
    /**
     * PATCH Route annotation.
     * @Rest\Patch("/user/update/{id}.{_format}")
     * @Rest\View
     * @return array
     */
    public function updateAction(Request $request, $id)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id'=>$id));
     
        $form = $this->createForm(new UserType(), $user, array('method' => 'PATCH'));
     
        $form->handleRequest($request);
        if($user) {
            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
     
                return array('data' => $user);
            } else {
                return View::create($form, 400);
            }
        } else {
            throw $this->createNotFoundException('User not found!');
        }
    }
    
    /**
     * DELETE Route annotation.
     * @Rest\Delete("/user/delete/{id}.{_format}")
     * @Rest\View(statusCode=204)
     * @return array
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
     
        $em->remove($user);
        $em->flush();
    }
    
    
}