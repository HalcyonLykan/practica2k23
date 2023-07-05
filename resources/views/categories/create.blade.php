<x-guest-layout>
    <div class="container-fluid mx-2">
        <form action="{{route("categories.store")}}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="nameInput" class="form-label">Name</label>
              <input type="text" class="form-control" id="nameInput" name="name" >
            </div>
            <div class="mb-3">
              <label for="descriptionInput" class="form-label">Description</label>
              <input type="text" class="form-control" id="descriptionInput" name="description">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-guest-layout>