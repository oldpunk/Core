<?php

namespace Modules\Core\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ImagesController extends Controller
{
    public function upload(Request $request)
    {
        $this->validate($request, [
            'qqfile' => 'image'
        ]);

        $id = $request->request->get('id');
        $table = $request->request->get('table');
        $link = $request->request->get('link', false);
        $file = $request->file('qqfile');

        if($file instanceof UploadedFile) {
            try{
                $image = $file->store('/images');
                $data['img'] = $image;
                if($link){
                    $data[$link] = $id;
                }

                $uuid = \DB::table($table)->insertGetId($data);

                $response['uploadName'] = $image;
                $response['success'] = true;
                $response['uuid'] = $uuid;
            }catch (\Exception $e){
                $response['error'] = $e->getMessage();
            }

        }else{
            $response['error'] = "Ошибка при загрузке файла";
        }

        return response()->json($response);
    }

    public function files_list(Request $request)
    {
        $id = $request->request->get('id');
        $table = $request->request->get('table');
        $link = $request->request->get('link', false);

        if($link){
            $items = \DB::table($table)->select(\DB::raw('id as uuid, img as name'))->where($link, $id)->get();
        }else{
            $items = \DB::table($table)->select(\DB::raw('id as uuid, img as name'))->get();
        }

        foreach ($items as $item) {
            $item->thumbnailUrl = getImagePath($item->name, 120, 80);
        }

        return response()->json($items);
    }

    public function destroy($id, Request $request)
    {
        $table = $request->query->get('table');
        $item = \DB::table($table)->find($id);
        \Storage::delete($item->img);
        \DB::table($table)->delete($id);

        return response()->json(['success' => true]);
    }
}
