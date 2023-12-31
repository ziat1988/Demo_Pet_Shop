<?php

/*
 * This file is part of the Monofony demo project.
 *
 * (c) Monofony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Tests\Controller;

use ApiTestCase\JsonApiTestCase as BaseJsonApiTestCase;

class JsonApiTestCase extends BaseJsonApiTestCase
{
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->expectedResponsesPath = __DIR__ . '/../Responses';
    }

    /**
     * @before
     */
    public function setUpClient(): void
    {
        $this->client = static::createClient([], ['HTTP_ACCEPT' => 'application/ld+json']);
    }
}
