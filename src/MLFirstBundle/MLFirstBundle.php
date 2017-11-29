<?php

namespace MLFirstBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MLFirstBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
