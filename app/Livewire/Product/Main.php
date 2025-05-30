<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Main extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $modal_status = false;
    public $name;
    public $sku;
    public $image;
    public $is_active = false;
    public $price;
    public $stock;
    public $product;
    public $order_by_asc = null;


    protected $rules = [
        'name' => 'required|string|max:255',
        'sku' => 'required|string|max:255',
        'is_active' => 'boolean',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|url', // validação do link da imagem
    ];

    protected $messages = [
        'name.required' => 'O nome do produto é obrigatório.',
        'sku.required' => 'O SKU do produto é obrigatório.',
        'price.required' => 'O preço do produto é obrigatório.',
        'stock.required' => 'O estoque do produto é obrigatório.',
        'image.url' => 'A imagem deve ser um link válido.',
    ];

    #[On('toggle-modal')]
    public function toggleModal($id = null)
    {
        $this->modal_status = !$this->modal_status;

        if($id){
            $this->getProduct($id);
        }

        if (!$this->modal_status) {
            $this->reset('name', 'sku', 'image', 'is_active', 'price', 'stock', 'product', 'image');
        }
    }


    public function create()
    {
        $this->validate();

        $product =  Product::create([
            'user_id' => auth()->id(),
            'name' => $this->name,
            'sku' => $this->sku,
            'image' => $this->image,
            'is_active' => $this->is_active,
            'price' => $this->price,
            'stock' => $this->stock,
        ]);

        if ($product) {
            $this->toggleModal();
            session()->flash('message', 'Produto criado com sucesso!');
        }
    }

    public function edit()
    {
        $validated = $this->validate();

        $updated = $this->product->update($validated);

        if($updated){
            session()->flash('message', 'Produto atualizado com sucesso!');

            $this->toggleModal();
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            session()->flash('message', 'Produto excluído com sucesso!');
        }
    }

    public function submit()
    {
        $this->product ? $this->edit() : $this->create();
    }

    public function getProduct($id)
    {
        $this->product = Product::find($id);

        if($this->product){
            $this->name = $this->product->name;
            $this->sku = $this->product->sku;
            $this->stock = $this->product->stock;
            $this->price = $this->product->price;
            $this->is_active = (bool)$this->product->is_active;
            $this->image = $this->product->image;
        }
    }

    #[Computed]
    public function products()
    {
        $query = Product::query();
        if($this->search){
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('sku', 'like', '%' . $this->search . '%');

        }

        if($this->order_by_asc !== null){
            $query->orderBy('name', $this->order_by_asc ? 'asc' : 'desc');
        }

        $query->orderBy('created_at', 'desc');
        return $query->paginate(6);
    }

    public function clearMessage()
    {
        session()->forget('message');
    }

    public function render()
    {
        return view('livewire.product.main');
    }
}
