<?php

    function create_blog_post_thumbnail($post) {
        $post_url = 'https://'.$_SERVER['SERVER_NAME'].'/blog/'.$post['slug'];
        $html =
        '<div class="partial_post" onclick="location.href=\''.$post_url.'\';">
            <div class="partial_post_banner" style="background-image:url(\''.$post['main_image_url'].'\');" title="'.$post['title'].'">
                <div class="partial_post_header">
                    <div class="partial_post_title">
                        <table style="width:100%;">
                            <tr>
                                <td>
                                    <a href="'.$post_url.'"><h1>'.$post['title'].'</h1></a>
                                </td>
                                <td class="partial_post_social_icons">
                                    <i class="fab fa-facebook partial_post_social_icon" onclick="shareUrlToFacebook(this, \''.$post_url.'\');"></i>
                                    <a href="https://twitter.com/intent/tweet?text='.urlencode($post['title']).'&url='.$post_url.'&via=KGTheMaker" target="_blank"><i class="fab fa-twitter partial_post_social_icon"></i></a>
                                    <a href="https://www.pinterest.com/pin/create/button/?url='.$post_url.'&media=https://'.$_SERVER['SERVER_NAME'].$post['tall_image_url'].'&description='.urlencode($post['title']).'" target="_blank" data-pin-do="buttonPin" data-pin-config="above">
                                        <i class="fab fa-pinterest partial_post_social_icon"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="partial_post_subtitle">
                        '.$post['author'].' &middot;
                        <time class="timeago" datetime="'.date(DATE_ISO8601, strtotime($post['created_time'])).'"></time>
                    </div>
                </div>
            </div>
        </div>';
        return $html;
    }

?>