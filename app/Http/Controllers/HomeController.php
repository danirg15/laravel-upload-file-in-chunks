<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class HomeController extends Controller {
    

	public function index() {
		return view('index');
	}

	public function upload(Request $request) {
		// create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
        // check if the upload is success
        if ($receiver->isUploaded()) {
            // receive the file
            $save = $receiver->receive();
            // check if the upload has finished (in chunk mode it will send smaller files)
            if ($save->isFinished()) {
                // save the file and return any response you need
                return $this->saveFile($save->getFile());
            } else {
                // we are in chunk mode, lets send the current progress
                /** @var AbstractHandler $handler */
                $handler = $save->handler();
                return response()->json([
                    "done" => $handler->getPercentageDone(),
                ]);
            }
        } else {
            throw new UploadMissingFileException();
        }
	}

	private function saveFile(UploadedFile $file) {
        $fileName = $file->getClientOriginalName();//rename

        $path = storage_path("app/uploads");
        // move the file name
        $file->move($path, $fileName);

        return response()->json([
            'path' => $path.'/'.$fileName,
        ]);
    }



}
