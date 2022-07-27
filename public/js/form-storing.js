const form = document.forms.test;
let elements = form.elements;

function saveFormData() {
    sessionStorage.clear();

    let userInputs = new Set();
    for (element of elements) {
        if (element.name) {
            userInputs.add(element.name);
        }
    }
    userInputs = Array.from(userInputs);
    userInputs.shift();

    for (let input of userInputs) {
        if (input.endsWith("[]")) {
            let value = [];
            for (let option of elements[input]) {
                if (option.checked) {
                    value.push(option.value);
                }
            }
            sessionStorage.setItem(input, JSON.stringify(value));
        } else {
            sessionStorage.setItem(input, elements[input].value);
        }
    }
}

function restoreFields() {
    let savedTestFields = Object.keys(sessionStorage).filter((item) =>
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
    let oldValues = Object.keys(sessionStorage);
    for (let key of oldValues) {
        if (elements[key]) {
            if (key.endsWith("[]")) {
                let value = JSON.parse(sessionStorage.getItem(key));
                for (let option of elements[key]) {
                    if (value.includes(option.value)) {
                        option.checked = true;
                    }
                }
            } else {
                elements[key].value = sessionStorage.getItem(key);
            }
        }
    }
}

restoreFields();
load();
setInterval(saveFormData, 15000);
