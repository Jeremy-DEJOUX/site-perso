<?php
    class Deck extends Cards {
    // class Deck{
        // STRING
        protected $value = '00112233445566778899';

        // ARRAY
        private $deck = [];
        private $shuffledDeck = [];
        private $objectDeck = [];

        // INT
        private $numberOfPairs;

        public function __construct(int $value) {
            $this->numberOfPairs = $value;
            // $this->difficulty = $this->numberOfPairs;
            $this->createDeck();
            $this->shuffleDeck();
            $this->buildObjectDeck();
        }

        public function getObjectDeck() {
            return $this->objectDeck;
        }

        /**
         * choisis la quantité de carte en rapport avec le niveau de difficulté
         * @return array les cartes qui seront utilisées, MAIS dans le bon ordre
         */
        public function createDeck() {
            $numberOfCards = $this->numberOfPairs * 2;

            for ($i = 0; $i <= $numberOfCards - 1; ++$i) {
                $nameOValue = 'card' . $this->value[$i];
                $this->deck[$i] = $nameOValue;
            }
            // return $this->deck;
        }

        public function shuffleDeck() {
            $this->shuffledDeck = $this->deck;
            shuffle($this->shuffledDeck);
        }



        public function buildObjectDeck() {
            foreach($this->shuffledDeck as $k => $v) {
                $this->objectDeck[$k] = new Cards($k, $v);
                $this->objectDeck[$k]->printCard();
            }
            return $this->objectDeck;
        }

    }