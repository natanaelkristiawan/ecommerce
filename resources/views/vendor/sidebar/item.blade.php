<li class="nav-item @if($item->getItemClass()){{ $item->getItemClass() }}@endif">
    <a href="@if($item->hasItems())#@endif{{ $item->getUrl() }}" class="@if($active)active @endif nav-link" @if($item->hasItems()) data-toggle="collapse" role="button" @if($active) aria-expanded="true" @else aria-expanded="false" @endif" @endif>
        <i class="{{ $item->getIcon() }}"></i>
        <span class="nav-link-text">{{ $item->getName() }}</span>
    </a>

    @if(count($items) > 0)
        <div class="collapse @if($active)show @endif" id="{{ $item->getUrl() }}">
            <ul class="nav nav-sm flex-column">
                @foreach($items as $item)
                    {!! $item !!}
                @endforeach
            </ul>
        </div>
    @endif
</li>