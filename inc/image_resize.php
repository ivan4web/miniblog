<?php

function ResizeImg2($strSourceImagePath, $strDestImagePath, $intMaxWidth, $intMaxHeight, $wh) 
{ 
    $arrImageProps = getimagesize($strSourceImagePath); 
    $intImgWidth   = $arrImageProps[0]; 
    $intImgHeight  = $arrImageProps[1]; 
    $intImgType    = $arrImageProps[2]; 
    $ww = ($intImgWidth - $intMaxWidth) / 2;
    $hh = ($intImgHeight - $intMaxHeight) / 5;
    	
    switch( $intImgType) { 
       case 1: $rscImg = ImageCreateFromGif($strSourceImagePath);  break; 
        case 2: $rscImg = ImageCreateFromJpeg($strSourceImagePath); break; 
        case 3: $rscImg = ImageCreateFromPng($strSourceImagePath);  break; 
        default: return false; 
    } 
     
    if ( !$rscImg) return false; 
     
    if ($intImgWidth > $intImgHeight) { 
        $fltRatio = floatval($intMaxWidth / $intImgWidth); 
    } else { 
        $fltRatio = floatval($intMaxHeight / $intImgHeight); 
    } 
     
    $intNewWidth  = intval($fltRatio * $intImgWidth); 
    $intNewHeight = intval($fltRatio * $intImgHeight); 
     $intNewWidth = $intMaxWidth;
    $intNewHeight = $intMaxHeight;
$intImgWidth = $intMaxWidth;
$intImgHeight = $intMaxHeight;

	
if($wh == 1)  {
$ww = 0; $hh = 0;    
    $intImgWidth   = $arrImageProps[0]; 
    $intImgHeight  = $arrImageProps[1];
 $intNewWidth  = intval($fltRatio * $intImgWidth); 
    $intNewHeight = intval($fltRatio * $intImgHeight); 
 }
    $rscNewImg = imagecreatetruecolor($intNewWidth, $intNewHeight); 
    if (!imagecopyresampled($rscNewImg, $rscImg,   0, 0, $ww, $hh, $intNewWidth, $intNewHeight+5, $intImgWidth, $intImgHeight)) return false; 
     
    switch($intImgType) { 
        case 1:  $retVal = ImageGIF($rscNewImg, $strDestImagePath);  break; 
        case 3:  $retVal = ImagePNG($rscNewImg, $strDestImagePath);  break; 
        case 2:  $retVal = ImageJPEG($rscNewImg, $strDestImagePath, 90); break; 
        default: return false; 
    } 
     
    ImageDestroy($rscNewImg); 
     
    return true; 
}

function img_resize($src, $dest, $width, $height, $rgb=0xFFFFFF, $quality=100)
{
  if (!file_exists($src)) return false;

  $size = getimagesize($src);

  if ($size === false) return false;

  $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
  $icfunc = "imagecreatefrom" . $format;
  if (!function_exists($icfunc)) return false;

  $x_ratio = $width / $size[0];
  $y_ratio = $height / $size[1];

  $ratio       = min($x_ratio, $y_ratio);
  $use_x_ratio = ($x_ratio == $ratio);

  $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
  $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
  $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
  $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

  $isrc = $icfunc($src);
  $idest = imagecreatetruecolor($width, $height);

  imagefill($idest, 0, 0, $rgb);
  imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, 
    $new_width, $new_height, $size[0], $size[1]);

  imagejpeg($idest, $dest, $quality);

  imagedestroy($isrc);
  imagedestroy($idest);

  return true;

}
?>
