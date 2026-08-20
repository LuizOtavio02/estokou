<?php

namespace core\library;

use DI\Container;
use DI\ContainerBuilder;
use Dotenv\Dotenv;

class App
{
    public readonly Container $container;

    public static function create()
    {
        return new self;
    }

    public function withEnvironmentVariables()
    {
        try {
            $dotenv = Dotenv::createImmutable(BASE_PATH);
            $dotenv->load();

            return $this;
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    public function withDependencyInjectionContainer()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions([
            Request::class => Request::create()
        ]);
        $this->container = $builder->build();

        return $this;
    }
}
