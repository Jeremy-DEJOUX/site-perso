<?php

class Memory extends Deck {
    public $objectDeck = [];

    // INT
    public $difficulty;
    public $totalPairs;

    public $previousTurn;
    public $actualTurn;

    private $score;
    //BOOL
    private $sameCards;

    /**
     * Récupère un array de cartes
     * @param array $deck
     */
    public function __construct(array $deck) {
        $this->objectDeck = $deck;
    }

    /**
     * Comme son nom l'indique, set aussi le nombre de pair
     * @param int $int
     */
    public function setDifficulty($int) {
        $this->difficulty = $this->totalPairs = $int;
    }

    /**
     * construit en html la carte de jeu en vérifiant son état par ses propriétés.
     * -> Ne peut plus être cliqué une fois retournée
     * -> est animée au chargement de la page
     */
    public function printCard() {
        foreach($this->objectDeck as $k => $v) {
            echo '<form action="" method="POST">';
            echo '<input type="hidden" name="cardId" value="' . $this->objectDeck[$k]->id . '">';
            // echo '<button type="submit" class="card" ';
            if ($this->objectDeck[$k]->flipped) {
                echo '<button type="submit" class="card" id="'. $this->objectDeck[$k]->getValue() .'" disabled>';
            }
            else {
                echo '<button type="submit" class="card" id="mystere">';
            }
            echo '</button>';
            echo '</form>', "\n";
        }
    }

    /**
     * charge le tour actuel en tour précédent lorsque qu'une nouvelle carte est choisie
     * @param int $id, récupéré par $_GET['id'] pour le moment
     */
    public function setActualTurn($cardId) {
        $id = intval($cardId);
        $this->objectDeck[$id]->flipCard();
        $this->actualTurn = $id;
    }


    /**
     * charge le tour actuel en tour précédent lorsque qu'une nouvelle carte est choisie
     * @param int $id, récupéré par $_GET['id'] pour le moment
     */
    public function setPreviousTurn($cardId) {
        $id = intval($cardId);
        $this->objectDeck[$id]->flipCard();
        $this->previousTurn = $id;
    }


    /**
     * méthode pour déterminer s'il y a une valeur dans la propriété previousTurn
     * @return bool
     */
    public function previousTurnExists(): bool {
        if (isset($this->previousTurn))
            return TRUE;
        else
            return FALSE;
    }


    /**
     * méthode pour déterminer s'il y a une valeur dans la propriété actualTurn
     * @return bool
     */
    public function actualTurnExists(): bool {
        if (isset($this->actualTurn))
            return TRUE;
        else
            return FALSE;
    }

    /**
     * comparaison entre deux cartes/propriétés, met à jour le score, et la propriété flipped des cartes en question
     */
    public function comparison() {
        if ($this->objectDeck[$this->actualTurn]->value === $this->objectDeck[$this->previousTurn]->value) {
            $this->score += 15;
            $this->totalPairs -= 1;
            $this->sameCards = TRUE;
            $this->objectDeck[$this->actualTurn]->disabled = TRUE;
            $this->objectDeck[$this->previousTurn]->disabled = TRUE;
        }
        else {
            $this->score -= 5;
            $this->objectDeck[$this->actualTurn]->flipped = FALSE;
            $this->objectDeck[$this->previousTurn]->flipped = FALSE;
            $this->sameCards = FALSE;
        }
        $_SESSION['scores'] = $this->score;
        $this->unsetTurns();
    }

    /**
     * efface les valeurs pour les deux propriétés: previousTurn & actualTurn
     *
     */
    private function unsetTurns() {
        unset($this->actualTurn);
        unset($this->previousTurn);
    }


    /**
     * ON GARDE
     * renvoie le score pour avoir un suivi-visuel du score du joueur
     * @return string
     */
    public function printScore() {
        if (!isset($this->score))
            return '<p class="flex j_center a_center" id="Scores">SCORE: 0</p>' . "\n";
        else
            return '<p class="flex j_center a_center" id="Scores">' . 'SCORE: ' . $this->score . '</p>' . "\n";
    }
    public function printPairs() {
        return '<p>PAIRS LEFT: ' . $this->totalPairs . '</p>' . "\n";
    }

    /**
     * ON GARDE / AMELIORE
     * arrête la partie lorsque le joueur a découvert toutes les paires, totalPairs === 0
     * @return bool
     */
    public function stopGame() {
        if ($this->totalPairs === 0)
            return TRUE;
        else
            return FALSE;
    }

    public function getTotalPairs() {
        return $this->totalPairs;
    }
    // public function flippingCard($id) {
        // $this->finalDeck[$id]->flipCard($id);
    // }

    // DEBUG
    public function getPreviousTurn() {
        return '<p>PREVIOUS: ' . $this->previousTurn . '</p>' . "\n";
    }

    // DEBUG
    public function getActualTurn() {
        return '<p>ACTUAL: ' . $this->actualTurn . '</p>' . "\n";
    }
}