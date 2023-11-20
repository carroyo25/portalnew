<?php
    $random = rand(0,999999);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/news.css?v<?php echo $random; ?>">
    <title>Pagina de Noticias</title>
</head>
<body>
    <div class="news__wrap">
        <div class="news__wrap__header">
            <h1>Publicaciones</h1>
        </div>
        <div class="news__body"> 
            <div class="news__wrap_left">
                <h3 class="news_title">Noticias</h3>
                <div class="news__wrap_publication">
                    <?php for ($i=0; $i < 4; $i++) { ?>
                        <article class="publication">
                            <img src="../fotos/63fcd8b386f1e.jpg" alt="">
                            <div class="publication__text">
                                <p class="title_publication">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vitae non veniam velit temporibus iure quod tempora reiciendis rerum eligendi corrupti?</p>
                                <p class="description_publication">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima hic ratione iure, perspiciatis ipsum nemo amet mollitia magni fugiat cum eveniet aspernatur, et laborum incidunt neque! Consectetur eum illo veniam voluptate cum magnam non sint, atque facilis, provident ipsum maxime perferendis architecto. Numquam atque ad possimus quod recusandae nulla iusto. Alias, modi ipsum libero minus animi magni reprehenderit ex itaque!
                                </p>
                                <a href="#" class="read__more">Leer más</a>
                            </div>
                        </article>
                    <?php }?>
                </div>
            </div>
            <div class="news__wrap__rigth">
                <div class="events_calendar">
                    <h3 class="news_title">Eventos</h3>
                    <div class="calendar">
                        <?php require_once('calendario.php') ?>
                    </div>
                </div>
                <div class="news__wrap_bulletin">
                    <h3 class="news_title">Boletines</h3>
                    <div class="bulleting">
                        <img src="../boletines/boletin001.jpg" alt="" class="img__bulleting">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>