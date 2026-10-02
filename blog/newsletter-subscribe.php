<?php
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    header('X-Content-Type-Options: nosniff');

    function newsletter_response($result, $message) {
        echo json_encode(array(
            'result' => $result,
            'message' => $message
        ));
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        header('Allow: POST');
        newsletter_response('error', 'This request method is not supported.');
    }

    $email_address = trim($_POST['EMAIL'] ?? '');
    $honeypot = trim($_POST['b_bb6fbe9744331c32ef7a9d039_7d8d242227'] ?? '');

    if ($honeypot !== '') {
        newsletter_response('success', 'Thanks for subscribing!');
    }

    if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        newsletter_response('error', 'Enter a valid email address.');
    }

    $mailchimp_url = 'https://mc.us16.list-manage.com/subscribe/form-post-json';
    $mailchimp_data = array(
        'u' => 'bb6fbe9744331c32ef7a9d039',
        'id' => '7d8d242227',
        'c' => 'kgcodesNewsletterCallback',
        'EMAIL' => $email_address,
        'b_bb6fbe9744331c32ef7a9d039_7d8d242227' => ''
    );
    $curl = curl_init($mailchimp_url.'?'.http_build_query($mailchimp_data));
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_USERAGENT => 'KG.codes/1.0',
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2
    ));
    $response_body = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $curl_errno = curl_errno($curl);
    curl_close($curl);

    $response = is_string($response_body) ? json_decode($response_body, true) : null;
    if (!is_array($response) && is_string($response_body)) {
        $matches = array();
        if (preg_match_all('/kgcodesNewsletterCallback\((\{.*?\})\)/s', $response_body, $matches)) {
            foreach ($matches[1] as $candidate) {
                $decoded_candidate = json_decode($candidate, true);
                if (is_array($decoded_candidate)) {
                    $response = $decoded_candidate;
                    break;
                }
            }
        }
    }
    if ($status !== 200 || !is_array($response)) {
        error_log('KG.codes newsletter: Mailchimp request failed; HTTP '.$status.'; cURL '.$curl_errno.'.');
        newsletter_response('error', 'Subscription is temporarily unavailable. Please try again.');
    }

    $message = trim(strip_tags((string) ($response['msg'] ?? '')));
    if ($message === '' && isset($response['errors'])) {
        $errors = is_array($response['errors']) ? $response['errors'] : array($response['errors']);
        $message = trim(implode(' ', array_map('strip_tags', $errors)));
    }

    if (($response['result'] ?? '') === 'success') {
        newsletter_response('success', $message !== '' ? $message : 'Thanks for subscribing!');
    }

    newsletter_response('error', $message !== '' ? $message : 'We could not subscribe you. Please check your email address and try again.');
?>
