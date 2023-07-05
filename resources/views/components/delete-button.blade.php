@props(['deleteRoute'])
<form action="{{$deleteRoute}}" method="POST">
    @csrf
    @method("DELETE")
    <button type="submit" {{ $attributes->merge([
        'class' => 'btn btn-danger'
        ]) }}
    >
        <i class="bi bi-trash"></i>
        {{ $slot }}
    </button>
</form>