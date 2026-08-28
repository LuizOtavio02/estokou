<?php

namespace core\rules;

use core\interfaces\RuleInterface;
use core\library\Request;
use core\library\Response;
use Override;

class Max implements RuleInterface
{
    #[Override]
    public function validate(string $field, Request $request, string $params = ''): ?Response
    {
        if (strlen($request->get($field)) > $params) {
            return new Response("The field {$field} must be less than or equal to {$params} characters");
        }

        return null;
    }
}
