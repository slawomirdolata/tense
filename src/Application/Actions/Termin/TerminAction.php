<?php
declare(strict_types=1);

namespace App\Application\Actions\Termin;

use App\Application\Actions\Action;
//use App\Domain\Termin\TerminRepositoryInterface;
use App\Infrastructure\Persistence\Termin\TerminRepository;
use Psr\Log\LoggerInterface;

abstract class TerminAction extends Action
{
    /**
     * @var TerminRepository
     */
    protected $terminRepository;

    /**
     * @param LoggerInterface $logger
     * @param TerminRepository $terminRepository
     */
    public function __construct(LoggerInterface $logger, TerminRepository $terminRepository)
    {
        parent::__construct($logger);
        $this->terminRepository = $terminRepository;
    }
}
