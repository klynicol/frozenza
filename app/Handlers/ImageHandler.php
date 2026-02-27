<?php

namespace App\Handlers;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageHandler
{
   /**
    * Upload an image to the public disk
    */
   public static function upload(UploadedFile $file): Image
   {
      $extension = $file->extension();
      $imageName = time() . '.' . $extension;
      $file->storeAs('images', $imageName, [
         'disk' => 'public',
      ]);

      [$width, $height] = $file->dimensions();
      $imageUpload = new Image();
      $imageUpload->disk = 'public';
      $imageUpload->path = 'images';
      $imageUpload->name = $imageName;
      $imageUpload->extension = $extension;
      $imageUpload->size = $file->getSize();
      $imageUpload->mime_type = $file->getMimeType();
      $imageUpload->width = $width;
      $imageUpload->height = $height;
      $imageUpload->save();

      return $imageUpload;
   }

   /**
    * Create an image from an existing file on the given disk
    */
   public static function createFromExistingFile(string $disk, string $filePath, array $details = []): Image
   {
      if (!Storage::disk($disk)->exists($filePath)) {
         throw new \Exception("File does not exist at path: {$filePath}");
      }

      if (empty($details)) {
         $fileContent = Storage::disk($disk)->get($filePath);
         $details = self::getDetailsFromBinaryImage($fileContent);
      }

      $imageUpload = new Image();
      $imageUpload->disk = $disk;
      $imageUpload->path = dirname($filePath);
      $imageUpload->name = basename($filePath);
      $imageUpload->extension = $details['extension'];
      $imageUpload->size = $details['size'];
      $imageUpload->mime_type = $details['mime_type'];
      $imageUpload->width = $details['width'];
      $imageUpload->height = $details['height'];
      $imageUpload->save();

      return $imageUpload;
   }

   /**
    * Download an image from a URL and save it to the given disk
    */
   public static function createFromUrl(string $url, string $disk, string $path, string $newFileName = null): Image|null
   {
      $image = file_get_contents($url);
      if (!$image) {
         return null;
      }

      $details = self::getDetailsFromBinaryImage($image);
      
      if ($newFileName) {
         $filename = $newFileName . '.' . $details['extension'];
      } else {
         $filename = basename($url);
      }

      $filePath = trim($path, '/') . '/' . $filename;
      
      Storage::disk($disk)->put($filePath, $image);
      
      return self::createFromExistingFile($disk, $filePath, $details);
   }

   /**
    * Get the file details from a binary image
    * This allows us to not need a local path to the image
    */
   private static function getDetailsFromBinaryImage(string $binaryImage): array
   {
      // Get the MIME type
      $finfo = new \finfo(FILEINFO_MIME_TYPE);
      $mimeType = $finfo->buffer($binaryImage);

      // Map MIME type to file extensions
      $mimeToExtensionMap = [
         'image/jpeg' => 'jpeg',
         'image/png' => 'png',
         'image/gif' => 'gif',
         'image/webp' => 'webp',
         'image/bmp' => 'bmp',
      ];

      $fileExtension = isset($mimeToExtensionMap[$mimeType]) ? $mimeToExtensionMap[$mimeType] : 'unknown';

      // Get image dimensions
      $imageInfo = getimagesizefromstring($binaryImage);
      if ($imageInfo) {
         $width = $imageInfo[0]; // Width
         $height = $imageInfo[1]; // Height
      } else {
         $width = $height = 'unknown';
      }

      // Get file size
      $fileSize = strlen($binaryImage); // File size in bytes

      return [
         'mime_type' => $mimeType,
         'extension' => $fileExtension,
         'width' => $width,
         'height' => $height,
         'size' => $fileSize,
      ];
   }

   private static uploadClouflare(){
      
   }
}
