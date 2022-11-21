<?php

namespace Kumaa\Framework\Validator;

class ValidatorError
{
    private $key;
    private $rule;

    private $message = [
        'require' => "Le champ %s est requis",
        'title' => "Le champ %s n'est pas un titre valide",
        'notEmpty' => "Le champ %s est vide"
    ];

    public function __construct(string $key, string $rule)
    {
        $this->key = $key;
        $this->rule = $rule;
    }

    public function __toString()
    {
        return sprintf($this->message[$this->rule], $this->key);
    }
}
