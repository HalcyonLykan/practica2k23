<x-guest-layout>
    <div class="container-fluid mx-2">
        <form action="{{route("categories.update", ["id" => $category->id])}}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="nameInput" class="form-label">Name</label>
              <input type="text" class="form-control" id="nameInput" name="name" value="{{$category->name}}">
            </div>
            <div class="mb-3">
              <label for="descriptionInput" class="form-label">Description</label>
              <input type="text" class="form-control" id="descriptionInput" name="description" value="{{$category->description}}">
            </div>
            <button type="submit" class="btn btn-danger bg-black">Submit</button>
        </form>
    </div>
</x-guest-layout>