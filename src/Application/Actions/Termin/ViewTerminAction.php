<?php
declare(strict_types=1);

namespace App\Application\Actions\Termin;

use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\Termin;

class ViewTerminAction extends TerminAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $terminId = (int) $this->resolveArg('id');
        return $this->respondWithData($this->terminRepository->findById($terminId));
    }
}
