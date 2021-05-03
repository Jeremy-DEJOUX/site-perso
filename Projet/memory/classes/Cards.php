<?php
    class Cards {
        // INT 
        protected $id;
        // STRING
        protected $value;

        // BOOL
        protected $flipped = FALSE;
        protected $disabled = FALSE;

        /**
         * 
         * @param int $id
         * @param string $value
         */
        public function __construct(?int $id = null, ?string $value = null) {
            $this->id = $id;
            $this->value = $value;
        }
        public function setIdNValue(?int $id, ?string $value) {
            $this->id = $id;
            $this->value = $value;
        }

        public function flipCard() {
            $this->flipped = TRUE;
        }
        public function getValue() {
            return $this->value;
        }

        /**
         * construit en html la carte de jeu en vérifiant son état par ses propriétés.
         * -> Ne peut plus être cliqué une fois retournée
         * -> est animée au chargement de la page
         */
        public function printCard() {
            echo '<form action="" method="POST">';
            echo '<input type="hidden" name="cardId" value="' . $this->id . 'id="mystere">';
            // echo '<button type="submit" class="card" ';
            if ($this->flipped) {
                echo '<button type="submit" class="card" id="mystere" disabled>';
            }
            else {
                echo '<button type="submit" class="card" id="mystere">';
            }
            echo '</button>';
            echo '</form>', "\n";
        }
    }