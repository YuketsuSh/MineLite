@include('elements.cta')
<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                @if(site_logo() != null)
                    <img src="{{ site_logo() }}" alt="Server Logo" class="footer-logo mb-3" style="height: 40px;">
                @else
                    <span class="mc-font">{{ site_name() }}</span>
                @endif
                <p>{!! theme_config('footer_description') ?? 'Votre description ici. Personnalisez-la dans les paramètres du thème.' !!}</p>
                <div class="d-flex gap-3 mt-3">
                    @if(count(social_links()) > 0)
                        @foreach(social_links() as $link)
                            <a href="{{ $link->value }}" title="{{ $link->title }}" target="_blank" rel="noopener noreferrer" data-bs-toggle="tooltip" class="rounded-4 d-inline-block p-1 mx-1" style="background: {{ $link->color }}">
                                <i class="{{ $link->icon }} text-white fs-6 mx-1"></i>
                            </a>
                        @endforeach
                    @else
                        <li >Aucun réseau social configuré.</li>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <h5 class="mb-3">{{theme_config('footer_titlelinks1') ?? "Titre lien 1"}}</h5>
                <ul class="list-unstyled footer-links">
                    @if(theme_config('footer_links1') && count(theme_config('footer_links1')) > 0)
                        @foreach(theme_config('footer_links1') as $link)
                            <li class="mb-2">
                                <a href="{{ $link['value'] }}">
                                    {{ $link['name'] }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li class="mb-2">Aucun lien configuré.</li>
                    @endif
                </ul>
            </div>
            <div class="col-lg-2 col-md-4">
                <h5 class="mb-3">{{theme_config('footer_titlelinks2') ?? "Titre lien 2"}}</h5>
                <ul class="list-unstyled footer-links">
                    @if(theme_config('footer_links2') && count(theme_config('footer_links2')) > 0)
                        @foreach(theme_config('footer_links2') as $link)
                            <li class="mb-2">
                                <a href="{{ $link['value'] }}">
                                    {{ $link['name'] }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li class="mb-2">Aucun lien configuré.</li>
                    @endif
                </ul>
            </div>
            @php
                $defaultServerId = (int) setting('servers.default');
                $server = $servers->firstWhere('id', $defaultServerId);
            @endphp
            @if($server)
                @php $isOnline = $server->isOnline(); @endphp

                <div class="col-lg-4 col-md-4">
                    <h5 class="mb-3">Rejoindre</h5>
                    @unless($server->joinUrl())
                    <p class="mb-3">IP du serveur:</p>
                    <div class="server-ip d-inline-block mb-3">{{ $server->fullAddress() }}</div>
                    @endunless

                    @if($server->joinUrl())
                        <a href="{{ $server->joinUrl() }}" class="btn btn-primary mb-2"> Rejoindre</a>
                    @endif

                    <p class="mb-2">Version: {{theme_config('footer_server_version') ?? "1.8 - 1.20"}}</p>
                    <p class="mb-0">@lang('messages.copyright')</p>
                </div>

            @endif
        </div>
        <hr class="my-4 bg-secondary">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">{{ setting('copyright') }}</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="mb-0">Thème by <a href="https://velyorix.com" target="_blank" rel="noreferrer noreferrer">Velyorix</a>.</p>
            </div>
        </div>
    </div>
</footer>
