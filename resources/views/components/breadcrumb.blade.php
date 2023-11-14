<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach ($collection as $item)
            <li class="breadcrumb-item {{$item->isCurrent ? 'active' : ''}}" aria-current="page">{{$item->nombre}}</li>
        @endforeach
    </ol>
</nav>
