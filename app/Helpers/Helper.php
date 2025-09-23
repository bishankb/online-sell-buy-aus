<?php

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 

// Save the file
function saveFile($fileData, $fileName, $fileId) {
    try {
        $manager = new ImageManager(new Driver());

        $storeFilePath = "media/{$fileName}/{$fileId}/" . $fileData->hashName();
        $storeThumbnailPath = "media/{$fileName}/{$fileId}/thumbnail/" . $fileData->hashName();

        // Read once, clone for thumbnail
        $newFile = $manager->read($fileData)->orient();
        $newThumbnailFile = clone $newFile;

        $height = $newFile->height();
        $width = $newFile->width();

        // Resize main file
        if ($height > $width) {
            $newFile->resize(720, 960, fn($constraint) => $constraint->aspectRatio());
        } else {
            $newFile->resize(960, 720, fn($constraint) => $constraint->aspectRatio());
        }

        $newThumbnailFile->resize(130, 190, fn($constraint) => $constraint->aspectRatio());

        Storage::disk('public')->put($storeFilePath, (string) $newFile->encode());
        Storage::disk('public')->put($storeThumbnailPath, (string) $newThumbnailFile->encode());

        // File type detection
        $fileType = explode('/', $fileData->getMimeType());
        $checkFileType = [
            'image'        => 'image',
            'application'  => 'document',
            'text'         => 'document',
        ];

        $media = Media::create(
            [
                'filename'           => basename($storeFilePath),
                'original_filename'  => $fileData->getClientOriginalName(),
                'extension'          => $fileData->getClientOriginalExtension(),
                'mime'               => $fileData->getMimeType(),
                'type'               => $checkFileType[$fileType[0]] ?? 'other',
                'file_size'          => $fileData->getSize(),
            ]
        );

        return $media;

    } catch (\Throwable $exception) {
        logger()->error("File save failed: " . $exception->getMessage());
        return null;
    }
}

// Remove the file
function removeFile($fileId) {
    try {
        if (Media::where('id', $fileId)->first()) {
            $media = Media::where('id', $fileId)->first();
            $media->delete();

            return $media;
        }
    } catch (\Exception $exception) {
        logger()->error($exception->getMessage());
    }
}

// Change the price format to nepali currency format
function nepaliCurrencyFormat($money){
    $decimal = (string)($money - floor($money));
    $money = floor($money);
    $length = strlen($money);
    $m = '';
    $money = strrev($money);
    for($i=0;$i<$length;$i++){
        if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
            $m .=',';
        }
        $m .=$money[$i];
    }
    $result = strrev($m);
    $decimal = preg_replace("/0\./i", ".", $decimal);
    $decimal = substr($decimal, 0, 3);
    if( $decimal != '0'){
    $result = $result.$decimal;
    }
    return $result;
}

function pagination($data, $loop) {
    return ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1;
}

function reversePagination($data, $loop) {
    return $data->total() + 1 - (($data->currentpage() - 1) * $data->perpage() + $loop->index + 1);
}

?>