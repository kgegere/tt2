<x-layout>
    <x-slot name="title">
        {{ $listing->title }}
    </x-slot>
    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <a href="#" onclick="window.history.back(); return false;" class="text-decoration-none text-secondary d-inline-flex align-items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                    </svg>
                    {{ __('messages.back')}}
                </a>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        @if (str_contains(strtolower($error), 'captcha'))
                        <li>{!! __('validation.captcha_error') !!}</li>
                        @else
                        <li>{!! $error !!}</li>
                        @endif
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('messages.close')}}"></button>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm mb-5">
                    <div class="row g-0">
                        @if($listing->image)
                        <div class="col-md-5 col-12">
                            <img
                                src="{{ url('images/' . $listing->image) }}"
                                class="img-fluid rounded p-3 h-100 w-100 listing-image"
                                alt="{{ $listing->title }}"
                                style="object-fit: cover; width: 400px; cursor: pointer;"
                                id="listingImage">
                        </div>
                        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" style="pointer-events: none;">
                                <div class="modal-content bg-transparent border-0" style="pointer-events: auto;">
                                    <div class="modal-body p-0 d-flex justify-content-center align-items-center" style="min-height: 90vh;">
                                        <div class="position-relative d-inline-block" style="pointer-events: auto;">
                                            <button type="button"
                                                class="btn-close position-absolute top-0 end-0 m-2 p-0 d-flex justify-content-center align-items-center"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                                style="width: 40px; height: 40px; border-radius: 50%; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.15); z-index: 1051;">
                                                <span aria-hidden="true" style="font-size: 2.5rem; line-height: 1;">&times;</span>
                                            </button>
                                            <img
                                                src="{{ url('images/' . $listing->image) }}"
                                                class="img-fluid rounded shadow-lg animate-enlarge"
                                                alt="{{ $listing->title }}"
                                                style="max-width: 98vw; max-height: 90vh; width: auto; height: auto; object-fit: contain; pointer-events: auto;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @push('styles')
                        <style>
                            .animate-enlarge {
                                animation: enlarge 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                            }

                            @keyframes enlarge {
                                from {
                                    transform: scale(0.7);
                                    opacity: 0.5;
                                }

                                to {
                                    transform: scale(1);
                                    opacity: 1;
                                }
                            }
                        </style>
                        @endpush
                        @push('scripts')
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var img = document.getElementById('listingImage');
                                var modalEl = document.getElementById('imageModal');
                                var modal = new bootstrap.Modal(modalEl);
                                var modalImg = modalEl.querySelector('img');
                                var modalBody = modalEl.querySelector('.modal-body');

                                img.addEventListener('click', function() {
                                    modal.show();
                                });

                                modalBody.addEventListener('click', function(e) {
                                    if (e.target === modalBody) {
                                        modal.hide();
                                    }
                                });
                            });
                        </script>
                        @endpush
                        @endif
                        <div class="{{ $listing->image ? 'col-md-7 col-12' : 'col-12' }}">
                            <div class="card-body px-4 py-4 h-100 d-flex flex-column justify-content-center">
                                <h2 class="card-title mb-3">{{ $listing->title }}</h2>
                                <p class="card-text mb-4">{{ $listing->description }}</p>
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-2"><strong>{{ __('messages.category') }}:</strong> {{ $listing->category->name ?? __('messages.uncategorized') }}</li>
                                    <li class="mb-2"><strong>{{ __('messages.price') }}:</strong> ${{ number_format($listing->price, 2) }}</li>
                                    <li class="mb-2"><strong>{{ __('messages.posted_by') }}:</strong> {{ $listing->user->name ?? __('messages.unknown') }}</li>
                                    <li class="mb-2"><strong>{{ __('messages.posted') }}:</strong> {{ $listing->created_at?->diffForHumans() }}</li>
                                    <li><strong>{{ __('messages.status') }}:</strong> {{ $listing->is_purchased ? __('messages.purchased') : __('messages.available') }}</li>
                                    @auth
                                        @php
                                            $user = auth()->user();
                                            $isSeller = $listing->user_id === $user->id;
                                            $isBuyer = $listing->firstPurchase && $listing->firstPurchase->user_id === $user->id;
                                            $isAdmin = $user->isAdmin();
                                        @endphp

                                        @if(($isSeller || $isBuyer || $isAdmin) && $listing->firstPurchase)
                                        <li class="mt-2"><strong>{{ __('messages.purchased_by') }}:</strong> {{ $listing->firstPurchase->user->name ?? __('messages.unknown') }}</li>
                                        @endif
                                    @endauth
                                </ul>
                                <div class="d-flex gap-2 flex-wrap">
                                    @auth
                                    @if(!$listing->is_purchased)
                                    <button type="button" class="btn btn-success" id="buyNowBtn">
                                        {{ __('messages.buy_now') }}
                                    </button>
                                    @endif
                                    @endauth
                                    @can('update', $listing)
                                    <a href="{{ route('listing.edit', $listing->id) }}" class="btn btn-warning">{{__('messages.edit')}}</a>
                                    @endcan
                                    @can('delete', $listing)
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        {{ __('messages.delete') }}
                                    </button>

                                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">{{ __('messages.confirm_delete_listing') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{ route('listing.destroy', $listing->id) }}" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">{{ __('messages.delete') }}</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="buyModalLabel">{{ __('messages.confirm_purchase') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ __('messages.captcha_required') }}</p>
                                        <form id="purchaseForm" method="POST" action="{{ route('listing.purchase', $listing->id) }}">
                                            <div class="mb-3">
                                                {!! NoCaptcha::display(['data-callback' => 'onCaptchaSuccess']) !!}
                                                <div class="text-danger small" style="display: none;" id="huina">{{ __('validation.captcha_error') }}</div>
                                            </div>
                                            @csrf
                                            <button type="submit" class="btn btn-primary w-100" id="confirmPurchaseBtn" disabled>{{ __('messages.confirm_purchase') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @push('scripts')
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var buyBtn = document.getElementById('buyNowBtn');
                                var buyModalEl = document.getElementById('buyModal');
                                if (buyBtn && buyModalEl) {
                                    var buyModal = new bootstrap.Modal(buyModalEl);
                                    buyBtn.addEventListener('click', function() {
                                        buyModal.show();
                                    });
                                }
                                // Disable the confirm button until captcha is solved
                                var confirmBtn = document.getElementById('confirmPurchaseBtn');
                                if (confirmBtn) {
                                    confirmBtn.disabled = true;
                                    window.onCaptchaSuccess = function() {
                                        confirmBtn.disabled = false;
                                    };
                                    buyModalEl.addEventListener('show.bs.modal', function() {
                                        confirmBtn.disabled = true;
                                    });
                                }
                                document.getElementById('purchaseForm').addEventListener('submit', function(e) {
                                    var captchaResponse = grecaptcha.getResponse();
                                    var huina = document.getElementById('huina');
                                    if (!captchaResponse) {
                                        e.preventDefault();
                                        huina.style.display = 'block';
                                    } else {
                                        huina.style.display = 'none';
                                    }
                                });
                            });
                        </script>
                        @endpush
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stack('scripts')
    {!! NoCaptcha::renderJs() !!}
</x-layout>