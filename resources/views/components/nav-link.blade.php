@props(['active' => false])
<ul class="hidden md:flex space-x-4 xl:space-x-8 pt-1">
    <a class="{{$active ? 'nav-design-active' : 'nav-design'}}" aria-current="{{$active ? 'page' : 'false'}}" {{$attributes}}>{{$slot}}</a>
</ul>