<?php
declare(strict_types=1);

namespace App\Application\Actions\Termin;

use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\Termin;

class ListTerminsAction extends TerminAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        return $this->respondWithData($this->terminRepository->findAll());
    }
}
