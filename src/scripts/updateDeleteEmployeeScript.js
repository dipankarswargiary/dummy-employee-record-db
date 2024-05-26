
function selectRow(elem) {

    // removing 'selected-cell' class from the entire table
    let row = document.getElementById("tableBody").firstElementChild;

    while (row) {
        let cell = row.firstElementChild;
        if (cell.classList.contains("selected-cell")) {
            while(cell.nextElementSibling) {
                cell.classList.remove("selected-cell");
                cell = cell.nextElementSibling;
            }
        }

        row = row.nextElementSibling;
    }

    // adding 'selected-cell' class to the clicked row
    let selectedCell = elem.firstElementChild;
    while (selectedCell.nextElementSibling) {
        selectedCell.classList.add("selected-cell");
        selectedCell = selectedCell.nextElementSibling;
    }

    // Filling the update form with selected data
    document.getElementById("empID").value = elem.children[0].firstElementChild.value;
    document.getElementById("name").value = elem.children[1].innerHTML;
    document.getElementById("address").value = elem.children[2].innerHTML;
    document.getElementById("designation").value = elem.children[3].innerHTML;
    document.getElementById("department").value = elem.children[4].firstElementChild.value;
}