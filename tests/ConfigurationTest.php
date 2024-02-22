<?php

use PHPUnit\Framework\TestCase;
use Services\Configuration;

class ConfigurationTest extends TestCase
{
    private Configuration $config;

    protected function setUp(): void
    {
        $this->config = new Configuration([
            'task' => [
                'language' => 'PHP',
                'reason' => 'interview',
            ],
            'company' => [
                'name' => 'ECD',
                'product' => 'The Big Phone Store',
            ],
            'submitter' => 'Ivan',
        ]);
    }

    public function testGetExistingKey(): void
    {
        $this->assertEquals('PHP', $this->config->get('task.language'));
        $this->assertEquals('Ivan', $this->config->get('submitter'));
    }

    public function testGetNonExistingKey(): void
    {
        $this->assertNull($this->config->get('non.existing.key'));
    }

    public function testGetNonExistingKeyWithDefaultValue(): void
    {
        $this->assertEquals('default', $this->config->get('non.existing.key', 'default'));
    }
}
