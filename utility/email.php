<?php

    function send_email($parameters) {
        $url = "https://api.sendgrid.com/v3/mail/send";
        $content = '{
            "personalizations": [
                {
                    "to": [
                        {
                            "email": '.json_encode($parameters['recipient_email_address']).',
                            "name": '.json_encode($parameters['recipient_name']).'
                        }
                    ],
                    "subject": '.json_encode($parameters['subject']).'
                }
            ],
            "from": {
                "email": "kelvingraddick@kg.codes",
                "name": "KG.codes"
            },
            "content": [
                {
                    "type": "text/html",
                    "value": '.json_encode($parameters['body']).'
                }
            ]
        }';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json", "Authorization: Bearer ".$GLOBALS['sendgrid_api_key']));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $curl_response = json_decode(curl_exec($curl));
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($status != 202) { 
            $curl_response -> error_message = "Error: call to URL $url failed with status $status, response ".json_encode($curl_response).", curl_error ".curl_error($curl).", curl_errno ".curl_errno($curl);
        }
        curl_close($curl);
        return $curl_response;
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