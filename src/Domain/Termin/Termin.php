<?php
declare(strict_types=1);

namespace App\Domain\Termin;

use JsonSerializable;

class Termin implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var DateTime
     */
    private $startDate;

    /**
     * @var DateTime
     */
    private $endDate;

    /**
     * @var string
     */
    private $tytul;

    /**
     * @var string
     */
    private $opis;

    /**
     * @var string
     */
    private $imieNazwiskoKlienta;

    /**
     * @var string
     */
    private $emailKlienta;

    /**
     * @var int
     */
    private $status;

    // /**
    //  * @param int $id
    //  * @param \DateTime|string $startDate
    //  * @param \DateTime|string $endDate
    //  * @param string $tytul
    //  * @param string $opis
    //  * @param string $imieNazwiskoKlienta
    //  * @param string $emailKlienta
    //  * @param int $status
    //  */
    // public function __construct(
    //     int $id,
    //     $startDate,
    //     $endDate,
    //     ?string $tytul,
    //     ?string $opis,
    //     ?string $imieNazwiskoKlienta,
    //     string $emailKlienta,
    //     int $status
    // )
    // {
    //     $this->id = $id;
    //     $this->startDate = $this->stringToDateTime($startDate);
    //     $this->endDate = $this->stringToDateTime($endDate);
    //     $this->tytul = $tytul;
    //     $this->imieNazwiskoKlienta = $imieNazwiskoKlienta;
    //     $this->emailKlienta = $emailKlienta;
    //     $this->status = $status;
    // }

    private function stringToDateTime(string $inputDateTime) : \DateTime {
        if ($inputDateTime instanceof \DateTime) {
            return $inputDateTime;
        }

        try {
            return new \DateTime($inputDateTime);
        } catch (\Exception $e) {
            throw new DateTimeException();
        }
    }

    public function getId() : ?int {
            return $this->id;
    }

    public function getStartDate() : \DateTime {
            return $this->startDate;
    }

    public function getEndDate() : \DateTime {
            return $this->endDate;
    }

    public function getTytul() : string {
        return $this->tytul;
    }

    public function getOpis() : ?string {
        return $this->opis;
    }

    public function getImieNazwiskoKlienta() : string {
        return $this->imieNazwiskoKlienta;
    }

    public function getEmailKlienta() : string {
        return $this->emailKlienta;
    }

    public function getStatus() : int {
        return $this->status;
    }

    public function setId() : int {
        return $this->id;
    }

    /**
     * @param DateTime|string $startDate
     */
    public function setStartDate($startDate) : self {
        $this->startDate = $this->stringToDateTime($startDate);
        return $this;
    }

    /**
     * @param DateTime|string $endDate
     */
    public function setEndDate($endDate) : self {
        $this->endDate = $this->stringToDateTime($endDate);
        return $this;
    }

    public function setTytul(string $tytul) : self {
        $this->tytul = $tytul;
        return $this;
    }

    public function setOpis(string $opis) : self {
        $this->opis = $opis;
        return $this;
    }

    public function setImieNazwiskoKlienta(string $imieNazwiskoKlienta) : self {
        $this->imieNazwiskoKlienta = $imieNazwiskoKlienta;
        return $this;
    }

    public function setEmailKlienta(string $emailKlienta) : self {
        $this->emailKlienta = $emailKlienta;
        return $this;
    }

    public function setStatus(int $status) : self {
        $this->status = $status;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'startDate' => $this->getStartDate(),
            'endDate' => $this->getEndDate(),
            'tytul' => $this->getTytul(),
            'opis' => $this->getOpis(),
            'imieNazwiskoKlienta' => $this->getImieNazwiskoKlienta(),
            'emailKlienta' => $this->getEmailKlienta(),
            'status' => $this->getStatus(),
        ]; 
    }
}
