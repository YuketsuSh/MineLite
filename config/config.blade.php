@extends('admin.layouts.admin')

@section('title', 'Configuration du thème MineLite')

@push('footer-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".config-category").forEach(button => {
                button.addEventListener("click", function() {
                    const target = this.getAttribute("data-target");
                    document.querySelectorAll(".config-section").forEach(section => {
                        section.style.display = "none";
                    });
                    document.getElementById(target).style.display = "block";
                    document.querySelectorAll(".config-category").forEach(btn => btn.classList.remove("active"));
                    this.classList.add("active");
                });
            });

            document.querySelector(".config-category.active").click();

            function setupRemoveButtons() {
                document.querySelectorAll('.remove-item').forEach(button => {
                    button.addEventListener('click', function() {
                        this.closest('.card').remove();
                    });
                });
            }

            const footerLinkGroups = ['footer_links1', 'footer_links2', 'footer_links3'];

            footerLinkGroups.forEach(group => {
                const button = document.getElementById(`addLinkButton-${group}`);
                const container = document.getElementById(`links-${group}`);

                if (button && container) {
                    button.addEventListener('click', function() {
                        const index = container.querySelectorAll('.link-item').length;
                        const item = document.createElement('div');
                        item.className = 'link-item card mb-3';
                        item.innerHTML = `
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="${group}[${index}][name]" placeholder="Nom du lien">
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="url" class="form-control" name="${group}[${index}][value]" placeholder="URL">
                                    <button class="btn btn-outline-danger remove-item" type="button">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                        container.appendChild(item);
                        setupRemoveButtons();
                    });
                }
            });

            setupRemoveButtons();

            document.getElementById('configForm').addEventListener('submit', function() {
                footerLinkGroups.forEach(group => {
                    const container = document.getElementById(`links-${group}`);
                    if (container) {
                        container.querySelectorAll('.link-item').forEach((item, index) => {
                            item.querySelectorAll('[name]').forEach(input => {
                                input.name = input.name.replace(/\[\d+\]/g, `[${index}]`);
                            });
                        });
                    }
                });
            });
        });
    </script>
@endpush

@section('content')
    <div class="d-flex">
        <div class="card shadow-sm me-4 p-3" style="width: 250px;">
            <h5 class="mb-3">Catégories</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <button class="btn btn-link config-category active" data-target="hero-config">
                        <i class="bi bi-house-door me-2"></i> HomePage
                    </button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-link config-category" data-target="social-config">
                        <i class="bi bi-people me-2"></i> CTA
                    </button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-link config-category" data-target="footer-config">
                        <i class="bi bi-layout-text-sidebar-reverse me-2"></i> Footer
                    </button>
                </li>
            </ul>
        </div>

        <div class="card shadow p-4 flex-grow-1">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST" id="configForm">
                @csrf

                <div id="hero-config" class="config-section">
                    <h2 class="mb-4"><i class="bi bi-house-door me-2"></i> Configuration de la HomePage</h2>

                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0 text-dark">Section Principale (Hero)</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Titre principal</label>
                                    <input type="text" class="form-control" name="hero_title" value="{{ old('hero_title', theme_config('hero_title')) }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Titre principal</label>
                                    <input type="text" class="form-control" name="hero_subtitle" value="{{ old('hero_subtitle', theme_config('hero_subtitle')) }}">
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Boutons d'action</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Bouton 1 - Texte</label>
                                    <input type="text" class="form-control" name="hero_button1" value="{{ old('hero_button1', theme_config('hero_button1')) }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bouton 1 - Icône</label>
                                    <input type="text" class="form-control" name="hero_button1_fav" value="{{ old('hero_button1_fav', theme_config('hero_button1_fav')) }}" placeholder="Ex: bi bi-shop">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bouton 1 - Lien</label>
                                    <input type="url" class="form-control" name="hero_button1_url" value="{{ old('hero_button1_url', theme_config('hero_button1_url')) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="social-config" class="config-section">
                    <h2 class="mb-4"><i class="bi bi-house-door me-2"></i> Configuration du CTA</h2>

                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0 text-dark">Configuration du CTA</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Titre principal</label>
                                    <input type="text" class="form-control" name="hero_title" value="{{ old('cta_title', theme_config('cta_title')) }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Sous-Titre</label>
                                    <input type="text" class="form-control" name="cta_subtitle" value="{{ old('cta_subtitle', theme_config('cta_subtitle')) }}">
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Boutons d'action</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Bouton 1 - Texte</label>
                                    <input type="text" class="form-control" name="cta_button1" value="{{ old('cta_button1', theme_config('cta_button1')) }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bouton 1 - Icône</label>
                                    <input type="text" class="form-control" name="cta_button1_fav" value="{{ old('cta_button1_fav', theme_config('cta_button1_fav')) }}" placeholder="Ex: bi bi-shop">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bouton 1 - Lien</label>
                                    <input type="url" class="form-control" name="cta_button1_url" value="{{ old('cta_button1_url', theme_config('cta_button1_url')) }}">
                                </div>
                            </div>
                            <div class="row g-3 mt-1">
                                <div class="col-md-4">
                                    <label class="form-label">Bouton 2 - Texte</label>
                                    <input type="text" class="form-control" name="cta_button1" value="{{ old('cta_button2', theme_config('cta_button2')) }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bouton 2 - Icône</label>
                                    <input type="text" class="form-control" name="cta_button2_fav" value="{{ old('cta_button2_fav', theme_config('cta_button2_fav')) }}" placeholder="Ex: bi bi-shop">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bouton 2 - Lien</label>
                                    <input type="url" class="form-control" name="cta_button2_url" value="{{ old('cta_button2_url', theme_config('cta_button2_url')) }}">
                                </div>
                            </div>
                            <div class="row g-3 mt-1">
                                <div class="col-md-4">
                                    <label class="form-label">Bouton 3 - Texte</label>
                                    <input type="text" class="form-control" name="cta_button3" value="{{ old('cta_button3', theme_config('cta_button3')) }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bouton 3 - Icône</label>
                                    <input type="text" class="form-control" name="cta_button3_fav" value="{{ old('cta_button3_fav', theme_config('cta_button3_fav')) }}" placeholder="Ex: bi bi-shop">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bouton 3 - Lien</label>
                                    <input type="url" class="form-control" name="cta_button3_url" value="{{ old('cta_button3_url', theme_config('cta_button3_url')) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="footer-config" class="config-section" style="display:none;">
                    <h2 class="mb-4"><i class="bi bi-layout-text-sidebar-reverse me-2"></i> Configuration du Footer</h2>

                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0 text-dark">Contenu principal</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control @error('footer_description') is-invalid @enderror" name="footer_description" rows="3">{{ old('footer_description', theme_config('footer_description')) }}</textarea>
                                @error('footer_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0 text-dark">Liens rapides</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Titre de la colonne 1</label>
                                    <input type="text" class="form-control" name="footer_titlelinks1" value="{{ old('footer_titlelinks1', theme_config('footer_titlelinks1')) }}">

                                    <div id="links-footer_links1" class="mt-3">
                                        @foreach(theme_config('footer_links1') ?? [] as $index => $link)
                                            <div class="link-item card mb-3">
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="footer_links1[{{ $index }}][name]" value="{{ $link['name'] }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <input type="url" class="form-control" name="footer_links1[{{ $index }}][value]" value="{{ $link['value'] }}">
                                                                <button class="btn btn-outline-danger remove-item" type="button">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button type="button" id="addLinkButton-footer_links1" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-plus me-2"></i>Ajouter un lien
                                    </button>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Titre de la colonne 2</label>
                                    <input type="text" class="form-control" name="footer_titlelinks2" value="{{ old('footer_titlelinks2', theme_config('footer_titlelinks2')) }}">

                                    <div id="links-footer_links2" class="mt-3">
                                        @foreach(theme_config('footer_links2') ?? [] as $index => $link)
                                            <div class="link-item card mb-3">
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" name="footer_links2[{{ $index }}][name]" value="{{ $link['name'] }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <input type="url" class="form-control" name="footer_links2[{{ $index }}][value]" value="{{ $link['value'] }}">
                                                                <button class="btn btn-outline-danger remove-item" type="button">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button type="button" id="addLinkButton-footer_links2" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-plus me-2"></i>Ajouter un lien
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0 text-dark">Serveur Version</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Version (ex: 1.8 - 1.20)</label>
                                    <input type="text" class="form-control" name="footer_server_version" value="{{ old('footer_server_version', theme_config('footer_server_version')) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-4">
                    <i class="bi bi-save me-2"></i>Enregistrer les modifications
                </button>
            </form>
        </div>
    </div>
@endsection
