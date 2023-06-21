<?php

namespace Tests;

use App\DesignManager;
use App\Exceptions\InvalidPercentException;
use App\models\Design;
use PHPUnit\Framework\TestCase;

class DesignManagerTest extends TestCase
{

    private array $testData = [
        [
            'designId' => 1,
            'designName' => 'Test A Test',
            'splitPercent' => 15,
        ],
        [
            'designId' => 2,
            'designName' => 'Test B Test',
            'splitPercent' => 20,
        ],
        [
            'designId' => 3,
            'designName' => 'Test C Test',
            'splitPercent' => 80,
        ],
        [
            'designId' => 4,
            'designName' => 'Test B Test',
            'splitPercent' => 65,
        ],
    ];
    private const ITERATIONS = 1000;

    public function testPickDesign()
    {
        $designManager = new DesignManager();
        $designManager->registerDesign(new Design($this->testData[0]['designId'], $this->testData[0]['designName'], $this->testData[0]['splitPercent']));
        $designManager->registerDesign(new Design($this->testData[1]['designId'], $this->testData[1]['designName'], $this->testData[1]['splitPercent']));
        $designManager->registerDesign(new Design($this->testData[3]['designId'], $this->testData[3]['designName'], $this->testData[3]['splitPercent']));
        $selected = $designManager->pickDesign();
        $this->assertObjectHasAttribute('designId', $selected);

        $d1 = 0;
        $d2 = 0;
        $d4 = 0;
        for($i=0;$i<self::ITERATIONS;$i++){
            $selected = $designManager->pickDesign();
            $var = 'd'.$selected->designId;
            $$var ++;
        }
        $this->assertEqualsWithDelta($this->testData[0]['splitPercent']/100, $d1/self::ITERATIONS, 0.1);
        $this->assertEqualsWithDelta($this->testData[1]['splitPercent']/100, $d2/self::ITERATIONS, 0.1);
        $this->assertEqualsWithDelta($this->testData[3]['splitPercent']/100, $d4/self::ITERATIONS, 0.1);
    }

    public function testRegisterDesign()
    {
        $designManager = new DesignManager();
        $designManager->registerDesign(new Design($this->testData[0]['designId'], $this->testData[0]['designName'], $this->testData[0]['splitPercent']));
        $designManager->registerDesign(new Design($this->testData[1]['designId'], $this->testData[1]['designName'], $this->testData[1]['splitPercent']));
        $this->expectException(InvalidPercentException::class);
        $designManager->registerDesign(new Design($this->testData[2]['designId'], $this->testData[2]['designName'], $this->testData[2]['splitPercent']));
        $designManager->pickDesign();

    }
}
