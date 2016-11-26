<?php  
namespace ApiBundle\Controller\V1;
 
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use AppBundle\Entity\OrderStatus;
use AppBundle\Type\OrderStatusType;
 
class OrderStatusController extends FOSRestController
{
    /**
    * @return array
    * @Rest\Get("/orderstatus/{id}.{_format}")
    * @Rest\View
    */
    public function getOrderStatusAction($id=0)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:OrderStatus');
        
        $data = $id ? $repo->find($id) : $repo->findAll();

        return array('data' => $data);
    }
    
    /**
     * POST Route annotation.
     * @Rest\Post("/orderstatus/new.{_format}")
     * @Rest\View
     * @return array
     */
    public function newOrderStatusAction(Request $request)
    {
        $orderstatus = new OrderStatus();
        
        $form = $this->createForm(new OrderStatusType(), $orderstatus);
     
        $form->handleRequest($request);
     
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $orderstatus->setStatusDatetime(date_create(date('Y-m-d H:i:s')));
            $em->persist($orderstatus);
            $em->flush();
     
            return array('data' => $orderstatus);
        }
     
        return View::create($form, 400);
    }
    
    /**
     * PATCH Route annotation.
     * @Rest\Patch("/orderstatus/update/{id}.{_format}")
     * @Rest\View
     * @return array
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:OrderStatus');
        
        $orderstatus = $repo->find($id);
     
        $form = $this->createForm(new OrderStatusType(), $orderstatus, array('method' => 'PATCH'));
     
        $form->handleRequest($request);
        if($orderstatus) {
            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($orderstatus);
                $em->flush();
     
                return array('data' => $orderstatus);
            } else {
                return View::create($form, 400);
            }
        } else {
            throw $this->createNotFoundException('OrderStatus not found!');
        }
    }
    
    /**
     * DELETE Route annotation.
     * @Rest\Delete("/orderstatus/delete/{id}.{_format}")
     * @Rest\View(statusCode=204)
     * @return array
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $orderstatus = $em->getRepository('AppBundle:OrderStatus')->find($id);
     
        $em->remove($orderstatus);
        $em->flush();
    }
    
    
}