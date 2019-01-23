<?php


namespace Dddtest\SharedKernel\Domain\Service;


interface IdentityProviderInterface
{
    public function provide(): string;
}