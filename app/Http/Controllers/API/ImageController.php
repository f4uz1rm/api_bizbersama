<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{

    function image(Request $request)
    {
        $is_metode = $request->input('is_metode');
        $image_id = $request->input('image_id');
        $sub_image_id = $request->input('sub_image_id');

        switch ($is_metode) {
            case 'list':
                try {
                    $list = Image::all()->toArray();
                    return json_encode(['image' => $list]);
                } catch (\Exception $e) {
                    return json_encode(['status' => 0, 'message' => 'Gagal mengambil data => ' . $e->getMessage(), 'debug' => $e->getTrace()]);
                }
                break;
            case 'ambil':
                try {
                    if ($image_id == null) {
                        return json_encode(['status' => 0, 'message' => 'Gagal mengambil data => image_id kosong']);
                    } else {
                        $list = Image::where('image_id', $image_id)->get()->toArray();
                    }
                    return json_encode(['image' => $list]);
                } catch (\Exception $e) {
                    return json_encode(['status' => 0, 'message' => 'Gagal mengambil data => ' . $e->getMessage(), 'debug' => $e->getTrace()]);
                }
                break;
            case 'tambah':
                try {
                    DB::beginTransaction();
                    $m_image              = new Image();
                    $id = $m_image::max('image_id') + 1;
                    $sub_id = $m_image::max('sub_image_id') + 1;
                    $m_image->image_id = $id;
                    $m_image->sub_image_id = $sub_id;
                    $m_image->image_link = $request->image_link;
                    $m_image->save();

                    DB::commit();
                    return json_encode(['image_id' => $id, 'sub_image_id' => $sub_id, 'status' => 1, 'message' => 'Insert Success']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return json_encode(['status' => 0, 'message' => 'Insert Failed : ' . $e->getMessage(), 'debug' => $e->getTrace()]);
                }

                break;
            case 'ubah':
                try {
                    DB::beginTransaction();
                    $m_image = Image::where('image_id', $image_id)->where('sub_image_id', $sub_image_id)->first();
                    if (!$m_image) {
                        return json_encode(['status' => 0, 'message' => 'Image tidak ditemukan']);
                    }
                    $m_image->sub_image_id = $request->sub_image_id;
                    $m_image->image_link = $request->image_link;
                    $m_image->update();

                    DB::commit();
                    return json_encode(['image_id' => $m_image->image_id, 'status' => 1, 'message' => 'Update Success']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return json_encode(['status' => 0, 'message' => 'Insert Failed : ' . $e->getMessage(), 'debug' => $e->getTrace()]);
                }
                break;
            case 'hapus':
                try {
                    DB::beginTransaction();
                    $m_image = Image::where('image_id', $image_id)->where('sub_image_id', $sub_image_id)->first();
                    if (!$m_image) {
                        return json_encode(['status' => 0, 'message' => 'Image tidak ditemukan']);
                    }

                    $m_image->delete();

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
