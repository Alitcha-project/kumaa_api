<?php
namespace Kumaa\Framework\Helper;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

trait RouterHelper
{
    public function redirect(string $url, array $params) : ResponseInterface
    {
        $trueUri = $this->router($url, $params);
        return new Response(301, [
            "location" => $trueUri,
        ]);
    }
}
