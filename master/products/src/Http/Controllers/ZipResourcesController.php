<?php

namespace Master\Products\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use File;
use ZipArchive;
use Master\Products\Interfaces\ProductsRepositoryInterface;
use Master\Products\Models\Products;
use Storage;
use RuntimeException;

class ZipResourcesController extends Controller
{
  protected $repository;

  public function __construct(ProductsRepositoryInterface $repository)
  {
    $this->middleware('auth:admin');
    $this->repository = $repository;
  }

  public function create(Request $request, Products $data)
  {

    $public_dir =  base_path('storage/uploads');
    $zipFileName = uniqid()'.zip';
    $zip = new ZipArchive;

    if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
      $zip->setPassword('secret');
      foreach ($data->file as $key => $value) {
        $zip->addFile($public_dir.'/'.$value['path'], $value['file']);
        $zip->setEncryptionName($value['file'], ZipArchive::EM_AES_256);
      }

      $zip->close();
    }


    $filetopath= File::get($public_dir.'/'.$zipFileName);


    $test = Storage::disk('public')->put('tester/'.$zipFileName, $filetopath);


    $location = Storage::disk('public')->url('tester/'.$zipFileName);

     

  }
}