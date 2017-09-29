<?php
namespace Modules\Core\Forms\Fields;

use Illuminate\Http\UploadedFile;
use Kris\LaravelFormBuilder\Fields\FormField;

class ImageType extends FormField
{

    /**
     * Get the template, can be config variable or view path.
     *
     * @return string
     */
    protected function getTemplate()
    {
        return 'image';
    }

    public function getType()
    {
        return 'file';
    }

    public function getDefaults()
    {
        return [
            'attr' => [
                'class' => '',
            ],
            'rules' => 'mimes:jpg,jpeg,png,gif',
        ];
    }

    public function alterFieldValues(&$value)
    {
        $request = $this->parent->getRequest()->all();
        $name = $this->getNameKey();

        if($value instanceof UploadedFile){
            $value = $this->uploadFile($value);
            $this->deleteOldFile(array_get($request, $name.'_old', ''));
        }else{
            if(array_has($request, $name.'_del')){
                $this->deleteOldFile(array_get($request, $name.'_old', ''));
                $value = null;
            }else{
                $value = array_get($request, $name.'_old', null);
            }
        }
    }

    protected function uploadFile(UploadedFile $file)
    {
       return $file->store('/images');
    }

    protected function deleteOldFile($file_path = ''){
        if($file_path){
            \Storage::delete($file_path);
        }
    }

}