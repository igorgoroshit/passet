<?php 

namespace Passet\Contracts;

interface ComposerInterface
{
    public function process($paths, $absolutePaths, $attributes);
}