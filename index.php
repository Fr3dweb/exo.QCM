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

class question
{
    private string $question;
    private array $reponses = [];
    private string $explication;




    public function __construct(string $question)
    {
        $this->question = $question;
    }
    public function ajouterReponse(string $reponse): void
    {
        $this->reponses = $reponse;
    }
    public function getReponses()
    {
        return $this->reponses;
    }

    public function getExplication(): string
    {
        return $this->explication;
    }
    public function setExplication(string $explication): void
    {
        $this->explication = $explication;
    }
    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getReponse(int $num)
    {
        foreach ($this->reponses as $i => $reponse) {
            if ($i == $num) {
                return $reponse;
            }
        }

        // return $this->reponses[$num];
    }

    public function getNumBonneReponse(): int{
        // parcourir le tableau des réponses
        foreach ($this->reponses as $i => $reponse) {
            // si la réponse est une bonne réponse alors
            if($reponse -> getStatus() == true){
                // je retourne l'index
                return $i;
            }
        }
    }

    public function getBonneReponse(): object{
        foreach ($this->reponses as $i => $reponse){
            // si le numéro de la bonne réponse est egale à l'index donc
            if($reponse->getNumBonneReponse() == $i){
                // réponse est la bonne réponse
                return $reponse;
            }
        }
    }
}

class QCM
{
    private array $questions;
    private array $appreciations;

    function ajouterQuestion(object $question)
    {
        array_push($this->questions, $question);
    }

    function getQuestions()
    {
        return $this->questions;
    }

    function ajouterAppreciations(object $appreciations)
    {
        array_push($this->appreciations, $appreciations);
    }

    function getAppreciations(object $appreciations)
    {
        return $this->appreciations;
    }

    public function generer()
    {
        if(isset ($_POST) && !empty($_POST)){


        } else {
            echo "<form>";
            foreach (this->questions as $i => $question) {
                echo $questions->getQuestions();

                foreach ($this->reponses->getReponses as $j => $reponse) {
                    echo $reponses->getReponses();
                }
            }
        }
    }
}


