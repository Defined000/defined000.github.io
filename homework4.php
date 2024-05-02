<?php
$link = mysqli_connect("localhost", 'root', '','tickets');
mysqli_query($link, "set session character_set_connection=utf8;");
mysqli_query($link, "set session character_set_results=utf8;");
mysqli_query($link, "set session character_set_client=utf8;");
?>
<html>
<head>
    <meta charset="utf-8">
    <title>homework4</title>
    <style>
        .input-wrap {
            width: 960px;
            margin: 0 auto;
        }
        h1 { text-align: center; }
        th, td { text-align: center; }
        table {
            border: 1px solid #000;
            margin: 0 auto;
        }
        td, th {
            border: 1px solid #ccc;
        }
        a { text-decoration: none; }
    </style>
</head>
<body>
    <div class="input-wrap">
        <form action="homework4.php" method="POST">
            <p>고객성명 <input type="text" name="name" required> <input type="submit" name="submit" value="합계"></p>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>구분</th>
                        <th colspan="2">어린이</th>
                        <th colspan="2">어른</th>
                        <th>비고</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>입장권</td>
                        <td>7,000</td>
                        <td>
                            <select name="childpass">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                        <td>10,000</td>
                        <td>
                            <select name="adultpass">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                        <td>입장</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>BIG3</td>
                        <td>12,000</td>
                        <td>
                            <select name="childBIG3">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                        <td>16,000</td>
                        <td>
                            <select name="adultBIG3">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                        <td>입장+놀이3종</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>자유이용권</td>
                        <td>21,000</td>
                        <td>
                            <select name="childfreepass">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                        <td>26,000</td>
                        <td>
                            <select name="adultfreepass">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                        <td>입장+놀이자유</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>연간이용권</td>
                        <td>70,000</td>
                        <td>
                            <select name="childyearpass">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                        <td>90,000</td>
                        <td>
                            <select name="adultyearpass">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                        <td>입장+놀이자유</td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php echo date("h:i:sa"); ?>
        <?php
            if (isset($_POST['name'])) {
                $sum = 7000 * $_POST['childpass'] + 10000 * $_POST['adultpass'] + 12000 * $_POST['childBIG3'] + 16000 * $_POST['adultBIG3'] + 21000 * $_POST['childfreepass'] + 26000 * $_POST['adultfreepass'] + 70000 * $_POST['childyearpass'] + 90000 * $_POST['adultyearpass'];
                $total = $_POST['childpass'] + $_POST['adultpass'] + $_POST['childBIG3'] + $_POST['adultBIG3'] + $_POST['childfreepass'] + $_POST['adultfreepass'] + $_POST['childyearpass'] + $_POST['adultyearpass'];
                /* insert */
                $sql=" INSERT INTO  `ticket` ".
                "VALUES ('$_POST[name]',  '$_POST[childpass]',  '$_POST[childBIG3]',  '$_POST[childfreepass]',  '$_POST[childyearpass]',  '$_POST[adultpass]',  '$_POST[adultBIG3]',  '$_POST[adultfreepass]', '$_POST[adultyearpass]', '$total')";
                mysqli_query($link,$sql);

                echo "<p>" . date("Y\년 n\월 j\일");
                if (date("a") == "am")
                {
                    echo " 오전 ";
                }
                else
                {
                    echo " 오후 ";
                }
                echo date("g:i") . "</p>";
                echo "<p>". $_POST['name'] ."고객님 감사합니다.</p>";
                if ($_POST['childpass'] > 0)
                {
                    echo "<p>어린이 입장권 ". $_POST['childpass'] . "매</p>";
                }
                if ($_POST['childBIG3'] > 0)
                {
                    echo "<p>어린이 BIG3 ". $_POST['childBIG3'] . "매</p>";
                }
                if ($_POST['childfreepass'] > 0)
                {
                    echo "<p>어린이 자유이용권 ". $_POST['childfreepass'] . "매</p>";
                }
                if ($_POST['childyearpass'] > 0)
                {
                    echo "<p>어린이 연간이용권 ". $_POST['childyearpass'] . "매</p>";
                }
                if ($_POST['adultpass'] > 0)
                {
                    echo "<p>어른 입장권 ". $_POST['adultpass'] . "매</p>";
                }
                if ($_POST['adultBIG3'] > 0)
                {
                    echo "<p>어른 BIG3 ". $_POST['adultBIG3'] . "매</p>";
                }
                if ($_POST['adultfreepass'] > 0)
                {
                    echo "<p>어른 자유이용권 ". $_POST['adultfreepass'] . "매</p>";
                }
                if ($_POST['adultyearpass'] > 0)
                {
                    echo "<p>어른 연간이용권 ". $_POST['adultyearpass'] . "매</p>";
                }
                echo "<p>합계 $sum 입니다.</p>";
            }
            mysqli_close($link);
        ?>
    </div>
</body>
</html>