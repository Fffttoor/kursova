<?php include 'templates/header.php';
include 'db_pdo.php';
?>

    <div class="main-wrapper">
            <?php
            $result = $dbh->query('SELECT * FROM `synonims`');
            foreach ($result as $row) {
                ?>
                <div class="text-wrapper">
                    <span class="text-header"><b><?= $row['word_to_change'] ?> </b>  -> </span>
                    <span class="text-header"><b><?= $row['synonym'] ?></b> </span>
                    <p class="user-text"><?= $row['changed_text'] ?> </p>
                    <small>This text_id = <b><?= $row['text_id'] ?></b> </small>
                </div>
            <?php } ?>
        </div>


<?php include 'templates/footer.php'; ?>