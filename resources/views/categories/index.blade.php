<x-app-layout>
    <div class="container-fluid mx-2">
        <div class="row">
            <div class="col">
                <h1 class="mb-4 p-3">Categories</h1>
            </div>
            @auth
                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('categories.create') }}"><i class="bi bi-plus-lg"></i></a>
                </div>
            @endauth
        </div>
        <div class="row mb-3">
            <form class="" role="search" method="GET">
                <x-search-field></x-search-field>
                <div class="col-12 col-md-auto mx-auto my-2">
                    <div class="row">
                        <x-order-by-dropdown></x-order-by-dropdown>
                        <x-order-direction-dropdown></x-order-direction-dropdown>
                    </div>
                </div>
            </form>
        </div>
        {{-- tema de creat componenta pentru tabel --}}
        <table class="table table-striped table-striped-columns">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="d-none d-lg-table-cell">Description</th>
                    @auth
                        <th>Actions</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td class="d-none d-lg-table-cell">{{ $category->description }}</td>
                        @auth
                            <td>
                                <div class="row">
                                    <div class="col-auto my-1">
                                        <a class="btn btn-primary"
                                            href="{{ route('categories.edit', ['category' => $category->id]) }}">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="col-auto my-1">
                                        <x-delete-button :deleteRoute="route('categories.destroy', ['category' => $category->id])">
                                        </x-delete-button>
                                    </div>
                                </div>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
