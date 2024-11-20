<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait Encryptable
{
    public function setAttribute($keyName, $value)
    {
        if (in_array($keyName, $this->encryptable)) {
            return $this->attributes[$keyName] = Crypt::encryptString($value);
        }

        return $this->attributes[$keyName] = $value;
    }

    public function getAttribute($keyName)
    {
        if (in_array($keyName, $this->encryptable)) {
            try {
                return Crypt::decryptString($this->attributes[$keyName]);
            } catch (\Throwable $th) {
                // pass
            }
        }

        return $this->attributes[$keyName];
    }
}
