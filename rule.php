<?php


    class Rule
    {
        static $min = 1;
        static $max = 100;
        static $rules = [];

        static function build()
        {
            $ladder = [25, 55];
            $snake = array_filter(array_map(function ($value) {
                return (is_int($value / 9)) ? $value : null;
            }, range(self::$min, self::$max, 1)), function ($value) {
                return $value !== null;
            });
            $data = [
                10 => $ladder,
                -3 => $snake
            ];
            $result = [];
            foreach ($data as $offset => $positions) {
                foreach ($positions as $position) {
                    $result[$position] = (!empty($result[$position])) ? $result[$position] + $offset : $offset;
                }
            }
            function cal(Array $arr)
            {
                $result = [];
                foreach ($arr as $position => $offset) {
                    if (!empty($arr[$position])) {
                        $result[$position] = (!empty($result[$position])) ? $result[$position] + $offset : $position + $offset;
                    }
                }
                return $result;
            }

            self::$rules = cal($result);

            array_walk(self::$rules, function (&$val, $key) use (&$ladder, &$snake) {
                if (in_array($key, $ladder)) {
                    $val = [$val, 'ladder'];
                    return;
                }
                if (in_array($key, $snake)) {
                    $val = [$val, 'snake'];
                    return;
                }
                $val = [$val, null];
            });
        }

        static function position($position, $offset)
        {
            $coordinate = $position + $offset;
            if ($coordinate > self::$max) {
                return [$position, null];
            }
            if ($coordinate < self::$min) {
                return [self::$min, null];
            }
            if (isset(self::$rules[$coordinate])) {
                return self::$rules[$coordinate];
            }
            return [$coordinate, null];

        }

        static function isWinner($position): bool
        {
            return (self::$max === $position);
        }

        static function round()
        {
            return rand(1, 6);
        }
    }