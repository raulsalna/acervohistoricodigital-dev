<?php

namespace App\Http\Controllers;

use App\Http\Models\Document;
use DB;
use Illuminate\Http\Request;
use SoftCreatR\MimeDetector\MimeDetector;
use SoftCreatR\MimeDetector\MimeDetectorException;

class DocumentController extends Controller
{
  public function saveDocument(Request $request)
    {
            
            $file = new Document();
            $path = 'acervo/files';
            $document = $request->document;
            $allowedFiles = ['pdf'];
            $mimeDetector = new MimeDetector();
            $mimeDetector->setFile($document);
            $fileData = $mimeDetector->getFileType();
            
            if(isset($fileData["ext"])){
              $aux = false;
              foreach ($allowedFiles as $ext){
                  if ($ext == $fileData["ext"]){
                      $aux = true;
                  }
              }
            }else $aux = false;

            if($aux === false){
              return response()->json([
                'storeSuccess' => false,
                    'file' => []
              ], 500);
            }else{

              try {
                      $file = new Document();
                      $path = 'acervo/files';
                      $document = $request->document;
                      $nameHash = encrypt($file->id) . '.' . $document->extension();
          
                      $file->user_id = auth()->user()->id;
                      $file->fileName = $document->getClientOriginalName();
                      $file->fileNameHash = $nameHash;
                      $file->save();
          
                      $document->storeAs($path, $nameHash);
          
                      $info = [
                          'id' => $file->id,
                          'name' => $file->fileName
                      ];
  
                      
  
                          return response()->json([
                              'success'    => true,
                              'file' => $info
                          ]);
                      }
                    catch ( \Exception $e ) {
                        
            
                        return response()->json([
                            'success' => false,
                            'message' => $e->getMessage()
                        ]);
                    }
            }

            
    }

  public function downloadFile($id)
  {
    try {
      $document   = Document::find(decrypt($id));

      $pathToFile = storage_path() . '/app/acervo/files/' . $document->fileNameHash;

      return response()->download(
        $pathToFile,
        $document->fileName,
        [],
        'inline'
      );

    }
    catch (\Exception $e) {

      return response()->json([
        'success' => false,
        'message' => 'No se pudo completar la acción: ' . $e->getMessage(),
      ], 500);
    }

  }
}
