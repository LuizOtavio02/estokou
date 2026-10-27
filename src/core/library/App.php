<?php

namespace core\library;

use core\auth\Auth;
use core\auth\AuthManager;
use core\library\Redirect;
use core\library\Session;
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
            },
            Auth::class => function () {
                return Auth::create($this->session);
            },
            AuthManager::class => function () {
                return AuthManager::create($this->session);
            },
            Session::class => function () {
                return $this->session;
            }

        ]);
        $this->container = $builder->build();

        return $this;
    }

    public function withServiceContainer()
    {
        bind(Redirect::class, function () {
            return new Redirect($this->session);
        });

        bind(Session::class, function () {
            return $this->session;
        });

        bind(AuthManager::class, function () {
            return AuthManager::create($this->session);
        });

        return $this;
    }
}
