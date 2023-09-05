<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Models\Products\m_category as m_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryProductsController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    function category(Request $request)
    {
        $is_metode = $request->input('is_metode');
        $id = $request->input('category_id');
        switch ($is_metode) {
            case 'list':
                try {
                    if ($id == null) {
                        $list = m_category::all()->toArray();
                    } else {
                        $list = m_category::where('category_id', $id)->get()->toArray();
                    }
                    return json_encode(['category' => $list]);
                } catch (\Exception $e) {
                    return json_encode(['status' => 0, 'message' => 'Gagal mengambil data => ' . $e->getMessage(), 'debug' => $e->getTrace()]);
                }

                break;
            case 'ambil':
                try {
                    $ambil = m_category::findOrFail($id)->first()->toArray();

                    return json_encode(['category' => $ambil]);
                } catch (\Exception $e) {
                    return json_encode(['status' => 1, 'message' => 'Gagal mengambil data => ' . $e->getMessage(), 'debug' => $e->getTrace()]);
                }

                break;
            case 'tambah':
                try {
                    DB::beginTransaction();
                    if (!empty($id)) {
                        m_category::find($id)->first();
                    } else {
                        $category = new m_category();
                    }

                    $id = $category::max('category_id');
                    $id = $id + 1;

                    $category->category_id =   $data['id'] = $id;
                    $category->category_name = $request->category_name;
                    $category->save();

                    DB::commit();
                    return json_encode(['category_id' => $category->category_id, 'status' => 1, 'message' => 'Insert Success']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return json_encode(['status' => 1, 'message' => 'Insert Failed : ' . $e->getMessage(), 'debug' => $e->getTrace()]);
                }

                break;
            case 'ubah':
                return m_category::updateOrCreate(
                    ['category_id' => $id],
                    [
                        'category_name' => $request->category_name
                    ]
                );
                break;

            case 'hapus':
                try {
                    DB::beginTransaction();
                    if (!empty($id)) {
                        $hapus_category = m_category::findOrFail($id);
                    } else {
                        return json_encode(['status' => 0, 'message' => 'Gagal mengambil data']);
                    }

                    $hapus_category->delete();

                    DB::commit();
                    return json_encode(['status' => 1, 'message' => 'Berhasil dihapus!']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return json_encode(['status' => 0, 'message' => 'Delete Failed : ' . $e->getMessage(), 'debug' => $e->getTrace()]);
                }

                break;
            default:
                return [
                    'status' => 0,
                    'message' => 'Metode tidak ditemukan di API'
                ];
                break;
        }
    }
}
