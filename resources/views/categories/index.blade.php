<x-app-layout>
    <div class="container-fluid mx-2">
        <div class="row">
            <div class="col">
                <h1 class="mb-4 p-3">Categories</h1>
            </div>
            <div class="col-auto">
                <a class="btn btn-primary" href="{{route('categories.create')}}"><i class="bi bi-plus-lg"></i></a>
            </div>
            <div class="col-auto">
                <a class="btn btn-primary" href="{{route('products.index')}}">Products</i></a>
            </div>
        </div>
        <table class="table table-striped table-striped-columns">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>
                        <div class="row">
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{route("categories.edit", ["category" => $category->id])}}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                            <div class="col-auto">
                                <x-delete-button :deleteRoute='route("categories.destroy", ["category" => $category->id])'>
                                </x-delete-button>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>