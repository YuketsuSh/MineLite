<section class="py-5">
    <div class="container py-5">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="mc-font">{{ theme_config('cta_title', 'REJOIGNEZ NOTRE COMMUNAUTÉ') }}</h2>
                <p class="lead">{{ theme_config('cta_subtitle', 'Connectez-vous avec d\'autres joueurs et soutenez notre serveur') }}</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <a href="{{ theme_config('cta_button1_url', '/shop') }}" class="community-btn discord-btn">
                    <i class="{{ theme_config('cta_button1_fav', 'fab fa-discord') }} me-2"></i> {{ theme_config('cta_button1', 'Discord') }}
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ theme_config('cta_button2_url', '/vote') }}" class="community-btn vote-btn">
                    <i class="{{ theme_config('cta_button2_fav', 'fas fa-thumbs-up') }} me-2"></i> {{ theme_config('cta_button2', 'Voter') }}
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ theme_config('cta_button3_url', '/vote') }}" class="community-btn ranking-btn">
                    <i class="{{ theme_config('cta_button3_fav', 'fas fa-trophy') }} me-2"></i> {{ theme_config('cta_button3', 'Classement') }}
                </a>
            </div>
        </div>
    </div>
</section>
