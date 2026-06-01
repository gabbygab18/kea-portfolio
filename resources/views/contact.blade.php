@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <section class="contact-hero">
        <div class="contact-hero__inner">
            <div class="contact-hero__label">Contact</div>
            <h1 class="contact-hero__title">Want to work together?<br />Let's Chat!</h1>
            <p class="contact-hero__desc">Have a project in mind, a question, or just want to say hi? Fill out the form or
                reach out directly.</p>
        </div>
    </section>

    <section class="contact-body" id="contact">
        <div class="contact-body__inner">
            <div class="contact-info">
                <h2 class="contact-info__title">Get in touch</h2>
                <p class="contact-info__desc">
                    {{ $siteSettings['contact_intro'] ?? 'Reach out any time and I will respond as soon as possible.' }}
                </p>

                <div class="contact-info__items">
                    <div class="contact-info__item">
                        <div class="contact-info__item-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="4" width="20" height="16" rx="2" />
                                <polyline points="2,4 12,13 22,4" />
                            </svg>
                        </div>
                        <div class="contact-info__item-body">
                            <span class="contact-info__item-label">Email:</span>
                            <a href="mailto:{{ $siteSettings['contact_email'] ?? 'contact@mc.com' }}"
                                class="contact-info__item-value">
                                {{ $siteSettings['contact_email'] ?? 'contact@mc.com' }}
                            </a>
                        </div>
                    </div>

                    <div class="contact-info__item">
                        <div class="contact-info__item-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z" />
                            </svg>
                        </div>
                        <div class="contact-info__item-body">
                            <span class="contact-info__item-label">Phone:</span>
                            <a href="tel:{{ $siteSettings['contact_phone'] ?? '(414) 687 - 5892' }}"
                                class="contact-info__item-value">
                                {{ $siteSettings['contact_phone'] ?? '(414) 687 - 5892' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form-wrap">
                <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="contact-form__row">
                        <div class="form-group">
                            <label class="form-group__label" for="name">Name</label>
                            <input class="form-group__input" type="text" id="name" name="name" value="{{ old('name') }}"
                                placeholder="Keana Riela" />
                        </div>
                        <div class="form-group">
                            <label class="form-group__label" for="email">Email</label>
                            <input class="form-group__input" type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="example@youremail.com" />
                        </div>
                    </div>
                    <div class="contact-form__row">
                        <div class="form-group">
                            <label class="form-group__label" for="phone">Phone</label>
                            <input class="form-group__input" type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                placeholder="(123) 456 - 7890" />
                        </div>
                        <div class="form-group">
                            <label class="form-group__label" for="company">Company</label>
                            <input class="form-group__input" type="text" id="company" name="company"
                                value="{{ old('company') }}" placeholder="Mc Technologies" />
                        </div>
                    </div>
                    <div class="form-group form-group--full">
                        <label class="form-group__label" for="message">Message</label>
                        <textarea class="form-group__textarea" id="message" name="message"
                            placeholder="Type your message here...">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn--primary btn--arrow">Send message<span
                            class="btn__arrow">›</span></button>
                </form>
            </div>
        </div>
    </section>
@endsection
