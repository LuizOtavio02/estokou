<?php

namespace core\library;

use core\exceptions\CSRFException;

class Csrf
{
    public function __construct(private Session $session) {}

    public function get()
    {
        $this->session->set('csrf', bin2hex(random_bytes(32)));

        return "<input type='hidden' name='csrf' value='{$this->session->get('csrf')}'>";
    }

    public function check(Request $request)
    {
        if (REQUEST_METHOD !== 'GET') {
            
            if (in_array(REQUEST_URI, configFile('csrf.ignore'))) {
                return;
            }

            if (!$request->get('csrf')) {
                view(view:'error/419', viewPath:VIEW_PATH_CORE, status:419)->send();
                die();    
            }

            if (!hash_equals($request->get('csrf'), $this->session->get('csrf'))) {
                throw new CSRFException("CSRF token mismatch");
            }
        }
    }
}
