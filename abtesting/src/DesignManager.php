<?php

namespace App;

use App\Exceptions\InvalidPercentException;
use App\models\Design;
use Mockery\Exception;

class DesignManager
{
    private array $designs;
    private array $percents;
    private int $nDesigns;
    private int $sumPercents;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->percents = [];
        $this->designs = [];
        $this->nDesigns = 0;
        $this->sumPercents = 0;
    }


    /**
     * Adds a design to the list
     *
     * @param Design $design
     * @return void
     * @throws InvalidPercentException
     */
    public function registerDesign(Design $design){

        $this->sumPercents = array_sum($this->percents);
        if($this->sumPercents + $design->splitPercent > 100)
            throw new InvalidPercentException('Sum of split percentages overflow.');

        $this->designs[$design->designId] = $design;
        $this->percents[$design->designId] = $design->splitPercent;
        $this->nDesigns++;
        $this->sumPercents += $design->splitPercent;

        return $this;
    }

    /**
     * Picks a random design from the weights
     *
     * @return mixed
     * @throws InvalidPercentException
     */
    public function pickDesign(){

        if($this->sumPercents < 100)
            throw new InvalidPercentException('Total percentages don\'t add up to 100.');

        $rand = rand(1, 100);

        $sum = 0;
        $selectedDesign = null;
        foreach ($this->percents as $id=>$percent) {
            $sum += $percent;
            if($sum >= $rand){
                $selectedDesign = $this->designs[$id];
                break;
            }
        }
        if($selectedDesign == null)
            throw new InvalidPercentException('Error selecting a design.');

        return $selectedDesign;
    }
}