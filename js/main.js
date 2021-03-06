let restoran = {
    collectData: function () {
        restoran.fDuration = parseInt(document.getElementById('filterDuration').value);
        restoran.fPersonCount = document.getElementById('filterPersonCount').value;
        let date = new Date(document.getElementById('filterDate').value);
        restoran.fDateStart = date.getTime();
        restoran.fDateFinish = restoran.fDateStart+1000*60*60*restoran.fDuration;
        restoran.fRestoranID = parseInt(document.getElementById('restoran_id').value);
        restoran.fTel = parseInt(document.getElementById('tel').value)
    }
}
function createJsonTable(jsonMsg, body) {
    let tbl = document.createElement('table');
    let tblBody = document.createElement('tbody');
    let tHead = tbl.createTHead();
    let row = tHead.insertRow();
    let headData = Object.keys(jsonMsg[0])
    // Creating table head
    for (let key in headData) {
        let th = document.createElement('th');
        let text = document.createTextNode(headData[key]);
        th.appendChild(text);
        row.appendChild(th);
    }
    // Creating table body
    $.each(jsonMsg, function (key, value) {
        let row = tblBody.insertRow()
        $.each(value, function (key, value) {
            let cell = row.insertCell();
            let text = document.createTextNode(value);
            cell.appendChild(text);
        });
    });
    tbl.appendChild(tblBody);
    body.innerHTML="";
    body.append(tbl);
}
function searchRestorans() {
    restoran.collectData()
    $.ajax({
        method: "POST",
        url: "server.php",
        data: {form:'searchRestorans',json: JSON.stringify(restoran)}
    }).done(function (msg) {
        let jsonMSG = JSON.parse(msg);
        let destination = document.getElementById('listOfRestorans');
        createJsonTable(jsonMSG, destination);
    });
}
function putOrder() {
    restoran.collectData()
    $.ajax({
        method: "POST",
        url: "server.php",
        data: {form:'putOrder',json: JSON.stringify(restoran)}
    }).done(function (msg) {
        document.getElementById('listOfRestorans').innerText=msg;
    });
}
function getOrdersList() {
    $.ajax({
        method: "POST",
        url: "server.php",
        data: {form:'getOrdersList'}
    }).done(function (msg) {
        let jsonMSG = JSON.parse(msg);
        let destination = document.getElementById('listOfOrders');
        createJsonTable(jsonMSG, destination);
    });

}
document.getElementById('searchRestorans').addEventListener("click", function (e) {
    e.preventDefault();
    searchRestorans();
})
document.getElementById('putOrder').addEventListener("click", function (e) {
    e.preventDefault();
    putOrder();
})
document.getElementById('getOrdersList').addEventListener("click", function (e) {
    e.preventDefault();
    getOrdersList();
})
