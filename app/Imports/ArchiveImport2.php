<?php

namespace App\Imports;

ini_set('memory_limit', '-1');
set_time_limit(0);
ini_set('max_execution_time',0);

use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Models\Archive\Archive;
use App\Http\Models\Archive\Languages;
use App\Http\Models\Archive\Producer;
use App\Http\Models\Archive\Support;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class ArchiveImport2 implements ToCollection, WithHeadingRow
{
  /**
   * @param Collection $collection
   */
  public function collection(Collection $rows)
  {
    $rows = $rows->toArray();
    // iterating each row and validating it:
    foreach ($rows as $key => $row) {
      $soporte = $row['soporte'];
      $soportearray = explode (",", $soporte);
      $productor = $row['productor'];
      $productorarray = explode (",", $productor);
      $idiomas = $row['idiomas'];
      $idiomasarray = explode (",", $idiomas);

          $new_archive =  Archive::create([
            'code' => $row['codigo'],
            'box_id' => (int)$row['caja'],
            'proceedings_id' => (int) $row['expediente'],
            'title' => $row['titulo'],
            'placement' => $row['colocacion'],
            'group_id' => (int)$row['grupo_documental'],
            'year' => $row['ano'],
            'openingDate' => $row['fecha_de_apertura'],
            'closingDate' => $row['fecha_de_cierre'],
            'startVolume' => $row['volumen_inicio'],
            'endVolume' => $row['volumen_final'],
            'characters_id' => (int)$row['caracteristicas'],
            'documentaryTradition_id' => (int)$row['tradicion_documental'],
            'description' => $row['descripcion'],
            'notesArchivist' => $row['notas_de_archivista']
          ]);



      foreach ($idiomasarray as $key => $idioma) {
      $new_languages =  Languages::create([
        'form_archives_id'            => (int)$new_archive->id,
        'geo_cat_idioms_id'          =>  (int)$idioma,
      ]);
      }
      foreach ($productorarray as $key => $producto) {

      $new_producers =  Producer::create([
        'form_archives_id'            => (int)$new_archive->id,
        'cat_producer_id'          =>  (int)$producto,
      ]);
      }
      foreach ($soportearray as $key => $soporte) {
      $new_supports =  Support::create([
        'form_archives_id'            => (int)$new_archive->id,
        'cat_support_id'          =>  (int)$soporte,
      ]);
      }
    }
  }

  // this function returns all validation errors after import:
  public function getErrors()
  {
    return $this->errors;
  }
  public function rules(): array
  {
    return [
      'codigo' => 'required|unique:form_archives,code,NULL,id,deleted_at,NULL',
      'expediente' => 'required|digits:1',
      'titulo' => 'required',
      'colocacion' => 'required|max:190',
      'grupo_documental' => 'required|digits:1',
      'ano' => 'required|numeric|between:1900,2050',
      'fecha_de_apertura' => 'required',
      'fecha_de_cierre' => 'required',
      'volumen_inicio' => 'required',
      'volumen_final' => 'required',
      'caracteristicas' => 'required',
      'tradicion_documental' => 'required',
      'descripcion' => 'required',

    ];
  }
  public function validationMessages()
  {
    return [
      'codigo.required' => trans('El campo codigo es requerido'),
      'codigo.unique' => trans('El campo codigo debe ser unico'),
      'expediente.required' => trans('El campo expediente es requerido'),
      'titulo.required' => trans('El campo titulo es requerido'),
      'colocacion.required' => trans('El campo colocacion es requerido'),
      'colocacion.max' => trans('El campo colocacion tiene un limite de 190 caracteres'),
      'ano.required' => trans('El campo año es requerido'),
      'ano.between' => trans('El campo año debe ser un valor entre :min y :max.'),
      'fecha_de_apertura.required' => trans('El campo :attribute es requerido'),
      'fecha_de_cierre.required' => trans('El campo :attribute es requerido'),
      'volumen_inicio.required' => trans('El campo :attribute es requerido'),
      'volumen_final.required' => trans('El campo :attribute es requerido'),
      'caracteristicas.required' => trans('El campo :attribute es requerido'),
      'tradicion_documental.required' => trans('El campo :attribute es requerido'),
      'descripcion.required' => trans('El campo :attribute es requerido'),
    ];
  }
  public function onError(Throwable $e)
  {
    //
  }
  public function uniqueBy()
  {
    return 'code';
  }
}
