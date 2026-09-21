<?php

namespace core\library;


class Csrf
{
    public function __construct(private Session $session) {}

    public function get(): string
    {
        if (!$this->session->has('csrf')) {
            $this->session->set('csrf', bin2hex(random_bytes(32)));
        }

        return "<input type='hidden' name='_csrf' value='{$this->session->get('csrf')}'>";
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

    private function viewCsrfNotFound(Request $request, string $view, string $message)
    {
        if ($request->ajax()) {
            response(status:419)->json(['message' => $message])->send();
            return;    
        }
        view(view: 'error/419', viewPath: VIEW_PATH_CORE, status: 419)->send();
    }

    public function check(Request $request)
    {
        if (REQUEST_METHOD !== 'GET') {

            if (!$request->get('_csrf') && $this->regexIgnoredRoutes()) {
                return;
            }

            if (!$request->get('_csrf')) {
                $this->viewCsrfNotFound($request,'error/419','CSRF Not Found');
                die();
            }

            if (!hash_equals($request->get('_csrf'), $this->session->get('csrf'))) {
                $this->viewCsrfNotFound($request,'error/419','CSRF token mismatch');
                die();
            }
        }
    }
}
