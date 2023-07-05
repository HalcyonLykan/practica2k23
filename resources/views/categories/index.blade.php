<x-guest-layout>
    <div class="container-fluid mx-2">
        <h1 class="mb-4 p-3">Categories</h1>
        <a class="btn btn-primary" href="{{route('categories.create')}}">Create</a>
        <table class="table table-dark table-striped table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>description</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td><a class="btn btn-primary" href="{{route("categories.edit", ["id" => $category->id])}}">Edit</a></td>
                    <td><form action="{{route("categories.delete", ["id" => $category->id])}}" method="POST">@csrf<input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn btn-danger">Delete</button></form></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-guest-layout>