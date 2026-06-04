{{-- ===================== CONTACT ===================== --}}
<section class="contact" id="contact">
    <div class="contact__inner">
        <div class="contact__info">
            {{-- Contact title --}}
            <h2 class="contact__title">{{ $siteSettings['contact_title'] ?? 'Want to work together? Let\'s Chat!' }}
            </h2>
            <p class="contact__description">
                {{ $siteSettings['contact_description'] ?? 'Have a project in mind or just want to say hi? Fill out the form and I\'ll get back to you as soon as possible.' }}
            </p>
            <div class="contact__socials">
                <a href="{{ $siteSettings['social_facebook'] ?? '#' }}" class="contact__social" target="_blank"
                    rel="noopener" aria-label="Facebook">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect width="24" height="24" rx="4" fill="#531A24" />
                        <path
                            d="M13.5 8H12c-.6 0-1 .4-1 1v1.5h2.5l-.4 2.5H11V18H8.5v-5H7v-2.5h1.5V9c0-1.9 1.1-3 3-3H13.5V8z"
                            fill="white" />
                    </svg>
                </a>
                <a href="{{ $siteSettings['social_twitter'] ?? '#' }}" class="contact__social" target="_blank"
                    rel="noopener" aria-label="Twitter">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect width="24" height="24" rx="4" fill="#531A24" />
                        <path d="M17.5 6h-2L12 10.5 9 6H6l4.8 6L6 18h2l3.8-4.8L15.2 18H18l-5-6.2L17.5 6z"
                            fill="white" />
                    </svg>
                </a>
                <a href="{{ $siteSettings['social_instagram'] ?? '#' }}" class="contact__social" target="_blank"
                    rel="noopener" aria-label="Instagram">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect width="24" height="24" rx="4" fill="#531A24" />
                        <rect x="6" y="6" width="12" height="12" rx="3" stroke="white" stroke-width="1.5" fill="none" />
                        <circle cx="12" cy="12" r="3" stroke="white" stroke-width="1.5" fill="none" />
                        <circle cx="16" cy="8" r="1" fill="white" />
                    </svg>
                </a>
                <a href="{{ $siteSettings['social_linkedin'] ?? '#' }}" class="contact__social" target="_blank"
                    rel="noopener" aria-label="LinkedIn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect width="24" height="24" rx="4" fill="#531A24" />
                        <rect x="6" y="10" width="2.5" height="7" fill="white" />
                        <circle cx="7.25" cy="7.5" r="1.25" fill="white" />
                        <path
                            d="M11 10v7h2.5v-3.75c0-1 .5-1.75 1.5-1.75s1.5.75 1.5 1.75V17H19v-4c0-2-1-3-2.75-3-1 0-1.75.5-2.25 1.25V10H11z"
                            fill="white" />
                    </svg>
                </a>
                <a href="{{ $siteSettings['social_github'] ?? '#' }}" class="contact__social" target="_blank"
                    rel="noopener" aria-label="GitHub">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect width="24" height="24" rx="4" fill="#531A24" />
                        <path
                            d="M12 4C7.58 4 4 7.58 4 12c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38v-1.33c-2.23.48-2.7-1.07-2.7-1.07-.36-.92-.88-1.17-.88-1.17-.72-.49.05-.48.05-.48.8.06 1.22.82 1.22.82.71 1.21 1.86.86 2.31.66.07-.51.28-.86.5-1.06-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82a7.66 7.66 0 012-.27c0 .68 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48v2.19c0 .21.15.46.55.38A8.01 8.01 0 0020 12c0-4.42-3.58-8-8-8z"
                            fill="white" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="contact__form-wrap">
            <form class="contact__form" action="{{ route('contact.store') }}" method="POST">
                @csrf
                <input type="hidden" name="redirect_to" value="{{ $redirectTo ?? 'home' }}" />
                <div class="contact__form-row">
                    <div class="form-group">
                        <label class="form-group__label" for="contact_name">Name</label>
                        <input class="form-group__input" type="text" id="contact_name" name="name"
                            placeholder="Brian Clark" />
                    </div>
                    <div class="form-group">
                        <label class="form-group__label" for="contact_email">Email</label>
                        <input class="form-group__input" type="email" id="contact_email" name="email"
                            placeholder="example@youremail.com" />
                    </div>
                </div>
                <div class="contact__form-row">
                    <div class="form-group">
                        <label class="form-group__label" for="contact_phone">Phone</label>
                        <input class="form-group__input" type="tel" id="contact_phone" name="phone"
                            placeholder="(123) 456 - 7890" />
                    </div>
                    <div class="form-group">
                        <label class="form-group__label" for="contact_company">Company</label>
                        <input class="form-group__input" type="text" id="contact_company" name="company"
                            placeholder="" />
                    </div>
                </div>
                <div class="form-group form-group--full">
                    <label class="form-group__label" for="contact_message">Message</label>
                    <textarea class="form-group__textarea" id="contact_message" name="message"
                        placeholder="Type your message here..."></textarea>
                </div>
                <button type="submit" class="btn btn--primary btn--arrow">
                    Send message
                    <span class="btn__arrow">›</span>
                </button>
            </form>
        </div>
    </div>
