<a href="{{route('shop-cart-list')}}" class="fixed bottom-0 right-0 m-5">

    <div class="bg-red-500 rounded-full w-5 h-5 text-white text-sm text-center shadow absolute -top-2 -right-1">
        {{$total}}
    </div>

    <div class="p-2 bg-purple-500 rounded-full shadow w-10 h-10 border-purple-800 border-2">
        <svg fill="#FFF" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
            <path
                d="M10 19.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm3.5-1.5c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm1.336-5l1.977-7h-16.813l2.938 7h11.898zm4.969-10l-3.432 12h-12.597l.839 2h13.239l3.474-12h1.929l.743-2h-4.195z" />
        </svg>
    </div>
</a>