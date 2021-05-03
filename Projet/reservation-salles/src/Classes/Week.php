<?php
    class Week {
        public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        public $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        public $currentIsMonday;
        public $currentDayString;
        public $monthString;
        public $currentDay;
        public $currentDate;
        public $mondaysDate;
        public $day;
        public $month;
        public $year;

        /**
         * initialise tous les attributs
         * @param int $day
         * @param int $month, le mois compris entre 1 et 12
         * @param int $year, L'année
         */
        public function __construct(?int $day = null, ?int $month = null, ?int $year = null) {
            if ($day === null || $day < 1 || $day > 31) {
                $day = intval(date('j'));
            }
            if ($month === null || $month < 1 || $month > 12) {
                $month = intval(date('m'));
            }
            if ($year === null) {
                $year = intval(date('Y'));
            }
            $dateString = $year  . '-' . $month . '-' . $day;
            $makeDate = new DateTimeImmutable($dateString);
            $this->currentDay = intval($makeDate->format('N'));

            // Savoir si c'est lundi
            if ($this->currentDay === 01) {
                $this->mondaysDate = $day;
                $this->currentIsMonday = TRUE;
            }
            else {
                $getMondayDate = $makeDate->modify('last monday');
                $this->mondaysDate = intval($getMondayDate->format('j'));
                $this->currentIsMonday = FALSE;
            }
            // on met à jour les attributs
            $this->currentDate = $dateString;
            $this->day = $day;
            $this->month = $month;
            $this->year= $year;
            $this->currentDayString = $this->days[$this->currentDay - 1];
            $this->monthString = $this->months[$this->month - 1];
        }

        /**
         * Nmae of the Months in letter
         * @return string
         */
        public function ToString(): string {
            return $this->months[$this->month - 1] . ' ' . $this->year;
        }

        /**
         * Name of the Days in letter
         * @param int $index
         * @return string
         */
        public function getDays(int $index): string {
            return $this->days[$index];
        }

        /**
         * retourne à la semaine suivante
         * @return Week
         */
        public function nextWeek(): Week {
            $tempDate = new DateTimeImmutable($this->currentDate);
            $dayName = $tempDate->format('l');
            $tempDate2 = $tempDate->modify('next monday');

            $day = $tempDate2->format('j');
            $month = $tempDate2->format('n');
            $year = $tempDate2->format('Y');

            return new Week($day, $month, $year);
        }

        /**
         * retourne à la semaine précédente
         * @return Week
         */
        public function previousWeek(): Week {
            $tempDate = new DateTimeImmutable($this->currentDate);
            $dayName = $tempDate->format('l');
            $tempDate2 = $tempDate->modify('previous monday');

            $day = $tempDate2->format('j');
            $month = $tempDate2->format('n');
            $year = $tempDate2->format('Y');

            return new Week($day, $month, $year);
        }

        /**
         * Recherche d'événements
         * @return DateTime
         */
        public function getFirstDay(): DateTime {
            return new DateTime("{$this->year}-{$this->month}-{$this->mondaysDate}");
        }
    }
