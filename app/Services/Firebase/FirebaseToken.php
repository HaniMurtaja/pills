<?php

namespace App\Services\Firebase;

use UnexpectedValueException;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FirebaseToken
{
  
    const ALLOWED_ALGOS = ['RS256'];

   
    const PUBLIC_KEY_URL = 'https://www.googleapis.com/robot/v1/metadata/x509/securetoken@system.gserviceaccount.com';

   
    const CACHE_KEY = 'FIREBASE_JWT_PUBLIC_KEYS';

   
    private string $token;

   
    public function __construct(string $token)
    {
        $this->token = $token;
    }


    public function verify(string $projectId): object
    {
        $keys = $this->getPublicKeys();

        $payload = JWT::decode($this->token, $keys, self::ALLOWED_ALGOS);

        $this->validatePayload($payload, $projectId);

        return $payload;
    }

    
    private function getPublicKeys(): array
    {
        if (Cache::has(self::CACHE_KEY)) {
            return Cache::get(self::CACHE_KEY);
        }

        $response = Http::get(self::PUBLIC_KEY_URL);

        if (!$response->successful()) {
            throw new \Exception('Failed to fetch JWT public keys.');
        }

        $publicKeys = $response->json();
        $cacheControl = $response->header('Cache-Control');
        $maxAge = Str::of($cacheControl)->match('/max-age=(\d+)/');

        Cache::put(self::CACHE_KEY, $publicKeys, now()->addSeconds($maxAge));

        return $publicKeys;
    }


    private function validatePayload(object $payload, string $projectId): void
    {
        if ($payload->aud !== $projectId) {
            throw new UnexpectedValueException("Invalid audience: {$payload->aud}");
        }

        if ($payload->iss !== "https://securetoken.google.com/{$projectId}") {
            throw new UnexpectedValueException("Invalid issuer: {$payload->iss}");
        }

        // `sub` corresponds to the `uid` of the Firebase user.
        if (empty($payload->sub)) {
            throw new UnexpectedValueException('Payload subject is empty.');
        }
    }
}
