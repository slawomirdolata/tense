<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Termin;

use PDO;
use App\Domain\Termin\TerminRepositoryInterface;
use App\Domain\Termin\Termin;
use App\Domain\Termin\TerminNotFoundException;

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

    private function getAllDataOfTermin(Termin $termin) : array
    {
        $returnArray = [
            'startDate' => $termin->getStartDate()->format('Y-m-d H:i'),
            'endDate' => $termin->getEndDate()->format('Y-m-d H:i'),
            'tytul' => $termin->getTytul(),
            'opis' => $termin->getOpis(),
            'imieNazwiskoKlienta' => $termin->getImieNazwiskoKlienta(),
            'emailKlienta' => $termin->getEmailKlienta(),
            'status' => $termin->getStatus()
        ];

        if ($termin->getId() !== null) {
            $returnArray['id'] = $termin->getId();
        }

        return $returnArray;
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
    public function findById(int $id): Termin
    {
        $sth = $this->db->prepare('SELECT * FROM termins WHERE id = :id');
        $sth->bindParam('id', $id, PDO::PARAM_INT);
        $sth->execute();
        $record = $sth->fetch(PDO::FETCH_ASSOC);

        if (!$record) {
            throw new TerminNotFoundException();
        }

        $termin = new Termin();
        $termin
            ->setId((int)$record['id'])
            ->setStartDate($record['startDate'])
            ->setEndDate($record['endDate'])
            ->setTytul($record['tytul'])
            ->setOpis($record['opis'])
            ->setImieNazwiskoKlienta($record['imieNazwiskoKlienta'])
            ->setEmailKlienta($record['emailKlienta'])
            ->setStatus((int)$record['status']);
        return $termin;
    }

    public function updateTermin(Termin $termin) : self
    {
        $sth = $this->db->prepare('UPDATE termins SET
            startDate = :startDate,
            endDate = :endDate,
            tytul = :tytul,
            opis = :opis,
            imieNazwiskoKlienta = :imieNazwiskoKlienta,
            emailKlienta = :emailKlienta,
            status = :status
            WHERE id = :id');

        $sth->execute($this->getAllDataOfTermin($termin));
        return $this;
    }

    public function addTermin(Termin $termin) : self
    {
        $sth = $this->db->prepare('INSERT INTO termins
            (startDate, endDate, tytul, opis, imieNazwiskoKlienta, emailKlienta, status)
            VALUES
            (:startDate, :endDate, :tytul, :opis, :imieNazwiskoKlienta, :emailKlienta, :status)');

        $sth->execute($this->getAllDataOfTermin($termin));
        return $this;
    }
}
