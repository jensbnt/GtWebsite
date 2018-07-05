window.addEventListener("load", handleWindowLoad);

function handleWindowLoad() {
    let inputCategory = document.getElementById("inputCategory");
    inputCategory.addEventListener("input", handleCategoryInput);

    displayCategoriesBox(false);
}

function handleCategoryInput() {
    let inputCategory = document.getElementById("inputCategory");
    let category = inputCategory.value;
    const URL = '/gt/public/api/categories/' + category;

    if (category == "") {
        displayCategories([]);
    } else {
        fetch(URL)
            .then((response) => {
                return response.json()
            })
            .then((data) => {
                displayCategories(data)
            })
            .catch((exception) => {
                console.log(exception.message);
            });
    }
}

function displayCategories(data) {
    let categoriesList = document.getElementById("categories");

    if (data.length == 0) {
        displayCategoriesBox(false);
    } else {
        displayCategoriesBox(true);

        categoriesList.innerHTML = "";

        for (let i = 0; i < data.length; i++) {
            let item = document.createElement("div");
            item.innerHTML = data[i].category;
            item.onclick = useCategory;
            item.setAttribute("class", "dropdown-item");
            categoriesList.appendChild(item);
        }
    }
}

function useCategory(event) {
    let category = event.target.innerHTML;
    let inputCategory = document.getElementById("inputCategory");
    inputCategory.value = category;
    displayCategoriesBox(false);
}

function displayCategoriesBox(val) {
    let categoriesList = document.getElementById("categories");

    if (val) {
        categoriesList.style.display = 'block';
    } else {
        categoriesList.style.display = 'none';
    }
}