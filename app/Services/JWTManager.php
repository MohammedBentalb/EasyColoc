<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class JWTManager {

    private string $secret;
    public function __construct() {
        $this->secret = env('JWT_SECRET');
    }
    public function generate(array $payload, int $exp = 3600): string{
        $now = Carbon::now()->timestamp;

        $payload = array_merge($payload, [
            'exp' => $now + $exp,
            'iat' => $now,
            'iss' => env('app_url', 'http://localhost')
       ]);
       return JWT::encode($payload, $this->secret, 'HS256');
    }

    public function decode(string $token): object {
        return JWT::decode($token, new Key($this->secret, 'HS256'));
    }
}