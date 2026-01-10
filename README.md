# Pickle Juice

A modular, override-safe WordPress plugin designed for artists, creators, and developers who want a clean, branded, secure login and admin experience without the clutter of default WordPress UI. Pickle Juice is built around a simple idea: every feature is a module, and every module can be toggled on or off. No bloat. No surprises. Just clean, extensible functionality.

## FEATURES

### Passwordless Login (Magic Links)

- Email-only login flow
- Secure, expiring magic links
- Rate-limited requests to prevent abuse
- Admin-side “Test Magic Link” button for verification and debugging

### Turnstile Anti-Spam

- Cloudflare Turnstile integration
- Toggle-controlled
- Keys stored securely in the settings page
- Works with registration and login flows

### Custom Login Branding

- Replace default WordPress login logo
- Custom login URL slug
- Minimal, artist-friendly login UI
- Override-safe CSS targeting

### Admin Debranding

- Remove the WordPress.org  admin bar menu
- Replace the admin footer text with your own branded message
- Keep the WordPress version number visible
- Fully modular and toggle-controlled

### Modular Architecture

- Each feature lives in its own class-based module
- Modules load only when enabled
- Override-safe structure for child themes or custom extensions
- Clean separation of concerns for long-term maintainability

### HOW IT WORKS

Pickle Juice uses a module loader that checks plugin settings and loads only the modules you’ve enabled. This keeps the plugin lightweight, predictable, and easy to extend.
```
modules/
  
```

Each module is:

- Self-contained
- Namespaced via class
- Loaded conditionally
- Safe to override or extend

### SETTINGS PAGE

Pickle Juice includes a unified settings page where you can:

- Enable or disable modules
- Configure Turnstile keys
- Set custom login branding
- Customize admin footer text
- Test magic link delivery
- Manage rate limiting

All settings use the native WordPress Settings API for maximum compatibility.

### SECURITY PHILOSOPHY

- Pickle Juice is built with a security-first mindset:
- Nonces applied where appropriate
- Sanitization and escaping on all user-facing fields
- Rate limiting on sensitive actions
- Expiring tokens for magic links
- No unnecessary scripts or assets

### DEVELOPER-FRIENDLY

Pickle Juice is designed for developers who want:

- Clean, readable code
- Modular architecture
- Override-safe patterns
- Hooks and filters for customization
- A plugin that doesn’t fight you

### ROADMAP

- Magic-link login analytics
- Admin color scheme branding
- Developer dashboard
- Module documentation browser
- Utilities layer for shared helpers
