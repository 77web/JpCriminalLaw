<?php


namespace Jp\CriminalLaw\Entity\刑;


use PHPMentors\DomainKata\Entity\EntityInterface;

interface 刑 extends EntityInterface
{
    public function getType();

    public function getVolume();

    public function is猶予可能();
}
