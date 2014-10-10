<?php
namespace Jp\CriminalLaw;

use Jp\CriminalLaw\Entity\内心;
use Jp\CriminalLaw\Exception\無罪;
use Jp\CriminalLaw\Entity\刑\刑;
use Jp\CriminalLaw\Entity\罪\罪;
use Jp\CriminalLaw\Entity\人;
use Jp\CriminalLaw\Entity\行動;

class ProcessOfLaw
{
    public function run(人 $person, 罪 $crime)
    {
        if (!$this->is構成要件該当($person->get行動(), $crime)) {
            throw new 無罪();
        }

        if (!$this->has違法性($person)) {
            throw new 無罪();
        }

        if (!$this->has故意($person->get内心()) && !$crime->has過失犯処罰規定()) {
            throw new 無罪();
        }

        return $this->compute宣告刑();
    }

    /**
     * @param 行動 $action
     * @param 罪 $crime
     * @return bool
     */
    private function is構成要件該当(行動 $action, 罪 $crime)
    {
        return $crime->get構成要件()->isSatisfiedBy($action);
    }

    /**
     * @param 人 $person
     * @return bool
     */
    private function has違法性(人 $person)
    {
        // TODO
        return true;
    }

    /**
     * @param 内心 $emotion
     * @return bool
     */
    private function has故意(内心 $emotion)
    {
        // TODO
        return true;
    }

    /**
     * @return 刑
     */
    private function compute宣告刑()
    {
        // 加重減軽
        // TODO
        return null;
    }
}
