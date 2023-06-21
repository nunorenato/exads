<?php

namespace App;

use App\Exceptions\InvalidPercentException;
use App\models\Design;
use App\DesignManager;
use Exads\ABTestData;
use Exads\ABTestException;

class App
{
    public function run(): void
    {
        // Get the designs from the promotion
        try {
            $abTest = new ABTestData(3);
            $promotion = $abTest->getPromotionName();
            $designs = $abTest->getAllDesigns();
        } catch (ABTestException $e) {
            echo $e->getMessage();
            return;
        }

        $designManager = new DesignManager();
        try {
            foreach ($designs as $design) {
                $designManager->registerDesign(new Design($design['designId'], $design['designName'], $design['splitPercent']));
            }
            $outDesign = $designManager->pickDesign();

            Response::sendJson($outDesign, 200);
        }
        catch (InvalidPercentException $ipe){
            echo $ipe->getMessage();
        }

    }
}