const saveToLocalStorage = (key, data) => {
    if (data.length != 0) {
        localStorage.setItem(key, JSON.stringify(data));
    }
};

const showFromLocalStorage = (key, displayType) => {
    const data = JSON.parse(localStorage.getItem(key));

    const outputDiv = document.createElement("div");

    if (data) {
        if (displayType === "table") {
            const table = document.createElement("table");
            table.border = "1";

            const thead = document.createElement("thead");
            const headerRow = document.createElement("tr");
            const headers = Object.keys(data[0]);

            headers.forEach((header) => {
                const th = document.createElement("th");
                th.textContent = header.charAt(0).toUpperCase() + header.slice(1);
                headerRow.appendChild(th);
            });

            thead.appendChild(headerRow);
            table.appendChild(thead);

            const tbody = document.createElement("tbody");

            data.forEach((item) => {
                const row = document.createElement("tr");

                headers.forEach((header) => {
                    const cell = document.createElement("td");
                    if (Array.isArray(item[header])) {
                        cell.textContent = item[header].join(", ");
                    } else {
                        cell.textContent = item[header];
                    }
                    row.appendChild(cell);
                });

                tbody.appendChild(row);
            });

            table.appendChild(tbody);
            outputDiv.appendChild(table);
        } else if (displayType === "list") {
            const ul = document.createElement("ul");

            data.forEach((item) => {
                const li = document.createElement("li");
                li.textContent = item;
                ul.appendChild(li);
            });

            outputDiv.appendChild(ul);
        } else {
            const pre = document.createElement("pre");
            pre.textContent = JSON.stringify(data, null, 2);
            outputDiv.appendChild(pre);
        }
    } else {
        const message = document.createElement("p");
        message.textContent = "Немає збережених даних у локальному сховищі для цього ключа.";
        outputDiv.appendChild(message);
    }

    document.body.appendChild(outputDiv);
};
