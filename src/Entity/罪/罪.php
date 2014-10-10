<?php


namespace Jp\CriminalLaw\Entity\罪;

use Jp\CriminalLaw\Entity\刑\刑;
use Jp\CriminalLaw\Entity\罪\Specification\構成要件;
use PHPMentors\DomainKata\Entity\EntityInterface;

interface 罪 extends EntityInterface
{
    /**
     * @return 構成要件
     */
    public function get構成要件();

    /**
     * @return 刑
     */
    public function get法定刑();

    /**
     * @return bool
     */
    public function has過失犯処罰規定();
}
