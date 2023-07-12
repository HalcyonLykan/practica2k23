<x-guest-layout>
    <div class="container-fluid mx-2">
        <div class="row">
            <div class="col">
                <h1 class="mb-4 p-3">Products</h1>
            </div>
            <div class="col-auto">
                <a class="btn btn-primary" href="{{route('products.create')}}"><i class="bi bi-plus-lg"></i></a>
            </div>
            <div class="col-auto">
                <a class="btn btn-primary" href="{{route('categories.index')}}">Categories</i></a>
            </div>
        </div>
        <table class="table table-striped table-striped-columns">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{route("products.edit", ["product" => $product->id])}}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                            <div class="col-auto">
                                <x-delete-button :deleteRoute='route("products.destroy", ["product" => $product->id])'>
                                </x-delete-button>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-guest-layout>