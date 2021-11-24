<?php declare(strict_types=1);

namespace App\Api\TMDB\Exception;

use Symfony\Contracts\HttpClient\ResponseInterface;

final class ApiRequestException extends \LogicException
{
    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;

        parent::__construct('The TMDB Api request failed.');
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
