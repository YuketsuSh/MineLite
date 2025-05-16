@extends('layouts.base')

@section('title', trans('messages.home'))

@section('app')
    <section class="hero-section text-white" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ setting('background') ? image_url(setting('background')) : 'https://placehold.co/2000x500' }}') no-repeat center; background-size: cover">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mc-font mb-4">{{ theme_config('hero_title', 'BIENVENUE SUR NOTRE SERVEUR MINECRAFT') }}</h1>
                    <p class="lead mb-4">{{ theme_config('hero_subtitle', 'Le meilleur serveur communautaire avec des fonctionnalités uniques et une expérience de jeu inoubliable') }}</p>
                    <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                        @php
                            $defaultServerId = (int) setting('servers.default');
                            $server = $servers->firstWhere('id', $defaultServerId);
                        @endphp

                        @if($server)
                            @php $isOnline = $server->isOnline(); @endphp

                            @unless($server->joinUrl())
                                <a class="btn mc-btn btn-lg copy-server-ip" data-server-ip="{{ $server->fullAddress() }}">
                                    <i class="fas fa-gamepad me-2"></i> REJOINDRE <span class="server-ip">{{ $server->fullAddress() }}</span>

                                    <span class="player-count">{{ $isOnline ? $server->getOnlinePlayers() : '0' }}</span>
                                </a>
                            @endunless

                            @if($server->joinUrl())
                                <a href="{{ $server->joinUrl() }}" class="btn mc-btn btn-lg">
                                    <i class="fas fa-gamepad me-2"></i> REJOINDRE

                                    <span class="player-count">{{ $isOnline ? $server->getOnlinePlayers() : '0' }}</span>
                                </a>
                            @endif

                        @endif
                        <a href="{{ theme_config('hero_button1_url', '/shop') }}" class="btn mc-btn-outline btn-lg">
                            <i class="{{ theme_config('hero_button1_fav', 'fab fa-discord') }} me-2"></i> {{ theme_config('hero_button1', 'DISCORD') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mc-font">DERNIERS ARTICLES</h2>
                    <p class="lead">Restez informé des dernières actualités du serveur</p>
                </div>
            </div>

            <div class="row g-4">
                @if ($posts->isEmpty())
                    <p class="lead">Aucune nouveauté disponible.</p>
                @else
                    @foreach($posts->take(6) as $post)
                        <div class="col-md-4">
                            <div class="card article-card h-100">
                                <img src="{{ $post->imageUrl() ?? "https://placehold.co/600x400" }}" class="card-img-top" alt="{{ $post->title }}">
                                <div class="card-body">
                                    <small class="text-muted">{{ $post->author->name }} • {{ format_date($post->published_at) }}</small>
                                    <h5 class="card-title mt-2">{{ $post->title }}</h5>
                                    <p class="card-text">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                                    <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-sm mc-btn">Lire l'article</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            @if (!$posts->isEmpty())
                <div class="text-center mt-4">
                    <a href="{{ route('posts.index') }}" class="btn mc-btn btn-lg">
                        <i class="fas fa-book-open me-2"></i> Voir toutes les actualités
                    </a>
                </div>
            @endif

        </div>
    </section>
@endsection
