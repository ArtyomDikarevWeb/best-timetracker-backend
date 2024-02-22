<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class LoginData extends Data
{
    public ?string $email;
    public ?string $username;
    public string $password;
}
