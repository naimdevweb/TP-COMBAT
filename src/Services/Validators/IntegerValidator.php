<?php

class IntegerValidator implements ValidationContract
{
    public function validate($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }
}