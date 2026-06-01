<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In — Portfolio CMS</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="admin-login-page">
    <div class="login-card">
        <div class="login-icon">🔐</div>
        <h1>Admin Login</h1>
        <p class="login-subtitle">Portfolio CMS — Sign in to continue</p>

        @if($errors->any())
            <div class="alert alert-error" style="margin-bottom:1.25rem">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}" class="admin-form">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••••" required />
            </div>
            <div class="form-group form-check" style="margin-bottom:1.5rem">
                <input type="checkbox" name="remember" id="remember" />
                <label for="remember" style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--a-muted-2)">Remember me</label>
            </div>
            <button type="submit" class="btn-admin btn-admin-primary" style="width:100%;justify-content:center;padding:0.75rem;font-size:0.9rem">
                Sign In
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
        </form>
    </div>
</div>

</body>
</html>
