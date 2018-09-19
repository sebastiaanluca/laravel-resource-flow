<?php

declare(strict_types=1);

namespace SebastiaanLuca\Flow\Exceptions;

use RuntimeException;

class InteractionException extends RuntimeException
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
     * @return \SebastiaanLuca\Flow\Exceptions\InteractionException
     */
    public static function failed($response) : self
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
