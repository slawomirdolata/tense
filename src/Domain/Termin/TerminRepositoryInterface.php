<?php
declare(strict_types=1);

namespace App\Domain\Termin;

use App\Domain\Termin\Termin;

interface TerminRepositoryInterface
{
    /**
     * @return Termin[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findById(int $id): Termin;
}
