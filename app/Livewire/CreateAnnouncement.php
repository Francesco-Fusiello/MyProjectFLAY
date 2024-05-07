<?php

namespace App\Livewire;

use App\Jobs\Watermark;
use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Announcement;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CreateAnnouncement extends Component
{
    use WithFileUploads;
    
    public $message;
    public $validated;
    public $temporary_images;
    public $images = [];
    public $image;
    public $annoncement;

    #[Validate('required', )]
    #[Validate('max:50',)] 
    public $title;
    #[Validate('required',)]
    #[Validate('max:300',)]  
    public $body;
    #[Validate('required',)] 
    public $price;
    #[Validate('required',)]
    public $category_id;


    protected $rules= [
        // 'title'=>'required|min:4',
        // 'body'=>'required|min:8',
        // 'category_id'=>'required',
        'images.*'=>'image|max:1024',
        'temporary_images.*'=>'image|max:1024',
    ];

    protected $messages =[
        // 'required'=>'Il campo :attribute è richiesto',
        // 'min'=>'Il campo :attribute è troppo corto',
        'temporary_images.required'=>"L'immagine è richiesta",
        'temporary_images.*.image'=>'I file devono essere immagini',
        'temporary_images.*.max'=>"L'immagine dev'essere massimo di 1mb",
        'images.image'=> "L'immagine dev'essere un'immagine",
        'images.max'=> "L'immagine dev'essere massimo di 1mb",
    ];

    public function updatedTemporaryImages()
    {
        if($this->validate([
            'temporary_images.*'=>'image|max:1024',
        ])){
            foreach ($this->temporary_images as $image){
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))){
            unset($this->images[$key]);
        }
    }
    

    public function store(){

        $this->validate();
        
        // $this->announcement = Category::find($this->category_id)->announcements()->create($this->validate());

        $announcement = Announcement::create([
            'title'=>$this->title,
            'body'=>$this->body,
            'price'=>$this->price,
            'category_id'=>$this->category_id,
            'user_id'=>Auth::user()->id
        ]);

        if(count($this->images)){
            foreach ($this->images as $image) {
                // $announcement->images()->create(['path'=>$image->store('images','public')]);
                $newFileName = "announcements/{$announcement->id}";
                $newImage = $announcement->images()->create(['path'=>$image->store($newFileName,'public')]);

                RemoveFaces::withChain([
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id),
                    new Watermark($newImage->id, $newImage->path, 256, 256),
                    new ResizeImage($newImage->path , 256 , 256),

                    
                ])->dispatch($newImage->id);
            }

            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        // $this->reset();
        session()->flash('success', '');
        $this->cleanForm();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function cleanForm()
    {
        $this->title = '';
        $this->body='';
        $this->price='';
        $this->category_id='';
        $this->images=[];
        $this->temporary_images=[];
    }


    public function render()
    {
        return view('livewire.create-announcement');
    }
}
