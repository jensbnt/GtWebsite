window.addEventListener("load", handleWindowLoad);

function handleWindowLoad() {
    let inputDrive = document.getElementById("inputDrive");
    inputDrive.addEventListener("input", handleDriveInput);

    displayDrivesBox(false);
}

function handleDriveInput() {
    let inputDrive = document.getElementById("inputDrive");
    let drive = inputDrive.value;
    const URL = '/gt/public/api/drives/' + drive;

    if (drive == "") {
        displayDrives([]);
    } else {
        fetch(URL)
            .then((response) => {
                return response.json()
            })
            .then((data) => {
                displayDrives(data)
            })
            .catch((exception) => {
                console.log(exception.message);
            });
    }
}

function displayDrives(data) {
    let drivesList = document.getElementById("drives");

    if (data.length == 0) {
        displayDrivesBox(false);
    } else {
        displayDrivesBox(true);

        drivesList.innerHTML = "";

        for (let i = 0; i < data.length; i++) {
            let item = document.createElement("div");
            item.innerHTML = data[i].drive;
            item.onclick = useDrive;
            item.setAttribute("class", "dropdown-item");
            drivesList.appendChild(item);
        }
    }
}

function useDrive(event) {
    let drive = event.target.innerHTML;
    let inputDrive = document.getElementById("inputDrive");
    inputDrive.value = drive;
    displayDrivesBox(false);
}

function displayDrivesBox(val) {
    let drivesList = document.getElementById("drives");

    if (val) {
        drivesList.style.display = 'block';
    } else {
        drivesList.style.display = 'none';
    }
}