<?php


namespace Jp\CriminalLaw\Entity;


use PHPMentors\DomainKata\Entity\EntityInterface;

interface 人 extends EntityInterface
{
    /**
     * @return 行動
     */
    public function get行動();

    /**
     * @return 内心
     */
    public function get内心();
}
