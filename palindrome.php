<?php


class Palindrome
{
    public $length;

    private $revert;
    private $stack = [];
    private $string;

    function __construct($string)
    {
    	$string = mb_strtolower($string);
        $this->string = str_replace(' ', '', $string);
        $this->length = mb_strlen($this->string);
        $this->revert = $this->strrevert($this->string);
    }

    public function getPalindrome()
    {
        for ($i = 0; $i < $this->length; $i++) {

            for ($j = 0; $j < $this->length; $j++) {
                if (empty($this->stack[$i])) $this->stack[$i] = '';
                $sub = mb_substr($this->string, $i, $j + 1);
                $pos = strpos($this->revert, $sub);
                if ($pos !== false) {
                    $this->stack[$i] = mb_substr($this->string, $i, $j + 1);
                }
            }
        }

        return $this->maxlength($this->stack);
    }

    private function strrevert($str)
    {
        $new_str = '';
        $i = mb_strlen($str);
        while ($i >= 0) {
            $new_str .= mb_substr($str, $i, 1);
            $i--;
        }
        return $new_str;
    }

    private function maxlength($stack)
    {
        $maxkey = 0;
        $len = 0;
        foreach ($stack as $key => $value) {
            if (mb_strlen($value) > $len) {
                $len = mb_strlen($value);
                $maxkey = $key;
            }
        }
        return $stack[$maxkey];
    }
}


$str = "А роза упала на лапу Азора";

$pal = new Palindrome($str);

echo $pal->getPalindrome();


