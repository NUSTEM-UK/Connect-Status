<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <script src="static/js/jquery-3.6.0.min.js"></script>
    <!-- <link rel="stylesheet" href="static/DataTables/datatables.min.css"> -->
    <!-- <script src="static/DataTables/datatables.min.js"></script> -->
    <title>Connect Status - Simple</title>
</head>

<body>

    <?php
    // Fire the MQTT mood message if one has been received.
    require_once 'functions.php';
    // console_log("Hello world");

    $moodCommand = filter_has_var(INPUT_GET, 'moodCommand') ? trim($_GET['moodCommand']) : null;

    if (
        $moodCommand === 'HAPPY'
        || $moodCommand === 'SAD'
        || $moodCommand === 'SKULL'
        || $moodCommand === 'HEART'
        || $moodCommand === 'SILLY'
        || $moodCommand === 'DUCK'
    ) {
        // we have a valid mood...
        sendMood($moodCommand);
        // console_log("Sending mood: {$moodCommand}");
    } elseif (!empty($moodCommand)) {
        console_log("Invalid mood: {$moodCommand}");
    } else {
        // No command received, either valid or invalid, so just pass.
    }

    ?>


    <div class="container py-4">

        <header class="mt-2 mb-3 p-3 bg-warning rounded">
            <h1>Connect Mood</h1>
            <p>
                All panels auto-update. Click blue buttons to send moods.<br>
            </p>
        </header>

        <div class="row">
            <div class="col">
                <div class="card p-2 bg-light">
                    <h2>System mood</h2>
                    <!-- <p id="show-current-mood">Mood goes here.</p> -->
                    <img id="currentSystemMoodIcon" class="img-fluid" src="static/img/mood-placeholder.png" alt="">
                </div>
            </div>
            <div class="col-7">
                <div class="container px-0">
                    <!-- <h2 class="pt-3">Send</h2> -->
                    <h2 class="pb-3">Send</h2>
                    <div class="d-grid gap-1">
                        <form action="" method="get">
                            <div class="btn-group-vertical w-100">
                                <button name="moodCommand" type="submit" class="btn w-100 btn-lg btn-primary mb-2" value="HAPPY">🙂 HAPPY</button>
                                <button name="moodCommand" type="submit" class="btn w-100 btn-lg btn-primary mb-2" value="SAD">☹️ SAD</button>
                                <button name="moodCommand" type="submit" class="btn w-100 btn-lg btn-primary mb-2" value="SKULL">💀 SKULL</button>
                                <button name="moodCommand" type="submit" class="btn w-100 btn-lg btn-primary mb-2" value="HEART">❤️ HEART</button>
                                <button name="moodCommand" type="submit" class="btn w-100 btn-lg btn-primary mb-2" value="SILLY">🤪 SILLY</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
    <script src="static/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="static/js/main-trimmed.js"></script>
    <!-- <script>
    $(document).ready(function() {
        $('#mac-table').DataTable();
    });
</script> -->
</body>

</html>
