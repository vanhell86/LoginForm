<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;

class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $createdAt;
    /**
     * @var string
     */
    private $token;
    /**
     * @var DateTimeInterface
     */
    private $tokenExpire;

    public function __construct(
        int $id,
        string $name,
        string $email,
        string $password,
        ?string $token,
        DateTimeInterface $createdAt,
        ?DateTimeInterface $tokenExpire
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
        $this->token = $token;
        $this->tokenExpire = $tokenExpire;
    }

    public static function create(array $attributes): User
    {
        return new User(
            $attributes['id'],
            $attributes['name'],
            $attributes['email'],
            $attributes['password'],
            $attributes['token'],
            new Carbon($attributes['created_at']),
            new Carbon($attributes['tokenExpire'])
        );
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}
