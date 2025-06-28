@props(['value'])
<p>
    @if ($value)
        <i class="fa-solid fa-circle-check text-green-500"></i>
    @else
        <i class="fa-solid fa-circle-xmark text-red-500"></i>
    @endif
    {{$slot}}
</p>