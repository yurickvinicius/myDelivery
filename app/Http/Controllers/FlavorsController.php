<?php

namespace myDelivery\Http\Controllers;

use Illuminate\Http\Request;
use myDelivery\Http\Requests;
use myDelivery\Models\Flavor;
use myDelivery\Models\FlavorImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use myDelivery\Http\Requests\FlavorImageRequest;
use myDelivery\Http\Requests\AdminFlavorRequest;
use myDelivery\Models\Order;

class FlavorsController extends Controller {

    private $flavorModel;
    private $flavorImageModel;

    public function __construct(Flavor $flavor, FlavorImage $flavorImage) {
        $this->flavorModel = $flavor;
        $this->flavorImageModel = $flavorImage;
        view()->share('totalOrders', Order::totalOrdersWaiting());
    }

    public function index() {
        $flavors = $this->flavorModel->where('in_use','<>','n')->orderBy('id', 'desc')->paginate();
        return view('admin.flavors.index', compact('flavors'));
    }

    public function create() {
        return view('admin.flavors.create');
    }

    public function store(AdminFlavorRequest $request) {
        $data = $request->all();                
        
        if($data['price'] == '')
            $data['price'] = 0.0;
        
        $this->flavorModel->create($data);

        return redirect()->route('admin.flavors.index');
    }

    public function edit($id) {
        $flavor = $this->flavorModel->find($id);
        return view('admin.flavors.edit', compact('flavor'));
    }

    public function update(AdminFlavorRequest $request, $id) {
        $data = $request->all();
        $this->flavorModel->find($id)->update($data);

        return redirect()->route('admin.flavors.index');
    }

    public function destroy($id) {
        $this->flavorModel
            ->find($id)
            ->update(
                [
                    'in_use' => 'n',
                ]
            );

        $flavor = $this->flavorModel->find($id);

        $flavorImages = $flavor->images;

        foreach ($flavorImages as $image) {
            $flavorImage = new $this->flavorImageModel();
            $this->destroyImage($flavorImage, $image->id);
        }

        $message = 'Sabor removida com sucesso!';
        return redirect()->route('admin.flavors.index')->withMessageSuccess($message);

        /*
        $flavor = $this->flavorModel->find($id);

        $flavorImages = $flavor->images;

        foreach ($flavorImages as $image) {
            $flavorImage = new $this->flavorImageModel();
            $this->destroyImage($flavorImage, $image->id);
        }

        $this->flavorModel->find($id)->delete();
        return redirect()->route('admin.flavors.index');
        */
    }

    public function images($id) {
        $flavor = $this->flavorModel->find($id);

        return view('admin.flavors.images', compact('flavor'));
    }

    public function createImage($id) {
        $flavor = $this->flavorModel->find($id);

        return view('admin.flavors.create_image', compact('flavor'));
    }

    public function storeImage(FlavorImageRequest $request, $id, FlavorImage $flavorImage) {
        $file = $request->file('image');

        $extension = $file->getClientOriginalExtension();

        $image = $flavorImage::create(['flavor_id' => $id, 'extension' => $extension]);

        Storage::disk('public_local')->put($image->id . '.' . $extension, File::get($file));

        return redirect()->route('admin.flavors.images', ['id' => $id]);
    }

    public function destroyImage(FlavorImage $flavorImage, $id) {
        $image = $flavorImage->find($id);
        Storage::disk('public_local')->delete($image->id . '.' . $image->extension);

        $flavor = $image->flavor;
        $image->delete();

        return redirect()->route('admin.flavors.images', ['id' => $image->flavor->id]);
    }

    public function showJson($cod) {

        $flavor = $this->flavorModel->where('id', $cod)->get();

        if(count($flavor) > 0)
            echo json_encode($flavor);
        else
            echo json_encode("error");
    }

}
