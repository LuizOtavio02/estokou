<?php

namespace core\library;

use core\exceptions\CSRFException;

class Csrf
{
    public function __construct(private Session $session) {}

    public function get(): string
    {
        if (!$this->session->has('csrf')) {
            $this->session->set('csrf', bin2hex(random_bytes(32)));
        }

        return "<input type='hidden' name='csrf' value='{$this->session->get('csrf')}'>";
    }

    private function regexIgnoredRoutes(): bool
    {
        $excepts = configFile('csrf.ignore');
        if (!empty($excepts)) {
            foreach ($excepts as $except) {
                $pattern = str_replace('/', '\/', trim($except, '/'));
                if (preg_match("/^$pattern$/", trim(REQUEST_URI, '/'))) {
                    return true;
                }
            }
        }
        return false;
    }

    public function check(Request $request)
    {
        if (REQUEST_METHOD !== 'GET') {

            if (!$request->get('csrf') && $this->regexIgnoredRoutes()) {
                return;
            }

            if (!$request->get('csrf')) {
                view(view: 'error/419', viewPath: VIEW_PATH_CORE, status: 419)->send();
                die();
            }

            if (!hash_equals($request->get('csrf'), $this->session->get('csrf'))) {
                throw new CSRFException("CSRF token mismatch");
            }
        }
    }
}
