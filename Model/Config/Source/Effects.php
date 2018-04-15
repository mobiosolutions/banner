<?php
/**
 * Copyright Â© 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Used in creating options for Yes|No config value selection
 *
 */
namespace Mobiosolutions\Banner\Model\Config\Source;

class Effects implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $scopeConfig = $objectManager->create('Magento\Framework\App\Config\ScopeConfigInterface');
        $psrLog = $objectManager->create('Psr\Log\LoggerInterface');
        $duration = $scopeConfig->getValue('banner/configuration/duration',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $delay = $scopeConfig->getValue('banner/configuration/delay',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        
        return [
            ['value' => '{$Duration:'.$duration.',$Opacity:2}', 'label' => __('Fade')], 
            ['value' => '{$Duration:'.$duration.',x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade in L')],
            ['value' => '{$Duration:'.$duration.',x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade in R')],
            ['value' => '{$Duration:'.$duration.',y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade in T')],
            ['value' => '{$Duration:'.$duration.',y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade in B')],
            ['value' => '{$Duration:'.$duration.',x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade in LR')],
            ['value' => '{$Duration:'.$duration.',y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade in LR Chess')],
            ['value' => '{$Duration:'.$duration.',y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade in TB')],
            ['value' => '{$Duration:'.$duration.',x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade in TB Chess')],
            ['value' => '{$Duration:'.$duration.',x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade in Corners')],
            ['value' => '{$Duration:'.$duration.',x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade out L')],
            ['value' => '{$Duration:'.$duration.',x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade out R')],
            ['value' => '{$Duration:'.$duration.',y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade out T')],
            ['value' => '{$Duration:'.$duration.',y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade out B')],
            ['value' => '{$Duration:'.$duration.',x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade out LR')],
            ['value' => '{$Duration:'.$duration.',y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade out LR Chess')],
            ['value' => '{$Duration:'.$duration.',y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade out TB')],
            ['value' => '{$Duration:'.$duration.',x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade out TB Chess')],
            ['value' => '{$Duration:'.$duration.',x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade out Corners')],
            ['value' => '{$Duration:'.$duration.',x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly in L')],
            ['value' => '{$Duration:'.$duration.',x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly in R')],
            ['value' => '{$Duration:'.$duration.',y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly in T')],
            ['value' => '{$Duration:'.$duration.',y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly in B')],
            ['value' => '{$Duration:'.$duration.',x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly in LR')],
            ['value' => '{$Duration:'.$duration.',y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly in LR Chess')],
            ['value' => '{$Duration:'.$duration.',y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly in TB')],
            ['value' => '{$Duration:'.$duration.',x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly in TB Chess')],
            ['value' => '{$Duration:'.$duration.',x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly in Corners')],
            ['value' => '{$Duration:'.$duration.',x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly out L')],
            ['value' => '{$Duration:'.$duration.',x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly out R')],
            ['value' => '{$Duration:'.$duration.',y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly out T')],
            ['value' => '{$Duration:'.$duration.',y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly out B')],
            ['value' => '{$Duration:'.$duration.',x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly out LR')],
            ['value' => '{$Duration:'.$duration.',y:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly out LR Chess')],
            ['value' => '{$Duration:'.$duration.',y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly out TB')],
            ['value' => '{$Duration:'.$duration.',x:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly out TB Chess')],
            ['value' => '{$Duration:'.$duration.',x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'label' => __('Fade Fly out Corners')],
            ['value' => '{$Duration:'.$duration.',$Delay:'.$delay.',$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade Clip in H')],
            ['value' => '{$Duration:'.$duration.',$Delay:'.$delay.',$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade Clip in V')],    
            ['value' => '{$Duration:'.$duration.',$Delay:'.$delay.',$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade Clip out H')],
            ['value' => '{$Duration:'.$duration.',$Delay:'.$delay.',$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'label' => __('Fade Clip out V')],
            ['value' => '{$Duration:'.$duration.',$Delay:'.$delay.',$Cols:8,$Rows:4,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2050,$Opacity:2}', 'label' => __('Fade Stairs')],
            ['value' => '{$Duration:'.$duration.',$Delay:'.$delay.',$Cols:8,$Rows:4,$Opacity:2}', 'label' => __('Fade Random')],
            ['value' => '{$Duration:'.$duration.',$Delay:'.$delay.',$Cols:8,$Rows:4,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Opacity:2}', 'label' => __('Fade Swirl')],
            ['value' => '{$Duration:'.$duration.',$Delay:'.$delay.',$Cols:8,$Rows:4,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Opacity:2}', 'label' => __('Fade ZigZag')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [0 => __('No'), 1 => __('Yes')];
    }
}