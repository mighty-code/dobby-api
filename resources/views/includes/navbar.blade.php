<div class="pos-f-t">
    @guest
    <nav class="navbar navbar-dark bg-transparent p-3">
    </nav>
    @else
    <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
                <h4 class="text-white">Settings</h4>
                <div class="row">
                    @if(!auth()->user()->first_login)
                        <div class="col-12">
                            <span class="text-muted"><a href="{{ route('manage') }}" class="link-unstyled"><i
                                            class="fa fa-code-branch"></i> Connections</a></span>
                        </div>
                        @if($extensionUrl = config('dobby.chrome-extension-url'))
                        <div class="col-12">
                            <span class="text-muted"><a href="{{$extensionUrl}}" target="_blank" class="link-unstyled"><i class="fab fa-chrome"></i> Chrome Extension</a></span>
                        </div>
                        @endif
                        <div class="col-12">
                            <span class="text-muted"><a href="{{ route('api.manage') }}" class="link-unstyled"><i
                                            class="fa fa-puzzle-piece"></i> API</a></span>
                        </div>
                    @endif
                    <div class="col-12">
                        <span class="text-muted">
                            <a class="link-unstyled" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out-alt"></i> Sign out</span>
                        </a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    <nav class="navbar navbar-dark bg-transparent p-3">
        <i class="fa fa-cog pointer" data-toggle="collapse" data-target="#navbarToggleExternalContent"></i>
        <clock></clock>
    </nav>
    @endguest
</div>