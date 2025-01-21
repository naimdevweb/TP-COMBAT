<?php

class RequiredValidator implements ValidationContract
{
    public function validate($value): bool
    {
        return isset($value) && !empty(trim($value));
    }
}