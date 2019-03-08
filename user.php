<?php


    class User
    {
        public $name = '';

        public $position = 1;

        public $last;

        private $dice;

        public function __construct($name)
        {
//            if (empty($name)) {
//                throw new Error('not set name');
//            }
            $this->name = $name;
        }

        public function play()
        {
            $this->dice = Rule::round();
            $this->last = $this->position;
            list($position, $type) = Rule::position($this->position, $this->dice);
            $this->position = $position;
            $result = "name: {$this->name} position: {$this->last} dice: {$this->dice} ";
            if ($this->position !== $this->last) {
                $move =  $this->last + $this->dice;
                $result .= "move $move ";
            }
            if (!empty($type)) {
                $result .= "$type move {$this->position}";
            }
            $result .= "\n";
            echo $result;
            if (rule::isWinner($this->position)) {
                echo "is Winner {$this->name}\n";
                echo "----------------- GAME OVER -----------------";
                exit();
            }

        }
    }