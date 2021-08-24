<?php
namespace App\Service;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\HttpFoundation\Response;

class LoginEntryPoint implements AuthenticationEntryPointInterface
{
    public function start(\Symfony\Component\HttpFoundation\Request $request, ?\Symfony\Component\Security\Core\Exception\AuthenticationException $authException = NULL) {
        $response = new Response();
        $response->headers->set('Content-type','application/json');
        $response->setContent(json_encode([
            'status' => 'ACCESS_DENIED'
        ]));
        return $response;
    }
}