<?php
declare(strict_types=1);

namespace App\Application\Actions\Termin;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;
use App\Domain\Termin\Termin;

class AddTerminAction extends TerminAction
{
    public function __invoke(ServerRequestInterface $request, Response $response, array $args) : Response
    {
        $data = $this->getFormData();

        $termin = new Termin();
        $termin
            ->setStartDate($data->txStartDate)
            ->setEndDate($data->txEndDate)
            ->setTytul($data->txTytul)
            ->setOpis($data->txOpis)
            ->setImieNazwiskoKlienta($data->txImieNazwiskoKlienta)
            ->setEmailKlienta($data->txEmailKlienta)
            ->setStatus(1);

        $this->terminRepository->addTermin($termin);

        $response->getBody()->write((string)json_encode($termin->jsonSerialize()));  // Build the HTTP response

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }


     /**
      * {@inheritdoc}
      */
     protected function action(): Response
     {
//         //$terminId = (int) $this->resolveArg('id');
//         echo "edyyyy";   print_r ((array)$request->getParsedBody());
        return $this->respondWithData($this->terminRepository->findById(6 /*$terminId*/));
     }
}
