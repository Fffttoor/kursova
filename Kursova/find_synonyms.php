<?php
include 'templates/header.php';
include 'db_pdo.php';

?>

    <div class="main-wrapper">
        <div class="block">


            <div class="form">
                    <h1>Enter your word</h1>
                    <input class="field" id="word" type="text" maxlength="100" placeholder="Enter word to change"/>
                    <input class="btn" type="submit" id="synonym"  value="Submit">
            </div>
            <div class="text-wrap"></div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script>

        $('#synonym').click(function () {
            var word = $('#word').val()
            $.ajax({
                url: "show_synonims.php",
                type: "POST",
                data: ({word: word}),
                success:show_link
                })
            });
        function show_link(data) {
            $('.text-wrap').html(data);
        };
    </script>


<?php include 'templates/footer.php'; ?>