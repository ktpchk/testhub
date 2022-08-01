const form = document.forms.test;
let elements = form.elements;
let saveFormButton = document.getElementById("saveForm");

function saveFormData() {
    localStorage.clear();

    let userInputs = new Set();
    for (element of elements) {
        if (element.name) {
            userInputs.add(element.name);
        }
    }
    userInputs = Array.from(userInputs);
    userInputs.shift();

    for (let input of userInputs) {
        if (input.endsWith("[]") && elements[input].length) {
            let value = [];
            for (let option of elements[input]) {
                if (option.checked) {
                    value.push(option.value);
                }
            }
            localStorage.setItem(input, JSON.stringify(value));
        } else {
            localStorage.setItem(input, elements[input].value);
        }
    }
    window.formStatus = "saved";
}

function restoreFields() {
    let savedTestFields = Object.keys(localStorage).filter((item) =>
        item.match(/^questions\[\d\]\[answers\]/)
    );

    let readyTestFields = {};
    for (let field of savedTestFields) {
        field = field.split(/[\[\]]/);
        let m = field[1];
        if (!readyTestFields[m]) readyTestFields[m] = 0;
        readyTestFields[m]++;
    }
    readyTestFields = Object.values(readyTestFields);

    for (let question of readyTestFields) {
        document.querySelector(".questionAdder").click();
    }
    for (let question of Question.questions) {
        for (let i = 1; i < readyTestFields[question.number]; i++) {
            question.node.querySelector(".answerAdder").click();
        }
    }
}

function load() {
    let oldValues = Object.keys(localStorage);
    for (let key of oldValues) {
        if (elements[key]) {
            if (key.endsWith("[]") && elements[key].length) {
                let value = JSON.parse(localStorage.getItem(key));
                for (let option of elements[key]) {
                    if (value.includes(option.value)) {
                        option.checked = true;
                    }
                }
            } else {
                elements[key].value = localStorage.getItem(key);
            }
        }
    }
}

function traceChange() {
    window.formStatus = "modified";
    saveFormButton.disabled = false;
    saveFormButton.classList.remove("bg-classicBlue-50", "bg-opacity-60");
    saveFormButton.classList.add(
        "bg-classicBlue-300",
        "hover:bg-classicBlue-50"
    );
}
function traceSave() {
    window.formStatus = "saved";
    saveFormButton.disabled = true;
    saveFormButton.classList.remove(
        "bg-classicBlue-300",
        "hover:bg-classicBlue-50"
    );
    saveFormButton.classList.add("bg-classicBlue-50", "bg-opacity-60");
}

document.addEventListener("click", function (event) {
    let target = event.target.closest(".resetForm,#saveForm");
    if (!target) return;

    if (target.classList.contains("resetForm")) {
        if (confirm("Это действие необратимо. Вы уверены?")) {
            window.resetForm = true;
            localStorage.clear();
            location.reload();
        }
    } else if (target.id == "saveForm") {
        saveFormData();
        traceSave();
    }
});
form.addEventListener("change", traceChange);
document.addEventListener("click", function (e) {
    let target = e.target.closest(
        ".questionAdder,.deleteQuestion,.answerAdder,.deleteAnswer,.moveUp,.moveDown"
    );
    if (!target) return;
    traceChange();
});
window.onbeforeunload = function (e) {
    if (window.formStatus == "saved" || window.resetForm) return;
    e.preventDefault();
    e.returnValue = "";
};
form.addEventListener("submit", function (e) {
    e.preventDefault();
    saveFormData();
    window.onbeforeunload = null;
    this.submit();
});

restoreFields();
load();
traceSave();
setInterval(saveFormData, 30000);
