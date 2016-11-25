<?php  
namespace ApiBundle\Controller\V1;
 
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Driver;
use AppBundle\Type\DriverType;
 
class DriverController extends FOSRestController
{
    /**
    * @return array
    * @Rest\Get("/driver/{id}.{_format}")
    * @Rest\View
    */
    public function getDriverAction($id=0)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Driver');
        
        $data = $id ? $repo->find($id) : $repo->findAll();

        return array('data' => $data);
    }
    
    /**
     * POST Route annotation.
     * @Rest\Post("/driver/new.{_format}")
     * @Rest\View
     * @return array
     */
    public function newDriverAction(Request $request)
    {
        $driver = new Driver();
        
        $form = $this->createForm(new DriverType(), $driver);
     
        $form->handleRequest($request);
     
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($driver);
            $em->flush();
     
            return array('data' => $driver);
        }
     
        return View::create($form, 400);
    }
    
    /**
     * PATCH Route annotation.
     * @Rest\Patch("/driver/update/{id}.{_format}")
     * @Rest\View
     * @return array
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Driver');
        
        $driver = $repo->find($id);
     
        $form = $this->createForm(new DriverType(), $driver, array('method' => 'PATCH'));
     
        $form->handleRequest($request);
        if($driver) {
            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($driver);
                $em->flush();
     
                return array('data' => $driver);
            } else {
                return View::create($form, 400);
            }
        } else {
            throw $this->createNotFoundException('Driver not found!');
        }
    }
    
    /**
     * DELETE Route annotation.
     * @Rest\Delete("/driver/delete/{id}.{_format}")
     * @Rest\View(statusCode=204)
     * @return array
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $driver = $em->getRepository('AppBundle:Driver')->find($id);
     
        $em->remove($driver);
        $em->flush();
    }
    
    
}