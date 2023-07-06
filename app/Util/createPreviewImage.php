<?php

namespace App\Util;


function createPreviewImage(string $imagePath) 
{
  $fileType = mime_content_type($imagePath);
  if(!$fileType) {
    exit('File type error');
  }

  $srcImg = null;
  switch($fileType) {
    case 'image/jpeg':
      $srcImg = imagecreatefromjpeg($imagePath);
      break;
    case 'image/png':
      $srcImg = imagecreatefrompng($imagePath);
      break;
    case 'image/gif':
      $srcImg = imagecreatefromgif($imagePath);
      break;
    case 'image/webp':
      $srcImg = imagecreatefromwebp($imagePath);
      break;
  }

  If(!$srcImg) {
    exit("Error, fileType: $fileType\n");
  }

  $srcWidth = imageSX($srcImg);
  $srcHeight = imageSY($srcImg);

  $srcX = 0;
  $srcY = 0;

  $diff = $srcWidth - $srcHeight;
  if($diff > 0) {
    $srcX = $diff / 2;
    $srcWidth = $srcHeight;
  }
  else {
    $srcY = -$diff / 2;
    $srcHeight = $srcWidth;
  }
  
  $size = 150;
  $previewImg = imagecreatetruecolor($size, $size);

  imagecopyresampled($previewImg, $srcImg, 0, 0, $srcX, $srcY, $size, $size, $srcWidth, $srcHeight);

  $tmpImgPath = storage_path('app/tmp_img.jpg');
  imagejpeg($previewImg, $tmpImgPath);

  imagedestroy($previewImg);
  imagedestroy($srcImg);


  return $tmpImgPath;
}