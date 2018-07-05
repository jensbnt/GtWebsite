window.addEventListener("load", handleWindowLoad);

function handleWindowLoad() {
    let inputMake = document.getElementById("inputMake");
    inputMake.addEventListener("input", handleMakeInput);

    displayMakesBox(false);
}

function handleMakeInput() {
    let inputMake = document.getElementById("inputMake");
    let make = inputMake.value;
    const URL = '/gt/public/api/makes/' + make;

    if (make == "") {
        displayMakes([]);
    } else {
        fetch(URL)
            .then((response) => {
                return response.json()
            })
            .then((data) => {
                displayMakes(data)
            })
            .catch((exception) => {
                console.log(exception.message);
            });
    }
}

function displayMakes(data) {
    let makesList = document.getElementById("makes");

    if (data.length == 0) {
        displayMakesBox(false);
    } else {
        displayMakesBox(true);

        makesList.innerHTML = "";

        for (let i = 0; i < data.length; i++) {
            let item = document.createElement("div");
            item.innerHTML = data[i].make;
            item.onclick = useMake;
            item.setAttribute("class", "dropdown-item");
            makesList.appendChild(item);
        }
    }
}

function useMake(event) {
    let make = event.target.innerHTML;
    let inputMake = document.getElementById("inputMake");
    inputMake.value = make;
    displayMakesBox(false);
}

function displayMakesBox(val) {
    let makesList = document.getElementById("makes");

    if (val) {
        makesList.style.display = 'block';
    } else {
        makesList.style.display = 'none';
    }
}