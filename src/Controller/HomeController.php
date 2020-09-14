<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;
use App\Repository\PropertyRepository;

class HomeController extends AbstractController
{
  /**
  * @param PropertyRepositiry $repository
  * @return Response
  */
  public function index(PropertyRepository $repository): Response
  {
    $properties = $repository->findLatest();
    return $this->render('pages/home.html.twig',[
      'properties' => $properties
    ]);
  }
}
 ?>
