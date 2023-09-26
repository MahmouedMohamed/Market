<?php

namespace Tests\ExpectedResponse;

class StoreResponse extends ExpectedResponse
{
    public function __construct(array $data, array $structure)
    {
        parent::__construct(201, $data, $structure, false, false);
    }
}
