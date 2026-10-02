<?php

    function send_email($parameters) {
        $api_key = $GLOBALS['resend_api_key'] ?? '';
        $from = 'KG.codes <kelvingraddick@kg.codes>';
        $result = (object) array('success' => false, 'id' => null, 'status' => 0);
        if ($api_key === '') {
            $result->error_message = 'Email delivery is not configured.';
            error_log('KG.codes email: missing Resend configuration.');
            return $result;
        }
        if (!filter_var($parameters['recipient_email_address'] ?? '', FILTER_VALIDATE_EMAIL)) {
            $result->error_message = 'Invalid email recipient.';
            return $result;
        }
        $content = array(
            'from' => $from,
            'to' => array($parameters['recipient_email_address']),
            'subject' => $parameters['subject'],
            'html' => $parameters['body']
        );
        if (!empty($parameters['reply_to'])) {
            if (!filter_var($parameters['reply_to'], FILTER_VALIDATE_EMAIL)) {
                $result->error_message = 'Invalid reply address.';
                return $result;
            }
            $content['reply_to'] = $parameters['reply_to'];
        }
        $payload = json_encode($content);
        if ($payload === false) {
            $result->error_message = 'Unable to encode email content.';
            error_log('KG.codes email: invalid email content.');
            return $result;
        }
        $curl = curl_init('https://api.resend.com/emails');
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Authorization: Bearer '.$api_key),
            CURLOPT_USERAGENT => 'KG.codes/1.0',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2
        ));
        $response_body = curl_exec($curl);
        $result->status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curl_errno = curl_errno($curl);
        curl_close($curl);
        $response = is_string($response_body) ? json_decode($response_body) : null;
        $result->success = $result->status === 200 && !empty($response->id);
        if ($result->success) {
            $result->id = $response->id;
        } else {
            $result->error_message = 'Email delivery was not accepted.';
            // Do not log credentials, submitted answers, or recipient details.
            error_log('KG.codes email: Resend request failed; HTTP '.$result->status.'; cURL '.$curl_errno.'.');
        }
        return $result;
    }

    function get_email_template($content, $setting) {
        $template = '
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="initial-scale=1.0">
        <meta name="format-detection" content="telephone=no">
        <style type="text/css">
            table {
                border-spacing: 0;
            }
            table td {
                border-collapse: collapse;
            }
            @media screen and (max-width: 600px) {
                table[class="container"] {
                    width: 95% !important;
                }
            }
            @media screen and (max-width: 480px) {
                td[class="container-padding"] {
                    padding-left: 12px !important;
                    padding-right: 12px !important;
                }
            }
            @media only screen and (max-width : 600px) {
                td[class="force-col"] {
                    display: block;
                    padding-right: 0 !important;
                }
            }
        </style>
        <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#ebebeb">
            <tbody>
                <tr>
                    <td align="center" valign="top" bgcolor="#ebebeb" style="background-color: #ebebeb;">
                        <br><br>
                        <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" bgcolor="#ffffff">
                            <tbody>
                                <tr>
                                    <td class="container-padding" bgcolor="#ffffff" 
                                        style="background-color: #ffffff; padding-left: 30px; padding-right: 30px; font-size: 14px; line-height: 20px; font-family: Helvetica, sans-serif; color: #333;-moz-box-shadow: 3px 3px 3px 3px #ccc; -webkit-box-shadow: 3px 3px 3px 3px #ccc; box-shadow: 3px 3px 3px 3px #ccc;&nbsp;border-radius:10px;">
                                        <br>
                                        <img src="{logo_url}" width="50%">
                                        <br> 
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td class="force-col" style="background-color: #ffffff; font-size: 13px; line-height: 20px; font-family: Helvetica, sans-serif; color: #333;" valign="top">
                                                        <br>
                                                        {content}                                
                                                        <br><br>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>';
        $template = str_replace("{logo_url}", $setting['logo'], $template);
        $template = str_replace("{content}", $content, $template);
        $template = str_replace("{facebook_link}", $setting['facebook_link'], $template); 
        $template = str_replace("{instagram_link}", $setting['instagram_link'], $template);
        $template = str_replace("{twitter_link}", $setting['twitter_link'], $template);
        $template = str_replace("{linkedin_link}", $setting['linkedin_link'], $template);
        return $template;
    }

?>
