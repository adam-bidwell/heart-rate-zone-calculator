<?php
include '../vendor/autoload.php';

$fthr = null;
$message = '';

if (is_array($_GET) && array_key_exists('bpm', $_GET))
{
    $bpm = $_GET['bpm'];
    if (!is_numeric($bpm) || !($bpm > 100 && $bpm < 220))
    {
        unset($bpm);
        $message = 'Please enter a valid number for the functional threshold heart rate';
    }
    else
    {
        $fthr = new Training\HeartRate($bpm);
        $fthr->setBandStrategy(new Training\BritishCyclingBandStrategy());
    }
}
?>
<html>
    <head>
        <title>Heart Rate Zones Calculator</title>
        <style type="text/css">
            body
            {
                font-family: verdana;
            }
            
            th, td
            {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <p>
            <form method="GET">
                Please enter your functional threshold heart rate: <input type="text" maxlen="5" size="5" name="bpm" />&nbsp;<input type="submit" />
            </form>
        </p>
        <?php
        if ($fthr !== null)
        {
            ?>
            <p>The zones for your given functional threshold heart rate of <?php echo $fthr->getBPM(); ?> is as follows:</p>
            <table>
                <thead>
                    <tr>
                        <th>Zone</th>
                        <th>Lower BPM</th>
                        <th>Upper BPM</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($fthr->getZones() as $i => $zone)
                        {
                            echo '<tr>';
                            echo '<td>' . ($i + 1) . '</td>';
                            echo '<td>' . $zone->getLower() . '</td>';
                            echo '<td>' . $zone->getUpper() . '</td>';
                            echo '<td>' . $zone->getLabel() . '</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
            <?php
        }
        ?>
    </body>
</html>