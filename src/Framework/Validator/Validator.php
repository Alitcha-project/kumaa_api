<?php

namespace Kumaa\Framework\Validator;

use DateTime;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class Validator
{
    private $params;
    private $errors = [];

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function require(string ...$keys)
    {
        foreach ($keys as $key) {
            if (is_null($this->getValue($key))) {
                $this->addError($key, "require");
            }
        }

        return $this;
    }

    public function title(string $key): self
    {
        $value = $this->getValue($key);
        $pattern = '/\./';

        if (!is_null($value) && preg_match($pattern, $this->params[$key])) {
            $this->addError($key, 'title');
        }
        return $this;
    }

    public function notEmpty(string ...$keys): self
    {
        foreach ($keys as $key) {
            $value = $this->getValue($key);

            if (!is_null($value) && empty($value)) {
                $this->addError($key, 'notEmpty');
            }
        }

        return $this;
    }

    public function dateTime(string $key, string $format = 'Y-m-d h:i:s'): self
    {
        $value = $this->getValue($key);
        $dT = DateTime::createFromFormat($format, $value);
        $errors = DateTime::getLastErrors();
        if ($errors['error_count'] != 0 && $errors['warning_count'] != 0) {
            $this->addError($key, 'DateTime');
        }
        return $this;
    }

    public function length(string $key, int $min = null, int $max = null): self
    {
        $value = $this->getValue($key);

        if (!is_null($value)) {
            $value_length = mb_strlen($value);
            if ((!is_null($min) && $value_length <= $min)
                ||
                (!is_null($max) && $value_length >= $max)
                ) {
                $this->addError($key, 'length');
            }
        }

        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function addError(string $key, string $rule)
    {
        $this->errors[$key] = new ValidatorError($key, $rule);
    }

    private function getValue($key)
    {
        if (key_exists($key, $this->params)) {
            return $this->params[$key];
        }
        return null;
    }
}
