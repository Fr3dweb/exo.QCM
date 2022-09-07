<?php
class Reponse
{

    const BONNE_REPONSE = true;
    const MAUVAISE_REPONSE = false;
    public string $reponse;
    public string $status;


    public function __construct(string $reponse, string $status = Reponse::MAUVAISE_REPONSE)
    {
        $this->reponse = $reponse;
        $this->status = $status;
    }

    public function getReponse(): string
    {
        return $this->reponse;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}