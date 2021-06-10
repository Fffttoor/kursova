<?php session_start();
include 'templates/header.php';
include 'db_pdo.php';

?>

    <div class="main-wrapper">
        <div class="block">


            <div class="form">
                <form action="validate.php" method="post">
                    <h1>Enter your text</h1>
                    <textarea class="field" name="text" placeholder="Enter your text"></textarea>

                    <input class="field" type="text" maxlength="100" placeholder="Enter word to change"
                           name="word_to_change"/>
                    <?php if ($_SESSION['error1'] == 0) { ?><span class="error">This word doesn't exist in your text, please try another one</span> <?php } ?>
                    <?php if ($_SESSION['error2'] == 0) { ?><span
                            class="error">505 ERROR please try make request later</span> <?php } ?>
                    <?php if ($_SESSION['error3'] == 0) { ?><span class="error">This word wasn't found in our DB, please try another one</span> <?php } ?>
                    <input class="btn" type="submit" value="Submit">
                </form>
            </div>
            <?php if ($_SESSION['success'] == 1) {
                $result = $dbh->query('SELECT *FROM `synonims`ORDER BY `text_id` DESC LIMIT 1');
                foreach ($result as $row) {
                    ?><h2 class="result">Result:</h2>
                    <div class="text-wrapper">
                        <span class="text-header"><b><?= $row['word_to_change'] ?> </b>  -> </span>
                        <span class="text-header"><b><?= $row['synonym'] ?></b> </span>
                        <p class="user-text"><?= $row['changed_text'] ?> </p>
                        <small>Your text_id = <b><?= $row['text_id'] ?></b> </small>
                    </div>
                <?php }
            }
            ?>
        </div>
    </div>

<?php include 'templates/footer.php'; ?>