<?php

namespace App\Enums;

use BadMethodCallException;

trait BaseEnum
{
    public static function getByValue($value)
    {
        foreach (self::cases() as $case) {
            if ($case->value == $value) {
                return $case;
            }
        }
    }

    public static function getByCode($code)
    {
        foreach (self::cases() as $case) {
            if ($case->code() == $code) {
                return $case;
            }
        }
    }

    public static function options()
    {
        return collect(self::cases())->mapWithKeys(fn ($case, $key) => [$case->value => $case->text()])->toArray();
    }

    public static function codes()
    {
        return collect(self::cases())->map(fn ($case, $key) => $case->code())->toArray();
    }

    public static function values()
    {
        return collect(self::cases())->map(fn ($case, $key) => $case->value)->toArray();
    }

    public function code()
    {
        return str()->slug($this->name);
    }

    public function text()
    {
        $code = str_replace('_', ' ', $this->code());

        return __('admin.'.str()->title($code));
    }

    public function __call(string $method_name, array $arguments)
    {

        if (method_exists($this, $method_name)) {
            call_user_func_array([$this, $method_name], $arguments);
        } elseif (strpos($method_name, 'is') === 0) {
            $code = strtolower(substr($method_name, 2));

            if (in_array($code, self::codes())) {
                return $this->code() == $code;
            }
        }

        throw new BadMethodCallException('Call to undefined method '.self::class."::{$method_name}()");
    }
}
