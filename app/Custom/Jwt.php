<?php

namespace App\Custom;

use App\Models\User;
use Firebase\JWT\JWT as JWTFirebase;
use Firebase\JWT\Key;

class Jwt
{
    public static function validate()
    {
        $authorization = $_SERVER['HTTP_AUTHORIZATION'];
        $key = $_ENV['JWT_KEY'];
        try {
            $token = str_replace('Bearer ', '', $authorization);
            $decode = JWTFirebase::decode($token, new Key($key, 'HS256'));
            return response()->json($decode, 200);
        } catch(\Throwable $th) {
            return response()->json($th->getMessage(), 401);
        }
    }

    public static function create(User $data)
    {
        //Pegando a chave para formar o token
        $key = $_ENV['JWT_KEY'];

        $payload = [
            'exp' => time() + 1800,
            'iat' => time(),
            'data' => $data
        ];

        // Retorna uma encryptação do JWTFirebase (apelidada) que recebe o payload, a chave e o tipo de hash de criptografia como argumento.
        return JWTFirebase::encode($payload, $key, 'HS256');
    }
}
