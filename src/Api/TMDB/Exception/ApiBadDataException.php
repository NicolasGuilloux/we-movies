<?php declare(strict_types=1);

namespace App\Api\TMDB\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class ApiBadDataException extends \LogicException
{
    private ResponseInterface $response;
    private ConstraintViolationListInterface $violations;

    public function __construct(ResponseInterface $response, ConstraintViolationListInterface $violations)
    {
        $this->response = $response;
        $this->violations = $violations;

        parent::__construct('The data returned by the TMDB API are invalid.');
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
