<?php  
namespace ApiBundle\Controller\V1;
 
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Order;
use AppBundle\Entity\OrderStatus;
use AppBundle\Type\OrderType;
 
class OrderController extends FOSRestController
{
    /**
    * @return array
    * @Rest\Get("/order/{id}.{_format}")
    * @Rest\View
    */
    public function getOrderAction($id=0)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Order');
        
        $data = $id ? $repo->find($id) : $repo->findAll();

        return array('data' => $data);
    }
    
    /**
    * @return array
    * @Rest\Get("/orderFree.{_format}")
    * @Rest\View
    */
    public function getFreeOrderAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Order');
        
        $data = $repo->findAllFree();

        return array('data' => $data);
    }
    
    /**
    * @return array
    * @Rest\Get("/orderByUser/{id}.{_format}")
    * @Rest\View
    */
    public function getOrderByUserAction($id=0)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Order');
        
        $data = $repo->findAllByUser($id);

        return array('data' => $data);
    }
    
    /**
    * @return array
    * @Rest\Get("/orderByDriver/{id}.{_format}")
    * @Rest\View
    */
    public function getOrderByDriverAction($id=0)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Order');
        
        $data = $repo->findAllByDriver($id);

        return array('data' => $data);
    }
    
    /**
     * POST Route annotation.
     * @Rest\Post("/order/new.{_format}")
     * @Rest\View
     * @return array
     */
    public function newOrderAction(Request $request)
    {
        $order = new Order();
        
        $form = $this->createForm(new OrderType(), $order);
     
        $form->handleRequest($request);
     
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            
            $s = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:Status')
                ->find(1);
            
            $os = new OrderStatus();
            $os->setStatusDatetime(date_create(date('Y-m-d H:i:s')));
            $os->setStatus($s);
            $os->setOrder($order);
            $em->persist($os);
            $em->persist($order);
            $em->flush();
     
            return array('data' => $order);
        }
     
        return View::create($form, 400);
    }
    
    /**
     * PATCH Route annotation.
     * @Rest\Patch("/order/update/{id}.{_format}")
     * @Rest\View
     * @return array
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Order');
        
        $order = $repo->find($id);
        
        //if the order is already taken by another driver
        if($order->getDriver() != null) return array('error' => 'The order is already taken by a driver');
     
        $form = $this->createForm(new OrderType(), $order, array('method' => 'PATCH'));
     
        $form->handleRequest($request);
        if($order) {
            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                
                $s = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:Status')
                ->find(2);
            
                $os = new OrderStatus();
                $os->setStatusDatetime(date_create(date('Y-m-d H:i:s')));
                $os->setStatus($s);
                $os->setOrder($order);
                $em->persist($os);
                
                $em->persist($order);
                $em->flush();
     
                return array('data' => $order);
            } else {
                return View::create($form, 400);
            }
        } else {
            throw $this->createNotFoundException('Order not found!');
        }
    }
    
    /**
     * DELETE Route annotation.
     * @Rest\Delete("/order/delete/{id}.{_format}")
     * @Rest\View(statusCode=204)
     * @return array
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('AppBundle:Order')->find($id);
     
        $em->remove($order);
        $em->flush();
    }
    
    
}