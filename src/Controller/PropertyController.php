<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class PropertyController extends AbstractController
{
  public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
  {
    $this->repository = $repository;
    $this->em = $em;
  }

  /**
  * @Route("/biens", name="property.index")
  * @return Response
  */
  public function index(): Response
  {
    // $property = new Property();
    // $property->setTitle('Mon premier bien')
    //   ->setPrice(200000)
    //   ->setRooms(4)
    //   ->setBedrooms(3)
    //   ->setDescription('Une petite description')
    //   ->setSurface(60)
    //   ->setFloor(4)
    //   ->setHeat(1)
    //   ->setCity('Champignac')
    //   ->setAddress('Avenue du Compte')
    //   ->setPostalCode('12345');
    // $em = $this->getDoctrine()->getManager();
    // $em->persist($property);
    // $em->flush();

    return $this->render('property/index.html.twig',[
      'current_menu' => 'properties'
    ]);
  }
}

 ?>
