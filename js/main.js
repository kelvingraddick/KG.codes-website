document.addEventListener('DOMContentLoaded', function () {
    var article = document.querySelector('.post_body');
    var card = document.getElementById('newsletter-signup-card');
    var form = document.getElementById('newsletter-signup-form');
    var closeButton = document.getElementById('newsletter-signup-close');
    var emailInput = document.getElementById('newsletter-signup-email');
    var submitButton = document.getElementById('newsletter-signup-submit');
    var status = document.getElementById('newsletter-signup-status');

    if (!article || !card || !form || !closeButton || !emailInput || !submitButton || !status) {
        return;
    }

    var DISMISSED_UNTIL_KEY = 'kgcodes.newsletter.dismissedUntil';
    var SUBSCRIBED_KEY = 'kgcodes.newsletter.subscribed';
    var DISMISSAL_DURATION_MS = 60 * 24 * 60 * 60 * 1000;
    var MINIMUM_READING_TIME_MS = 20 * 1000;
    var hasWaitedLongEnough = false;
    var hasShown = false;
    var scrollFrameRequested = false;

    function readStorage(key) {
        try {
            return window.localStorage.getItem(key);
        } catch (error) {
            return null;
        }
    }

    function writeStorage(key, value) {
        try {
            window.localStorage.setItem(key, value);
        } catch (error) {
            // Storage may be unavailable. The signup still works for this page load.
        }
    }

    function isSuppressed() {
        if (readStorage(SUBSCRIBED_KEY) === 'true') {
            return true;
        }

        var dismissedUntil = Number(readStorage(DISMISSED_UNTIL_KEY));
        return Number.isFinite(dismissedUntil) && dismissedUntil > Date.now();
    }

    function track(eventName) {
        if (typeof window.gtag === 'function') {
            window.gtag('event', eventName, {
                event_category: 'newsletter'
            });
        }
    }

    function hasReachedArticleMidpoint() {
        var articleTop = article.getBoundingClientRect().top + window.pageYOffset;
        var articleMidpoint = articleTop + (article.offsetHeight * 0.5);
        var viewportBottom = window.pageYOffset + window.innerHeight;
        return viewportBottom >= articleMidpoint;
    }

    function showCardIfEligible() {
        scrollFrameRequested = false;

        if (hasShown || !hasWaitedLongEnough || isSuppressed() || !hasReachedArticleMidpoint()) {
            return;
        }

        hasShown = true;
        card.hidden = false;
        window.requestAnimationFrame(function () {
            card.classList.add('newsletter-signup-card-visible');
        });
        track('newsletter_card_shown');
    }

    function scheduleEligibilityCheck() {
        if (scrollFrameRequested || hasShown) {
            return;
        }

        scrollFrameRequested = true;
        window.requestAnimationFrame(showCardIfEligible);
    }

    function setStatus(message, state) {
        status.textContent = message;
        status.classList.remove('newsletter-signup-status-success', 'newsletter-signup-status-error');
        if (state) {
            status.classList.add('newsletter-signup-status-' + state);
        }
    }

    function finishSuccessfulSignup(message) {
        writeStorage(SUBSCRIBED_KEY, 'true');
        form.hidden = true;
        card.querySelector('.newsletter-signup-note').hidden = true;
        setStatus(message || 'Thanks for subscribing!', 'success');
        track('newsletter_signup_success');
    }

    closeButton.addEventListener('click', function () {
        writeStorage(DISMISSED_UNTIL_KEY, String(Date.now() + DISMISSAL_DURATION_MS));
        card.classList.remove('newsletter-signup-card-visible');
        card.hidden = true;
        track('newsletter_card_dismissed');
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        setStatus('', null);

        if (!emailInput.checkValidity()) {
            emailInput.reportValidity();
            setStatus('Enter a valid email address.', 'error');
            track('newsletter_signup_error');
            return;
        }

        submitButton.disabled = true;
        submitButton.textContent = 'Subscribing…';

        var requestBody = 'EMAIL=' + encodeURIComponent(emailInput.value) +
            '&b_bb6fbe9744331c32ef7a9d039_7d8d242227=' +
            encodeURIComponent(document.getElementById('newsletter-signup-honeypot').value);

        window.fetch(card.getAttribute('data-subscribe-url'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
            },
            credentials: 'same-origin',
            body: requestBody
        }).then(function (response) {
            return response.json();
        }).then(function (response) {
            var message = String(response && response.message ? response.message : '').trim();
            var isAlreadySubscribed = /already subscribed/i.test(message);

            if ((response && response.result === 'success') || isAlreadySubscribed) {
                finishSuccessfulSignup(isAlreadySubscribed ? 'You’re already subscribed. Thanks!' : message);
                return;
            }

            setStatus(message || 'We could not subscribe you. Please check your email address and try again.', 'error');
            track('newsletter_signup_error');
        }).catch(function () {
            setStatus('Subscription is temporarily unavailable. Please try again.', 'error');
            track('newsletter_signup_error');
        }).then(function () {
            submitButton.disabled = false;
            submitButton.textContent = 'Subscribe';
        });
    });

    if (isSuppressed()) {
        return;
    }

    window.addEventListener('scroll', scheduleEligibilityCheck, { passive: true });
    window.addEventListener('resize', scheduleEligibilityCheck);
    window.setTimeout(function () {
        hasWaitedLongEnough = true;
        scheduleEligibilityCheck();
    }, MINIMUM_READING_TIME_MS);
});
