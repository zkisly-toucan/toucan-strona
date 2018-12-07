<?php
echo "lalalala";
    session_start();

    $db = new SQLite3('database.sqlite');
    $login = false;
    $username = 'admin';
    $password = 'oczt3ryTajne';

    if(isset($_POST) && $_POST != [] && isset($_POST['uname'])){
        $uname = $_POST['uname'];
        if(isset($uname)){

            if($uname == $username && isset($_POST['psw']) && $_POST['psw'] ==$password){
                $_SESSION['username'] = $uname;
            }
            $login = true;
        }
    }


    if(isset($_POST) && $_POST != [] && !$login){
        $tags = $_POST['tags'];
        if(isset($tags) && $tags != '') {
            echo $tags;
            $query1 = "insert into options(name, value) values ('tags', '$tags');";
            var_dump($query1);
            $db->query($query1);
        }
        $companies = $_POST['companies'];
        if(isset($companies) && $companies !='')
        {
            $delimiters = [';', '|'];
            foreach ($delimiters as $delimiter){
                $companies = str_replace($delimiter, ',', $companies);
            }
            echo $companies;

            $query = "insert into options(name, value) values ('companies', '$companies');";
            $db->query($query);
        }
        exit;
    }

    $tags = $db->query('select value from options where name = "tags"  order by rowid desc ');
    $tags = $tags->fetchArray();
    if($tags){
        $tags = $tags[0];
    }

    $companies = $db->query('select value from options where name = "companies"  order by rowid desc ');
    $companies = $companies->fetchArray();
    if($companies){
        $companies = $companies[0];
    }


    if(isset($_SESSION['username'])){
    ?>
<html>
    <head>
        <link rel="stylesheet" href="src/icon.css">
        <link rel="stylesheet" href="src/material.indigo-pink.min.css">
        <script defer src="src/material.min.js"></script>
        <script src="src/jquery-latest.min.js"></script>

        <style>
            .mdl-layout {
                align-items: center;
                justify-content: center;
            }
            .mdl-layout__content {
                padding: 24px;
                flex: none;
            }
        </style>
    </head>
    <body>

    <div class="mdl-layout mdl-js-layout mdl-color--grey-100">
        <main class="mdl-layout__content">

            <div class="mdl-card mdl-shadow--6dp" style="width: 700;">
                <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                    <h2 class="mdl-card__title-text">Ustawienia</h2>
                </div>
                <div class="mdl-card__supporting-text">


                    <form action="#" id="form">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" style='width:650' type="text" id="tags" value="<?= $tags ?>">
                            <label class="mdl-textfield__label" for="tags">Tagi</label>
                        </div>
                        <br/>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <textarea class="mdl-textfield__input" style='width:650' type="text" id="companies" rows="5"><?= $companies ?></textarea>
                            <label class="mdl-textfield__label" for="companies">Firmy</label>
                        </div>
                        <br>
                        <!-- Accent-colored raised button -->
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button" id="submit">
                            Aktualizuj
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    </body>
    <script>
        $(function(){
            $("#submit").click(ajax);

            function ajax() {
                console.log(34);
                jQuery.ajax({
                    type: "POST",
                    data: {
                        tags: $("#tags").val(),
                        companies: $("#companies").val()
                    },

                    success: function (data) {


                    }
                });
            }
        });
    </script>
</html>
<?php }else{
?>
        <html>
        <head>
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
            <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
            <style>
                .mdl-layout {
                    align-items: center;
                    justify-content: center;
                }
                .mdl-layout__content {
                    padding: 24px;
                    flex: none;
                }
            </style>
        </head>
        <body>

        <div class="mdl-layout mdl-js-layout mdl-color--grey-100">
            <main class="mdl-layout__content">
                <div class="mdl-card mdl-shadow--6dp">
                    <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                        <h2 class="mdl-card__title-text">Toucan Systems</h2>
                    </div>
                    <form action="" method="post">
                        <div class="mdl-card__supporting-text">
                            <div class="mdl-textfield mdl-js-textfield">
                                <input class="mdl-textfield__input" type="text" id="uname" name="uname" />
                                <label class="mdl-textfield__label" for="uname">Login</label>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield">
                                <input class="mdl-textfield__input" type="password" id="psw" name="psw" />
                                <label class="mdl-textfield__label" for="psw">Haslo</label>
                            </div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Zaloguj</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
        </body>
        </html>
<?php
    }