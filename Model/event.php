<?php 
namespace Model;
class Event {

    private $id;

    private $name;

    private $description;

    private $debut;

    private $fin;

    public function getId (): int {
        return $this->id;
    }

    public function getName (): string {
        return $this->name;
    }

    public function getDescription (): string {
        return $this->description ?? '';
    }

    public function getStart (): \DateTime {
        return new \DateTime($this->debut); 
    }

    public function getEnd (): \DateTime {
        return new \DateTime($this->fin); 
    }

}