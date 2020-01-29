<?php
namespace App\Controller\api;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Controller\api\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface; 
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class ApiAuthController extends AbstractController
{
    
    public static function getSubscribedServices(): array  //ON surcharge cette fonction pour ajouter nos services aux services existants #Spécialité Symfony4
        {
            return array_merge(parent::getSubscribedServices(), [ // on merge le tableau des services par defaut avec notre tableau personnalisé
                'orange.mailer' => 'App\Service\Mailer',
            ]);
        }
        
    /**
     * @Route("/register", name="api_auth_register",  methods={"POST"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function register(Request $request, UserManagerInterface $userManager)
    {
        //return $this->render('Mail/notif.html.twig');
        $mailer = $this->get('orange.mailer');
        $mailer->Notif('yaya.ly@uadb.edu.sn','test','Hello word');
       
        $data = json_decode(
            $request->getContent(),
            true
        );
        $validator = Validation::createValidator();

        $constraint = new Assert\Collection(array(
            // the keys correspond to the keys in the input array
            'username' => new Assert\Length(array('min' => 1)),
            'password' => new Assert\Length(array('min' => 1)),
            'email' => new Assert\Email(),
        ));

        $violations = $validator->validate($data, $constraint);

        if ($violations->count() > 0) {
            return new JsonResponse(["error" => (string)$violations], 500);
        }

        $username = $data['username'];
        $password = $data['password'];
        $email = $data['email'];

        $user = new User();

        $user
            ->setUsername($username)
            ->setPlainPassword($password)
            ->setEmail($email)
            ->setEnabled(true)
            ->setRoles(['ROLE_USER'])
            ->setSuperAdmin(false)
        ;

        try {
            $userManager->updateUser($user, true);
        } catch (\Exception $e) {
            return new JsonResponse(["error" => $e->getMessage()], 500);
        }

        return new JsonResponse(["success" => $user->getUsername(). " has been registered!"], 200);
    }

    /** 
     * @Route("/index", name="index_User")
     */
    public function index(SerializerInterface $serializer,Request $request)
    {
       $users = $this->getDoctrine()
                        ->getRepository(User::class)
                        ->findAll();
       $data = $serializer->serialize($users,'json');

        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
     }
}