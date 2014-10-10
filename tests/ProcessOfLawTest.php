<?php


namespace Jp\CriminalLaw;


use Jp\CriminalLaw\Entity\人;
use Jp\CriminalLaw\Entity\罪\罪;

class ProcessOfLawTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider provide有罪Data
     * @param 人|\PHPUnit_Framework_MockObject_MockObject $person
     * @param 罪|\PHPUnit_Framework_MockObject_MockObject $crime
     */
    public function 有罪(人 $person, 罪 $crime)
    {
        $person
            ->expects($this->once())
            ->method('get内心')
            ->will($this->returnValue($this->getMockForAbstractClass('\Jp\CriminalLaw\Entity\内心')))
        ;

        $process = new ProcessOfLaw();
        $sentence = $process->run($person, $crime);

        //$this->assertInstanceOf('\Jp\CriminalLaw\刑', $sentence);
        $this->assertNull($sentence);
    }

    /**
     * @test
     * @dataProvider provide無罪Data
     * @expectedException \Jp\CriminalLaw\Exception\無罪
     * @param 人|\PHPUnit_Framework_MockObject_MockObject $person
     * @param 罪|\PHPUnit_Framework_MockObject_MockObject $crime
     */
    public function 無罪(人 $person, 罪 $crime)
    {
        $process = new ProcessOfLaw();
        $process->run($person, $crime);
    }

    /**
     * @return array
     */
    public function provide有罪Data()
    {
        return [
            [$this->make人Mock(), $this->make罪Mock(true)]
        ];
    }

    /**
     * @return array
     */
    public function provide無罪Data()
    {
        return [
            [$this->make人Mock(), $this->make罪Mock(false)],
        ];
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function make人Mock()
    {
        $person = $this->getMockForAbstractClass('\Jp\CriminalLaw\Entity\人');
        $action = $this->getMockForAbstractClass('\Jp\CriminalLaw\Entity\行動');
        $person
            ->expects($this->once())
            ->method('get行動')
            ->will($this->returnValue($action))
        ;

        return $person;
    }

    /**
     * @param bool $tatbestandSatisfied
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function make罪Mock($tatbestandSatisfied)
    {
        $crime = $this->getMockForAbstractClass('\Jp\CriminalLaw\Entity\罪\罪');
        $tatbestand = $this->getMockForAbstractClass('\Jp\CriminalLaw\Entity\罪\Specification\構成要件');
        $crime
            ->expects($this->once())
            ->method('get構成要件')
            ->will($this->returnValue($tatbestand))
        ;
        $tatbestand
            ->expects($this->once())
            ->method('isSatisfiedBy')
            ->with($this->isInstanceOf('\Jp\CriminalLaw\Entity\行動'))
            ->will($this->returnValue($tatbestandSatisfied))
        ;

        return $crime;
    }
}
