<?php

namespace src\Integration;

/**
 * Class DataProviderConcrete
 * @package src\Integration
 */
class DataProviderConcrete implements DataProviderInterface
{
    /** @var string */
    protected $host;

    /** @var string */
    protected $user;

    /** @var string */
    protected $password;

    /**
     * DataProviderConcrete constructor.
     * @param string $host
     * @param string $user
     * @param string $password
     */
    public function __construct(string $host, string $user, string $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param array $parameterList
     * @return array
     */
    public function fetchDataByParameterList(array $parameterList): array
    {
        // some fetch logic
    }
}