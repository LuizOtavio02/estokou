<?php

namespace core\library;

use core\library\Redirect;
use DI\Container;
use DI\ContainerBuilder;
use Dotenv\Dotenv;

class App
{
    public readonly Container $container;
    public readonly Session $session;

    public static function create()
    {
        return new self;
    }

    public function withSession()
    {
        $this->session = new Session;
        $this->session->previousUrl();
        
        return $this;
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
            Request::class => function () {
                return Request::create($this->session);
            },
            Redirect::class => function () {
                return new Redirect($this->session);
            }
        ]);
        $this->container = $builder->build();

        return $this;
    }
}
