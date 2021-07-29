<?php
declare(strict_types=1);

namespace App\Domain\Termin;

use App\Domain\DomainException\DomainRecordNotFoundException;

class TerminNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'Taki termin nie istnieje';
}
