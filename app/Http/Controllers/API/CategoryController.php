<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    function category(Request $request)
    {
        $is_metode = $request->input('is_metode');
        $category_id = $request->input('category_id');
        $category_name = $request->input('category_name');

        switch ($is_metode) {
            case 'list':
                try {
                    if ($category_name == null) {
                        $list = Category::all()->toArray();
                    } else {
                        $list = Category::where('category_name', "LIKE", '%' . $category_name . '%')->get()->toArray();
                    }
                    return json_encode(['category' => $list]);
                } catch (\Exception $e) {
                    return json_encode(['status' => 0, 'message' => 'Gagal mengambil data => ' . $e->getMessage(), 'debug' => $e->getTrace()]);
                }
                break;
            case 'ambil':
                try {
                    if ($category_id == null) {
                        return json_encode(['status' => 0, 'message' => 'Gagal mengambil data => category_id kosong']);
                    } else {
                        $list = Category::where('category_id', $category_id)->get()->toArray();
                    }
                    return json_encode(['category' => $list]);
                } catch (\Exception $e) {
                    return json_encode(['status' => 0, 'message' => 'Gagal mengambil data => ' . $e->getMessage(), 'debug' => $e->getTrace()]);
                }
                break;
            case 'tambah':
                try {
                    DB::beginTransaction();
                    $existingCategory = Category::where('category_name', $category_name)->first();

                    if ($existingCategory) {
                        return json_encode(['status' => 0, 'message' => 'Category sudah ada']);
                    } else {
                        $m_category              = new Category();
                    }
                    $id = $m_category::max('category_id') + 1;

                    $m_category->category_id = $id;
                    $m_category->category_name = $category_name;

                    $m_category->save();

                    DB::commit();
                    return json_encode([
                        'category_id' => $id, 'status' => 1, 'message' => 'Insert Success'
                    ]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return json_encode(['status' => 0, 'message' => 'Insert Failed : ' . $e->getMessage(), 'debug' => $e->getTrace()]);
                }
                break;

            case 'ubah':
                try {
                    DB::beginTransaction();
                    $m_category = Category::where('category_id', $category_id)->first();
                    if (!$m_category) {
                        return json_encode(['status' => 0, 'message' => 'Category tidak ditemukan']);
                    }
                    $m_category->category_name = $category_name;

                    $m_category->update();

                    DB::commit();
                    return json_encode(['category_id' => $m_category->category_id, 'status' => 1, 'message' => 'Update Success']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return json_encode(['status' => 0, 'message' => 'Insert Failed : ' . $e->getMessage(), 'debug' => $e->getTrace()]);
                }
                break;

            case 'hapus':
                try {
                    DB::beginTransaction();
                    $m_category = Category::where('category_id', $category_id)->first();
                    if (!$m_category) {
                        return json_encode(['status' => 0, 'message' => 'Category tidak ditemukan']);
                    }

                    $m_category->delete();

                    DB::commit();
                    return json_encode(['status' => 0, 'message' => 'Delete success!']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return json_encode(['status' => 1, 'message' => 'Delete Failed : ' . $e->getMessage(), 'debug' => $e->getTrace()]);
                }
                break;
            default:
                return [
                    "status" => 1,
                    "message" => "Metode tidak ditemukan"
                ];
        }
    }
}
