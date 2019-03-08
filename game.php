<?php


    class Game
    {
        /**
         * @var User[]
         */
        public $users = [];
        public $timeout = 1;

        function run($users = 2)
        {


            $this->users = [];
            for ($i = 1; $i <= $users; $i++) {
                array_push($this->users, $this->createUser($i));
            }
            while (true) {
                foreach ($this->users as $user) {
                    $user->play();
                    sleep($this->timeout);
                }
            }

        }

    }