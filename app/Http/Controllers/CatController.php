<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\CatStatus;
use App\Http\Models\Module;
use App\Http\Models\Cats\CatProfile;
use App\Http\Models\Cats\CatDocumentaryTradition;
use App\Http\Models\Cats\CatPhysicalCharacteristics;
use App\Http\Models\Cats\CatTransactionTypes;
use App\Http\Models\Cats\CatProducer;
use App\Http\Models\Cats\CatSupport;
use App\Http\Models\Cats\GeoCatIdioms;
use App\Http\Models\Cats\CatBox;
use App\Http\Models\Box\Box;
use App\Http\Models\Cats\CatFiles;
use App\Http\Models\Cats\CatDocumentaryGroup;

use App\User;

class CatController extends Controller
{

    public function Cat_profiles(Request $request)
    {
        try{
            return  $cat_sectors = CatProfile::select('id','name')
            ->get();

                return response()->json([
                    'cat_representations' => $cat_sectors,
                    'message' => 'Successfully create activity!'], 200);

            }catch(\Exception $e){
                return response()->json([
                    'message' => 'No se pudo completar la acción: ' . $e->getMessage()
                ], 300);
            }
    }

    // Index get cats
    // Index get cats

    public function index_cat_documentary_tradition(Request $request)
    {
        try{
            return $docTrad = CatDocumentaryTradition::select
            ('id','name')->get();

            }catch(\Exception $e){
                return response()->json([
                    'message' => 'No se pudo completar la acción: ' . $e->getMessage()
                ], 300);
            }
    }

    public function index_cat_physical_characteristics(Request $request)
    {
        try{
            return $physicChar = CatPhysicalCharacteristics::select
            ('id','name')->get();

            }catch(\Exception $e){
                return response()->json([
                    'message' => 'No se pudo completar la acción: ' . $e->getMessage()
                ], 300);
            }
    }

    public function index_cat_transaction_type(Request $request)
    {
        try{
            return $transaction = CatTransactionTypes::select
            ('id','name')->get();

            }catch(\Exception $e){
                return response()->json([
                    'message' => 'No se pudo completar la acción: ' . $e->getMessage()
                ], 300);
            }
    }

    public function index_cat_producer(Request $request)
    {
        try{
            return $producer = CatProducer::select
            ('id','name')->get();

            }catch(\Exception $e){
                return response()->json([
                    'message' => 'No se pudo completar la acción: ' . $e->getMessage()
                ], 300);
            }
    }

    public function index_cat_support(Request $request)
    {
        try{
            return $support = CatSupport::select
            ('id','name')->get();

            }catch(\Exception $e){
                return response()->json([
                    'message' => 'No se pudo completar la acción: ' . $e->getMessage()
                ], 300);
            }
    }

    public function index_cat_idioms(Request $request)
    {
        try{
            return $support = GeoCatIdioms::select
            ('id','name')->get();

            }catch(\Exception $e){
                return response()->json([
                    'message' => 'No se pudo completar la acción: ' . $e->getMessage()
                ], 300);
            }
    }

    public function index_cat_box(Request $request)
    {
        try{
            return $box = Box::select
            // ('id','fileName')->orderBy('id', 'DESC')->get();
            ('id','box AS name')->get();

            }catch(\Exception $e){
                return response()->json([
                    'message' => 'No se pudo completar la acción: ' . $e->getMessage()
                ], 300);
            }
    }

    public function index_cat_files(Request $request)
    {
        try{
            return $file = CatFiles::select
            ('id','name')->get();

            }catch(\Exception $e){
                return response()->json([
                    'message' => 'No se pudo completar la acción: ' . $e->getMessage()
                ], 300);
            }
    }

    public function index_cat_documentary_group(Request $request)
    {
        try{
            return $document = CatDocumentaryGroup::select
            ('id','name')->get();

            }catch(\Exception $e){
                return response()->json([
                    'message' => 'No se pudo completar la acción: ' . $e->getMessage()
                ], 300);
            }
    }

    // Index get cats
    // Index get cats

