<?php
/**
 * Application
 *
 * Copyright (c) 2021 Comparison Technologies Ltd.
 *
 * @author David Yell <david.yell@comparisontech.com>
 */
declare(strict_types=1);

namespace App;

use App\Controllers\MonstersController;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Application
{
    public function dispatch(RequestInterface $request): ResponseInterface
    {
        $controller = new MonstersController();

        if (\stristr($request->getUri()->getPath(), 'monsters/view') !== false) {
            \preg_match('@\/monsters\/view\/([\d]+)@', $request->getUri()->getPath(), $matches);
            return $controller->view((int)$matches[1]);
        }

        return $controller->list();
    }
}
