<?php

namespace App\Image;

use GdImage;

/**
 * Respoonsavel por redimensionamento das imagens
 * @package App\Image
 */
class Resize
{
   /**
    * Imagem
    * @var GdImage
    */
   private GdImage $image;

   /**
    * Tipo da imagem
    * @var string
    */
   private string $type;

   /**
    * Metodo responsavel por carregar os dados da classe
    * @param string $file 
    * @return void 
    */
   public function __construct(string $file)
   {
      $this->image = imagecreatefromstring(file_get_contents($file));
      $info = pathinfo($file);

      $this->type = $info['extension'];

      $info['extension'];
   }


   /**
    * Metodo responsavel por imprimir imagem na tela
    * @param integer $quality
    * @return void 
    */
   public function print(int $quality = 100):void
   {
      header("Content-Type: image/" . $this->type);
      $this->output(null, $quality);
      exit;
   }

   /**
    * Metodo responsavel por redimensionar a imagem
    * @param int $newWidth 
    * @param int $newHeight 
    * @return void 
    */
   public function resize(int $newWidth, int $newHeight = -1): void
   {
      $this->image = imagescale($this->image, $newWidth, $newHeight);
   }


   /**
    * Responsavel por salvar imagem no disco
    * @param string $localFile 
    * @param int $quality 
    * @return void 
    */
   public function save(string $localFile, int $quality = 100):void
   {
      $this->output($localFile, $quality);
   }


   /**
    * Responsavel por executara saida de uma imagem
    * @param string $localfile 
    * @param int $quality 
    * @return void 
    */
   private function output(?string $localfile, int $quality = 100): void
   {
      switch ($this->type) {
         case 'png':
            imagepng($this->image, $localfile, $quality);
            break;
         case 'jpg':
         case 'jpeg':
            imagejpeg($this->image, $localfile, $quality);
            break;
         case 'webp':
            imagewebp($this->image, $localfile, $quality);
            break;
         case 'bmp':
            imagebmp($this->image, $localfile, $quality);
            break;
         case 'gif':
            imagegif($this->image, $localfile, $quality);
            break;
         default:
            die("Tipo não mapeado - " . $this->type);
      }
   }
}
