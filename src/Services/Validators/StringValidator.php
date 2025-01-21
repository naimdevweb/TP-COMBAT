<?php



class StringValidator implements ValidationContract
{
    private $maxLength;

    public function __construct($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    public function validate($value): bool
    {
        return is_string($value) && strlen($value) <= $this->maxLength;
    }
}