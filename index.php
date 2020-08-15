<?php
if (isset($_POST['form'])) {
    include ('server.php');} else {
?>
<!DOCTYPE html>
<html lang='ru'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <title>Расписание вечеринок!</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/main.js" defer async></script>
    </head>
<?php include ('templates/header.php') ?>
<body>
<div class="dateTimeInput">

    <form>
        <p>Выберите дату и время для заказа:</p>
        <label for="filterDate">Дата заказа:</label>
        <input id="filterDate" name="filterDate" type="datetime-local" value="">
        <label for="filterDuration">Выберите длительность в часах:</label>
        <input id="filterDuration" name="filterDuration" min="0" max="24" type="number" value="">
        <label for="filterPersonCount">Выберите количество людей:</label>
        <input id="filterPersonCount" name="filterPersonCount" min="1" type="number" value="">
        <input name="searchRestorans" id="searchRestorans" type="submit" value="Поиск">
    </form>


    <form>
        <p>Размещение Заказа</p>
        <label for="tel">Телефон:</label>
        <input name="tel" id="tel" type="tel">
        <label for="restoran_id">Номер ресторана:</label>
        <input name="restoran_id" id="restoran_id" type="number">
        <input name="putOrder" id="putOrder" type="submit" value="Размещение Заказа">
    </form>
    <div>
        <input type="button" id="getOrdersList" value="Получить список заказов">
    </div>

    <div id="listOfOrders"></div>
    <div id="listOfRestorans"></div>

</div>

</body>
<?php include ('templates/footer.php') ?>
</html>

<?php }?>