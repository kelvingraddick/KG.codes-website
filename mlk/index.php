<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MLK</title>
        <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
        <style>
            .hero.is-medium .hero-body {
                padding: 9rem 1.5rem;
            }

            .background-image {
                background-position: center center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                background-color: white;
            }

            .post {
                margin-bottom: 40px;
            }
 
            @media (min-width: 992px) {
                
            }
        </style>
    </head>
    <body>
        <div class="card">
            <section class="hero is-medium is-primary is-bold background-image" style="background-image: url('/mlk/images/mlk-group.jpg');">
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title">&nbsp;</h1>
                        <h2 class="subtitle">&nbsp;</h2>
                    </div>
                </div>
            </section>
            <div class="card-content">
                <div class="media">
                    <div class="media-left">
                        <figure class="image is-48x48">
                            <img class="is-rounded" src="/mlk/images/mlk-profile.png" alt="Placeholder image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <p class="title is-4">Martin Luther King, Jr.</p>
                        <p class="subtitle is-6">@martinlutherkingjr</p>
                    </div>
                </div>
                <div class="content">
                    <a href="#">Martin Luther King, Jr.</a> was a social activist and Baptist minister who played a key role in the American civil rights movement. King sought equality and human rights for African Americans, the economically disadvantaged, and all victims of injustice through peaceful protest.
                    <br /><br />
                    <span class="icon is-small"><i class="fas fa-map-marker-alt"></i></span> <a href="#">Atlanta, GA</a>
                </div>
            </div>
        </div>
        <section class="section">
            <?php
                $qoutes = array(
                    "Injustice anywhere is a threat to justice everywhere.",
                    "Darkness cannot drive out darkness; only light can do that. Hate cannot drive out hate; only love can do that.",
                    "We must learn to live together as brothers or perish together as fools.",
                    "The ultimate measure of a man is not where he stands in moments of comfort and convenience, but where he stands at times of challenge and controversy."
                );
                foreach ($qoutes as $qoute) {
                    echo '
                        <div class="card post">
                            <div class="card-content">
                                <article class="media">
                                    <figure class="media-left">
                                        <p class="image is-64x64">
                                            <img class="is-rounded" src="/mlk/images/mlk-profile.png">
                                        </p>
                                    </figure>
                                    <div class="media-content">
                                        <div class="content">
                                            <p>
                                                <strong>Martin Luther King, Jr.</strong> <small>@martinlutherkingjr</small>
                                                <br>
                                                <p class="title">
                                                    "'.$qoute.'"
                                                </p>
                                            </p>
                                        </div>
                                        <nav class="level is-mobile">
                                            <div class="level-left">
                                                <a class="level-item">
                                                    <span class="icon is-small"><i class="fas fa-reply"></i></span>
                                                </a>
                                                <a class="level-item">
                                                    <span class="icon is-small"><i class="fas fa-retweet"></i></span>
                                                </a>
                                                <a class="level-item">
                                                    <span class="icon is-small"><i class="fas fa-heart"></i></span>
                                                </a>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="media-right has-text-grey">
                                        <span class="icon is-small">
                                            <i class="fas fa-clock" style="padding-top: 5px;"></i>
                                        </span>
                                        <small><i>50+ yrs ago</i></small>
                                    </div>
                                </article>
                            </div>
                        </div>
                    ';
                }
            ?>
        </section>
    </body>
</html>