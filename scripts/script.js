function addCar() {
    var carName = document.getElementById('carInput').value;
    if (carName.trim() !== '') {
        var table = document.getElementById('car-Table-Body');
        var newRow = table.insertRow(table.rows.length);
        var cell = newRow.insertCell(0);
        cell.textContent = carName;
        document.getElementById('carInput').value = '';
    } else {
        alert('Please enter a car name !');
    }
}