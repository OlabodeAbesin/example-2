<?php

namespace App\Domain\Factory;

use Symfony\Component\Uid\Uuid;

class UUIDFactory
{

    public function generate():string{
        return Uuid::v4()->toRfc4122();
    }

}
