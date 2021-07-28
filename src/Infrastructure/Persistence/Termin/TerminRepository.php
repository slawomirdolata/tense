<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Termin;

use PDO;
use App\Domain\Termin\TerminRepositoryInterface;

class TerminRepository implements TerminRepositoryInterface
{

    /**
     * @var PDO The database connection
     */
    private $db;

    /**
     * Constructor.
     * @param PDO $db The database connection
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $sth = $this->db->prepare('SELECT * FROM termins');
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function findById(int $id): User
    // {
    //     if (!isset($this->users[$id])) {
    //         throw new UserNotFoundException();
    //     }

    //     return $this->users[$id];
    // }
}
