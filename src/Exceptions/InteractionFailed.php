<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Exceptions;

use RuntimeException;

class InteractionFailed extends RuntimeException
{
    /**
     * @var mixed
     */
    private $response;

    /**
     * @param string $message
     * @param mixed $response
     */
    public function __construct(string $message, $response)
    {
        parent::__construct($message);

        $this->response = $response;
    }

    /**
     * @param mixed $response
     *
     * @return \SebastiaanLuca\Flow\Exceptions\InteractionFailed
     */
    public static function withResponse($response) : self
    {
        return new static(
            'The interaction failed.',
            $response
        );
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}
