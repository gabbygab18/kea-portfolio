@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <section class="contact" id="contact">
        <div class="contact-glow contact-glow--main" aria-hidden="true"></div>
        <div class="contact-glow contact-glow--soft" aria-hidden="true"></div>

        {{-- Phone illustration — direct child of the section so it can span its full height --}}
        <div class="contact__visual" aria-hidden="true">
            <img src="{{ asset('images/contact-phone.png') }}" alt="" class="contact__phone" />
        </div>

        <div class="contact__inner">
            {{-- Right: form --}}
            <div class="contact-form-wrap">
                <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="contact-form__row">
                        <div class="form-group">
                            <label class="form-group__label" for="name">Name</label>
                            <input class="form-group__input" type="text" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Brian Clark" />
                        </div>
                        <div class="form-group">
                            <label class="form-group__label" for="email">Email</label>
                            <input class="form-group__input" type="email" id="email" name="email"
                                value="{{ old('email') }}" placeholder="example@youremail.com" />
                        </div>
                    </div>
                    <div class="contact-form__row">
                        <div class="form-group">
                            <label class="form-group__label" for="phone">Phone</label>
                            <input class="form-group__input" type="tel" id="phone" name="phone"
                                value="{{ old('phone') }}" placeholder="(123) 456 - 7890" />
                        </div>
                        <div class="form-group">
                            <label class="form-group__label" for="company">Company</label>
                            <input class="form-group__input" type="text" id="company" name="company"
                                value="{{ old('company') }}" placeholder="Mc Technologies" />
                        </div>
                    </div>
                    <div class="form-group form-group--full">
                        <label class="form-group__label" for="message">Message</label>
                        <textarea class="form-group__textarea" id="message" name="message" placeholder="Type your message here...">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn--primary btn--arrow">Send message<span
                            class="btn__arrow">&rarr;</span></button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

@endpush
