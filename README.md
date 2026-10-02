# KG.codes

[KG.codes](https://www.kg.codes/) is Kelvin Graddick's personal and professional website. It brings together a software-development portfolio, coding articles, contact and project questionnaires, an RSS feed, and music-related pages in a small server-rendered PHP application.

This repository is primarily a reference implementation of the live portfolio. You can study it or adapt its structure for your own site, but it is not a turnkey starter: the production database schema and content are private and are not included in the repository.

## Features

- Portfolio landing page with featured apps, websites, and recent writing
- Coding and project showcase
- Database-backed blog with HTML and Markdown posts
- Contact form plus app and website project questionnaires
- RSS feed for published blog posts
- Music catalog and individual beat pages
- Responsive layouts, social metadata, analytics, mailing-list, and notification integrations

## Technology

- PHP 8+ with server-rendered HTML
- MySQL or MariaDB through PHP's `mysqli` extension
- HTML, CSS, JavaScript, and jQuery
- [Parsedown](https://parsedown.org/) for Markdown blog posts
- IIS rewrite rules in `web.config`
- Resend's HTTP API for transactional email

There is no framework, package manager, compilation step, or generated frontend bundle.

## Repository structure

| Path | Purpose |
| --- | --- |
| `index.php` | Home page and recent-post listing |
| `header.php` | Shared site navigation |
| `blog/` | Blog listing and individual post rendering |
| `coding/` | Software portfolio page |
| `contact/` | Contact form and submission flow |
| `questionnaire/` | App and website project questionnaires |
| `beats/` | Music catalog and individual beat pages |
| `rss/` | RSS feed endpoint |
| `css/`, `js/`, `fonts/`, `images/` | Site styling, scripts, fonts, and media |
| `utility/common.php` | Shared database, metadata, and formatting helpers |
| `utility/email.php` | Resend email client and shared email template |
| `utility/configuration.php` | Database and service configuration values |
| `mapping.php` | Clean URL mapping for blog posts and beats |
| `web.config` | IIS HTTPS, canonical-host, and trailing-slash rules |

## Prerequisites

To run the complete site, you need:

- PHP 8 or newer
- MySQL or a compatible MariaDB version
- PHP `mysqli`, `curl`, and JSON support
- A web server whose document root is this repository's root directory
- A compatible database populated with the site's required tables and content

Optional integrations require their own accounts and configuration. See [External services](#external-services).

## Run locally

### 1. Clone the repository

```bash
git clone https://github.com/kelvingraddick/KG.codes-website.git
cd KG.codes-website
```

### 2. Prepare a database

Create an empty MySQL or MariaDB database, then import your own compatible schema and content.

The application references these tables:

| Table | Used for |
| --- | --- |
| `settings` | Site-wide links, images, and other display settings |
| `seo` | Page titles, descriptions, and keywords |
| `blog_posts` | Blog content, metadata, publication state, and slugs |
| `products` | Music and beat content |
| `contacts` | Contact-form and questionnaire submissions |
| `popeyesvschickfila` | Votes for the site's comparison page |

The repository does not include the production schema, migrations, a SQL export, or seed data. Column definitions can be inferred from the queries, but you should not assume a fresh database will work without supplying a compatible schema and required rows.

### 3. Configure the application

Update the placeholder values in `utility/configuration.php` for your local environment:

```php
<?php
    $site_name = "Your site name";

    $database_host = "127.0.0.1";
    $database_username = "your_database_user";
    $database_password = "your_database_password";
    $database_name = "your_database_name";

    $resend_api_key = "your_resend_api_key";
    $recaptcha_secret_key = "your_recaptcha_secret_key";
?>
```

Use development credentials locally. Never commit real database passwords or API keys. Because `utility/configuration.php` is currently tracked, check `git diff` before every commit and use a private deployment mechanism for production values.

### 4. Start the PHP development server

From the repository root, run:

```bash
php -S localhost:8000 -t .
```

Then open [http://localhost:8000](http://localhost:8000).

The built-in PHP server is suitable for development only. Directory routes such as `/blog/` and `/contact/` work through their `index.php` files. Clean content URLs such as `/blog/example-slug` and `/beats/example-slug` depend on rewrite behavior that forwards requests through `mapping.php`; configure equivalent routing in your local web server when testing those URLs.

Most pages connect to the database before rendering. If the database or required rows are missing, the site will not provide a complete frontend-only preview.

## External services

The live site uses several third-party services. A fork should replace or remove each production-specific identifier before deployment.

### Transactional email

The contact form and both project questionnaires send transactional email through the Resend HTTP API in `utility/email.php`.

To enable email:

1. Create a [Resend](https://resend.com/) account and verify a sending domain you control.
2. Create an API key with only the permissions needed to send email.
3. Set `$resend_api_key` through your private configuration process.
4. Replace the KG.codes sender address in `utility/email.php` with an address on your verified domain.

A successful application response means Resend accepted the request and returned a message ID. It does not guarantee final delivery. Use Resend's email events to confirm delivery or investigate bounces.

If an owner notification fails, the questionnaires keep the answers saved in the database and show the visitor alternate contact instructions. Provider failures are logged without submitted content, recipient details, or credentials. The contact form retains its existing success flow.

### Other integrations

- **Google reCAPTCHA:** Contact and questionnaire forms use a public site key in their markup and `$recaptcha_secret_key` for server-side verification. Create keys for your own domains and replace both values.
- **OneSignal:** Notification scripts and root service-worker files support browser push notifications. Replace the app configuration or remove the integration.
- **Mailchimp:** Individual blog posts show a custom newsletter signup after an engaged reader reaches the article midpoint. The public audience identifiers are rendered by `blog/post.php`, and the trigger and asynchronous submission behavior live in `js/main.js`. Replace the account and audience-specific values before deploying a fork.
- **Analytics and social tracking:** Google Analytics and Facebook-related scripts live under `js/` or within individual pages. Use identifiers owned by your project.
- **Third-party assets:** Some pages load content or assets from Google Fonts, Font Awesome, social networks, and other CDNs. Review their current terms, privacy impact, and availability before reuse.

## Deploy

This application can run on conventional PHP hosting, a virtual server, or a container-based platform that provides PHP and MySQL connectivity.

1. Provision a supported PHP runtime and MySQL or MariaDB database.
2. Import your compatible schema and content.
3. Configure production database credentials and service secrets without committing them to the repository.
4. Point the site's document root at the repository root so absolute includes such as `/utility/common.php` resolve correctly.
5. Configure clean URLs so `/blog/{slug}` routes to `blog/post.php` and `/beats/{slug}` routes to `beats/beat.php`, with the slug available to PHP. `mapping.php` contains the application's current routing logic.
6. Enable HTTPS and set redirects for your preferred canonical hostname.
7. Ensure the PHP process can make outbound HTTPS requests to reCAPTCHA, Resend, and any enabled integrations.
8. Keep PHP errors out of public responses and send operational errors to protected server logs.

`web.config` targets Microsoft IIS and contains KG.codes-specific host redirects. If you deploy to Apache or Nginx, create equivalent rewrite and HTTPS rules for your own domain instead of copying those hostnames unchanged.

SFTP is one possible way to upload the files, but it is not required. Git-based deployments, release archives, containers, and hosting control panels are also valid as long as they preserve the document-root and routing requirements.

After deployment, verify:

- Home, portfolio, blog listing, blog post, music, contact, questionnaire, and RSS routes
- CSS, JavaScript, fonts, images, favicons, and service workers
- Database reads and writes using a non-production test submission
- reCAPTCHA validation and form failure states
- Resend acceptance followed by the final delivery event
- HTTPS, canonical-host redirects, and clean URLs
- Responsive layouts on narrow and wide screens

## Customize a fork

Before publishing an adapted version, search the repository for `KG.codes`, `kg.codes`, `Kelvin Graddick`, and production service identifiers. At minimum, replace:

- Site name, copy, portfolio projects, blog content, and images
- Logos, favicons, web manifest values, and social-preview artwork
- Canonical URLs and SEO metadata
- Email sender, recipient, and reply-to behavior
- reCAPTCHA, OneSignal, Mailchimp, analytics, and tracking identifiers
- RSS title, links, description, and copyright text
- IIS hostname redirects or their Apache/Nginx equivalents
- Third-party embeds and external profile links

The visual content and database records from the live site are personal portfolio material. Supply content and branding that you have permission to use.

## Security notes

- Do not commit database credentials, Resend keys, reCAPTCHA secrets, or other private configuration.
- Restrict API keys by permission, service, and domain whenever the provider supports it.
- Disable public PHP error display in production. Several pages currently enable verbose errors and should be covered by server-level production settings.
- Back up the database before deployments or schema changes, and test restoration periodically.
- Validate, normalize, and safely store all form input. Escape untrusted data for its output context before rendering it in HTML, email, logs, or feeds.
- Review all SQL paths and third-party scripts before exposing an adapted fork to public traffic.
- Do not include production database exports or visitor submissions in a public repository.

## License

This repository does not currently include a license. Public availability of the source code does not by itself grant permission to copy, modify, or redistribute it. Contact the repository owner if you need reuse rights beyond viewing and studying the code.
