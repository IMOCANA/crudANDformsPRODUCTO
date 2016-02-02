<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Producto;
use AppBundle\Form\ProductoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class ProductoController extends Controller
{
    /**
     *  indexAction
     *
     * @Route(path="/", name="app_producto_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Producto');
        $producto = $repository->findAll();
        //die;
        return $this->render('producto/index.html.twig',
            [
                'producto' => $producto,
            ]
        );
    }
    /**
     * @Route("/update/{id}", name="app_producto_update")
     */
    public function  updateAction($id)
    {
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Producto');
        $producto = $repository->find($id);
        $form = $this->createForm(ProductoType::class, $producto);

        return $this->render('producto/form.html.twig',
            [
                'form'     => $form->createView(),
                'action'   => $this->generateUrl('app_producto_doupdate', ['id' => $id]),
            ]
        );
    }
    /**
     * @Route(path="/doupdate/{id}", name="app_producto_doupdate")
     * @param Request $request
     */
    public function doUpdateAction($id, Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $producto = $m->getRepository('AppBundle:Producto')->find($id);
        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);
        if ($form->isValid())
        {
            $m->flush();
            $this->addFlash('messages', 'Product Updated');
            return $this->redirectToRoute('app_producto_index');
        }
        $this->addFlash('messages', 'Review your form data');
        return $this->render(':produto:form.html.twig',
            [
                'form'      => $form->createView(),
                'action'    => $this->generateUrl('app_producto_doinsert')
            ]
        );
    }
    /**
     * @Route(path="/insert", name="app_producto_insert")
     */
    public function insertAction()
    {
        $producto = new Producto();
        $form = $this->createForm(ProductoType::class, $producto);
        return $this->render(':producto:form.html.twig',
            [
                'form'      => $form->createView(),
                'action'    =>$this->generateUrl('app_producto_doinsert')
            ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route(path="/done", name="app_producto_doinsert")
     */
    public function doInsertAction(Request $request)
    {
        $producto = new Producto();
        $form = $this->createForm(ProductoType::class, $producto);
        $form->handleRequest($request);
        if ($form->isValid())
        {
            $m = $this->getDoctrine()->getManager();
            $m->persist($producto);
            $m->flush();
            $this->addFlash('messages', 'Product added');
            return $this->redirectToRoute('app_producto_index');
        }
        $this->addFlash('messages', 'Review your form data');
        return $this->render(':producto:form.html.twig',
            [
                'form'      => $form->createView(),
                'action'    => $this->generateUrl('app_producto_doinsert')
            ]
        );
    }
    /**
     *
     * @Route(name="app_producto_remove", path="/remove/{id}")
     */
    public function removeAction($id)
    {
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Producto');
        $producto = $repository->find($id);
        $m->remove($producto);
        $m->flush();
        $this->addFlash('messages', 'Product has been removed');
        return $this->redirectToRoute('app_producto_index');
    }
}
