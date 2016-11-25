<?php  
namespace ApiBundle\Controller\V1;
 
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Status;
use AppBundle\Type\StatusType;
 
class StatusController extends FOSRestController
{
    /**
    * @return array
    * @Rest\Get("/status/{id}.{_format}")
    * @Rest\View
    */
    public function getStatusAction($id=0)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Status');
        
        $data = $id ? $repo->find($id) : $repo->findAll();

        return array('data' => $data);
    }
    
    /**
     * POST Route annotation.
     * @Rest\Post("/status/new.{_format}")
     * @Rest\View
     * @return array
     */
    public function newStatusAction(Request $request)
    {
        $status = new Status();
        
        $form = $this->createForm(new StatusType(), $status);
     
        $form->handleRequest($request);
     
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($status);
            $em->flush();
     
            return array('data' => $status);
        }
     
        return View::create($form, 400);
    }
    
    /**
     * PATCH Route annotation.
     * @Rest\Patch("/status/update/{id}.{_format}")
     * @Rest\View
     * @return array
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Status');
        
        $status = $repo->find($id);
     
        $form = $this->createForm(new StatusType(), $status, array('method' => 'PATCH'));
     
        $form->handleRequest($request);
        if($status) {
            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($status);
                $em->flush();
     
                return array('data' => $status);
            } else {
                return View::create($form, 400);
            }
        } else {
            throw $this->createNotFoundException('Status not found!');
        }
    }
    
    /**
     * DELETE Route annotation.
     * @Rest\Delete("/status/delete/{id}.{_format}")
     * @Rest\View(statusCode=204)
     * @return array
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $status = $em->getRepository('AppBundle:Status')->find($id);
     
        $em->remove($status);
        $em->flush();
    }
    
    
}