</section>

{{-- ===================== NEWSLETTER / CTA ===================== --}}
<section class="newsletter">
    <div class="blob-field"><span></span><span></span><span></span><span></span></div>
    <div class="newsletter__inner">
        <div class="newsletter__content">
            {{-- Newsletter --}}
            <h2 class="newsletter__title">
                {{ $siteSettings['newsletter_title'] ?? 'Excited to work together on your next project?' }}</h2>
            <p class="newsletter__description">
                {{ $siteSettings['newsletter_description'] ?? 'Whether it\'s a UI redesign, a new website, or an SEO strategy — let\'s build something great together.' }}
            </p>
            {{-- <div class="newsletter__subscribe">
                <input type="email" class="newsletter__input" placeholder="Enter your email address" />
                <button class="newsletter__btn">Subscribe</button>
            </div> --}}
        </div>

        <div class="newsletter__gallery">
            {{-- Left column scrolls UP --}}
            <div class="newsletter__col-wrap">
                <div class="newsletter__col newsletter__col--up" id="galleryColLeft">
                    <div class="newsletter__photo"><img src="{{ asset('images/moana.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/MCBuilders.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/MCTech.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/rwa.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/tuc.png') }}" alt="" /></div>
                    {{-- duplicates for seamless loop --}}
                    <div class="newsletter__photo"><img src="{{ asset('images/MCBuilders.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/moana.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/MCTech.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/rwa.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/tuc.png') }}" alt="" /></div>
                </div>
            </div>
            {{-- Right column scrolls DOWN --}}
            <div class="newsletter__col-wrap">
                <div class="newsletter__col newsletter__col--down" id="galleryColRight">
                    <div class="newsletter__photo"><img src="{{ asset('images/RWA2.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/MCSouth.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/moana.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/lazychimp.png') }}" alt="" /></div>
                    {{-- duplicates for seamless loop --}}
                    <div class="newsletter__photo"><img src="{{ asset('images/RWA2.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/MCSouth.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/moana.png') }}" alt="" /></div>
                    <div class="newsletter__photo"><img src="{{ asset('images/lazychimp.png') }}" alt="" /></div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        /* ── GALLERY AUTO-SCROLL ── */
        (function () {
            const colUp = document.getElementById('galleryColLeft');
            const colDown = document.getElementById('galleryColRight');
            if (!colUp || !colDown) return;

            const SPEED = 0.6;
            let posUp = 0, posDown = 0;

            function getHalfHeight(el) { return el.scrollHeight / 2; }

            function tickGallery() {
                const halfUp = getHalfHeight(colUp);
                const halfDown = getHalfHeight(colDown);

                posUp += SPEED;
                if (posUp >= halfUp) posUp = 0;
                colUp.style.transform = `translateY(-${posUp}px)`;

                posDown -= SPEED;
                if (posDown <= -halfDown) posDown = 0;
                colDown.style.transform = `translateY(${posDown}px)`;

                requestAnimationFrame(tickGallery);
            }

            requestAnimationFrame(tickGallery);
        })();

        /* ── SWEETALERT ON SUCCESS ── */
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Message Sent!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#531A24',
                background: '#F2E8D9',
                color: '#531A24',
                confirmButtonText: 'Great!',
                borderRadius: '12px',
            });
        @endif
    </script>
@endpush
