<?php  
namespace ApiBundle\Controller\V1;
 
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Item;
use AppBundle\Type\ItemType;
 
class ItemController extends FOSRestController
{
    /**
    * @return array
    * @Rest\Get("/item/{id}.{_format}")
    * @Rest\View
    */
    public function getItemAction($id=0)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Item');
        
        $data = $id ? $repo->find($id) : $repo->findAll();

        return array('data' => $data);
    }
    
    /**
     * POST Route annotation.
     * @Rest\Post("/item/new.{_format}")
     * @Rest\View
     * @return array
     */
    public function newItemAction(Request $request)
    {
        $item = new Item();
        
        $form = $this->createForm(new ItemType(), $item);
     
        $form->handleRequest($request);
     
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
     
            return array('data' => $item);
        }
     
        return View::create($form, 400);
    }
    
    /**
     * PATCH Route annotation.
     * @Rest\Patch("/item/update/{id}.{_format}")
     * @Rest\View
     * @return array
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Item');
        
        $item = $repo->find($id);
     
        $form = $this->createForm(new ItemType(), $item, array('method' => 'PATCH'));
     
        $form->handleRequest($request);
        if($item) {
            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($item);
                $em->flush();
     
                return array('data' => $item);
            } else {
                return View::create($form, 400);
            }
        } else {
            throw $this->createNotFoundException('Item not found!');
        }
    }
    
    /**
     * DELETE Route annotation.
     * @Rest\Delete("/item/delete/{id}.{_format}")
     * @Rest\View(statusCode=204)
     * @return array
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository('AppBundle:Item')->find($id);
     
        $em->remove($item);
        $em->flush();
    }
    
    
}