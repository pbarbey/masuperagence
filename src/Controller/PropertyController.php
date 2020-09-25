<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

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
  public function index(PaginatorInterface $paginator, Request $request): Response
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

    $properties = $paginator->paginate(
      $this->repository->FindAllVisibleQuery(),
      $request->query->getInt('page',1),
      6
    );

    return $this->render('property/index.html.twig',[
      'current_menu' => 'properties',
      'properties' => $properties
    ]);
  }

/**
* @Route("biens/{slug}-{id}", name="property.show", requirements={"slug":"[a-z0-9\-]*"})
* @return Response
*/
  public function show(Property $property, string $slug): Response
  {
    if($property->getSlug() !== $slug)
    {
      return $this->redirectToRoute('property.show',[
        'id' => $property->getId(),
        'slug' => $property->getSlug()
      ], 301);
    }
        return $this->render('property/show.html.twig',[
      'property' => $property,
      'current_menu' => 'properties'
    ]);
  }
}

 ?>