    // Store cats
    // Store cats
    public function store_cat_files(Request $request)
    {
        $data = $request->all();

        try {
        $store = CatFiles::select('name')
            ->where('name', $data['name'])
            ->first();
            if (!empty($store))
            {
                return response()->json([
                    'success' => false,
                    'message' => "Ya existe el registro ",
                ], 500);
            }else{
                $status = new CatFiles();
                $status->name = $data['name'];
                $status->save();
                return response()->json([
                    'success' => true,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "No se pudo completar la acción. {$e->getMessage()} ",
            ], 500);
        }
    }

    public function store_cat_documentary_tradition(Request $request)
    {
        $data = $request->all();

        try {
        $store = CatDocumentaryTradition::select('name')
            ->where('name', $data['name'])
            ->first();
            if (!empty($store))
            {
                return response()->json([
                    'success' => false,
                    'message' => "Ya existe el registro ",
                ], 500);
            }else{
                $status = new CatDocumentaryTradition();
                $status->name = $data['name'];
                $status->save();
                return response()->json([
                    'success' => true,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "No se pudo completar la acción. {$e->getMessage()} ",
            ], 500);
        }
    }

    public function store_cat_physical_characteristics(Request $request)
    {
        $data = $request->all();

        try {
        $store = CatPhysicalCharacteristics::select('name')
            ->where('name', $data['name'])
            ->first();
            if (!empty($store))
            {
                return response()->json([
                    'success' => false,
                    'message' => "Ya existe el registro ",
                ], 500);
            }else{
                $status = new CatPhysicalCharacteristics();
                $status->name = $data['name'];
                $status->save();
                return response()->json([
                    'success' => true,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "No se pudo completar la acción. {$e->getMessage()} ",
            ], 500);
        }
    }

    public function store_cat_transaction_type(Request $request)
    {
        $data = $request->all();

        try {
        $store = CatTransactionTypes::select('name')
            ->where('name', $data['name'])
            ->first();
            if (!empty($store))
            {
                return response()->json([
                    'success' => false,
                    'message' => "Ya existe el registro ",
                ], 500);
            }else{
                $status = new CatTransactionTypes();
                $status->name = $data['name'];
                $status->save();
                return response()->json([
                    'success' => true,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "No se pudo completar la acción. {$e->getMessage()} ",
            ], 500);
        }
    }

    public function store_cat_producer(Request $request)
    {
        $data = $request->all();

        try {
        $store = CatProducer::select('name')
            ->where('name', $data['name'])
            ->first();
            if (!empty($store))
            {
                return response()->json([
                    'success' => false,
                    'message' => "Ya existe el registro ",
                ], 500);
            }else{
                $status = new CatProducer();
                $status->name = $data['name'];
                $status->save();
                return response()->json([
                    'success' => true,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "No se pudo completar la acción. {$e->getMessage()} ",
            ], 500);
        }
    }

    public function store_cat_support(Request $request)
    {
        $data = $request->all();

        try {
        $store = CatSupport::select('name')
            ->where('name', $data['name'])
            ->first();
            if (!empty($store))
            {
                return response()->json([
                    'success' => false,
                    'message' => "Ya existe el registro ",
                ], 500);
            }else{
                $status = new CatSupport();
                $status->name = $data['name'];
                $status->save();
                return response()->json([
                    'success' => true,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "No se pudo completar la acción. {$e->getMessage()} ",
            ], 500);
        }
    }

    public function store_cat_idioms(Request $request)
    {
        $data = $request->all();

        try {
        $store = GeoCatIdioms::select('name')
            ->where('name', $data['name'])
            ->first();
            if (!empty($store))
            {
                return response()->json([
                    'success' => false,
                    'message' => "Ya existe el registro ",
                ], 500);
            }else{
                $status = new GeoCatIdioms();
                $status->name = $data['name'];
                $status->save();
                return response()->json([
                    'success' => true,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "No se pudo completar la acción. {$e->getMessage()} ",
            ], 500);
        }
    }

    public function store_cat_box(Request $request)
    {
        $data = $request->all();

        try {
        $store = CatBox::select('name')
            ->where('name', $data['name'])
            ->first();
            if (!empty($store))
            {
                return response()->json([
                    'success' => false,
                    'message' => "Ya existe el registro ",
                ], 500);
            }else{
                $status = new CatBox();
                $status->name = $data['name'];
                $status->save();
                return response()->json([
                    'success' => true,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "No se pudo completar la acción. {$e->getMessage()} ",
            ], 500);
        }
    }

    public function store_cat_documentary_group(Request $request)
    {
        $data = $request->all();

        try {
        $store = CatDocumentaryGroup::select('name')
            ->where('name', $data['name'])
            ->first();
            if (!empty($store))
            {
                return response()->json([
                    'success' => false,
                    'message' => "Ya existe el registro ",
                ], 500);
            }else{
                $status = new CatDocumentaryGroup();
                $status->name = $data['name'];
                $status->save();
                return response()->json([
                    'success' => true,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "No se pudo completar la acción. {$e->getMessage()} ",
            ], 500);
        }
    }
    // Store cats
    // Store cats

    // Update Cats
    // Update Cats
    public function update_cat_files(Request $request, $id)
    {
        try {
            $data = $request->all();
            $update = CatFiles::find(decrypt($id));
            $update->update($data);

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);


        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function update_cat_documentary_tradition(Request $request, $id)
    {
        try {
            $data = $request->all();
            $update = CatDocumentaryTradition::find(decrypt($id));
            $update->update($data);

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);


        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function update_cat_physical_characteristics(Request $request, $id)
    {
        try {
            $data = $request->all();
            $update = CatPhysicalCharacteristics::find(decrypt($id));
            $update->update($data);

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);


        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function update_cat_transaction_type(Request $request, $id)
    {
        try {
            $data = $request->all();
            $update = CatTransactionTypes::find(decrypt($id));
            $update->update($data);

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);


        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function update_cat_producer(Request $request, $id)
    {
        try {
            $data = $request->all();
            $update = CatProducer::find(decrypt($id));
            $update->update($data);

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);


        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function update_cat_support(Request $request, $id)
    {
        try {
            $data = $request->all();
            $update = CatSupport::find(decrypt($id));
            $update->update($data);

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);


        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function update_cat_idioms(Request $request, $id)
    {
        try {
            $data = $request->all();
            $update = GeoCatIdioms::find(decrypt($id));
            $update->update($data);

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);


        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function update_cat_box(Request $request, $id)
    {
        try {
            $data = $request->all();
            $update = CatBox::find(decrypt($id));
            $update->update($data);

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);


        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function update_cat_documentary_group(Request $request, $id)
    {
        try {
            $data = $request->all();
            $update = CatDocumentaryGroup::find(decrypt($id));
            $update->update($data);

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);


        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }
    // Update Cats
    // Update Cats

    // Delete Cats
    // Delete Cats
    public function delete_cat_file($id)
    {
        try {
            $dalete = CatFiles::where('id', $id)->first();
            $dalete->delete();

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function delete_cat_documentary_tradition($id)
    {
        try {
            $dalete = CatDocumentaryTradition::where('id', $id)->first();
            $dalete->delete();

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function delete_cat_physical_characteristics($id)
    {
        try {
            $dalete = CatPhysicalCharacteristics::where('id', $id)->first();
            $dalete->delete();

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function delete_cat_transaction_type($id)
    {
        try {
            $dalete = CatTransactionTypes::where('id', $id)->first();
            $dalete->delete();

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function delete_cat_producer($id)
    {
        try {
            $dalete = CatProducer::where('id', $id)->first();
            $dalete->delete();

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function delete_cat_support($id)
    {
        try {
            $dalete = CatSupport::where('id', $id)->first();
            $dalete->delete();

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function delete_cat_idioms($id)
    {
        try {
            $dalete = GeoCatIdioms::where('id', $id)->first();
            $dalete->delete();

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function delete_cat_box($id)
    {
        try {
            $dalete = CatBox::where('id', $id)->first();
            $dalete->delete();

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }

    public function delete_cat_documentary_group($id)
    {
        try {
            $dalete = CatDocumentaryGroup::where('id', $id)->first();
            $dalete->delete();

            return response()->json([
                'success'  => true,
                'messaage' => 'Éxito subio el JSON a Storage'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'messaage' => 'No se pudo completar la acción',
                'error'    => $e->getMessage()
            ], 500);
        }
    }
    // Delete Cats
    // Delete Cats
}
