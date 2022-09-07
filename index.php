<?php

include("./question.php");
include("./reponse.php");


class QCM
{
    private array $questions = [];
    private array $appreciations = [];

    function ajouterQuestion(Question $question)
    {
        array_push($this->questions, $question);
    }

    function getQuestions()
    {
        return $this->questions;
    }

    public function setAppreciation(array $appreciation): Qcm
    {
        foreach ($appreciation as $key => $appr) {
            if (is_numeric($key))
                $this->appreciations[(int)$appr] = $appr;
            else {
                list($min, $max) = explode('-', $key);
                if ($min > $max)
                    list($min, $max) = array($max, $min);
                for ($i = (int)$min; $i <= $max; $i++)
                    $this->appreciations[$i] = $appr;
            }
        }
        return $this;
    }

    function getAppreciation()
    {
        return $this->appreciations;
    }

    public function generer()
    {
        $bonneR = 0;
        if (isset ($_POST) && !empty($_POST)) {
            foreach ($this->questions as $i => $question) {
                echo '<p>La question ' . $i . ' : ' . $question->getTextQuestion() . '</p>';
                if ($_POST[$i] == $question->getNumBonneReponse()) {
                    echo '<p>Bonne reponse</p>';
                    $bonneR++;
                } else {
                    echo '<p>Mauvaise reponse</p>';
                    echo '<p>La bonne reponse : ' . $question->getBonneReponse()->getReponse() . '</p>';
                }
                echo '<p>' . $question->getExplication() . '</p>';
                echo '<hr>';
            }
            $score = $bonneR / count($this->questions) * 20;
            echo $score . ' / 20';
            echo '<p>'.$this->appreciations[$score].'</p>';
        } else {
            echo "<form method='post'>";
            foreach ($this->questions as $i => $questions) {
                echo $questions->getTextQuestion();
                foreach ($questions->getReponses() as $j => $reponse) {
                    echo "<input id='" . $j . "' type='radio' name= '" . $i . "' value= '" . $j . "'><label for='" . $j . "'>" . $reponse->getReponse() . "</label>";
                    echo "</br>";
                }


            }
            echo '<input type="submit" value="Envoyer"></form>';
        }
    }
}


$qcm = new Qcm();

$question1 = new Question('Et paf, ça fait ...');
$question1->ajouterReponse(new Reponse('Des mielpops'));
$question1->ajouterReponse(new Reponse('Des chocapics', Reponse::BONNE_REPONSE));
$question1->ajouterReponse(new Reponse('Des actimels'));
$question1->setExplications('Et oui, la célèbre citation est « Et paf, ça fait des chocapics ! »');
$qcm->ajouterQuestion($question1);

$question2 = new Question('POO signifie');
$question2->ajouterReponse(new Reponse('Php Orienté Objet'));
$question2->ajouterReponse(new Reponse('ProgrammatiOn Orientée'));
$question2->ajouterReponse(new Reponse('Programmation Orientée Objet', Reponse::BONNE_REPONSE));
$question2->setExplications('Sans commentaires si vous avez eu faux :-°');
$qcm->ajouterQuestion($question2);

$qcm->setAppreciation(array('0-10' => 'Pas top du tout ...',
    '10-20' => 'Très bien ...'));
$qcm->generer();
