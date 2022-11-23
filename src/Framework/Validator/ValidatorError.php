<?php

namespace Kumaa\Framework\Validator;

class ValidatorError
{
    private $key;
    private $rule;

    private $message = [
        'require' => "Le champ %s est requis",
        'title' => "Le champ %s n'est pas un titre valide",
        'notEmpty' => "Le champ %s est vide",
        'length' => "Le champ %s n'a pas une taille comprise entre %d et %d"
    ];

    private $params = [];

    public function __construct(string $key, string $rule, array $params = [])
    {
        $this->key = $key;
        $this->rule = $rule;
        $this->params = $params;
    }

    public function __toString()
    {
        $all_params = array_merge([$this->message[$this->rule]], $this->params);
        return (string)call_user_func_array('sprintf', $all_params);
    }
}
