$(document).ready(function () {
    const sub = $("#submitBtn");
    let count = 0;
    const tbl = $(".result");

    sub.on('click', function (e) {
        e.preventDefault();
        if (count = 0) {
            let query = document.getElementById("querSel").value;
            let sel = $("#querSel");
            sel.css("display", "none");
            let ttlChoice = $("ttlChoice");

            if ((query == 1) || (query = 5) || (query = 6) || (query = 7) || (query = 8)) {
                ttlChoice.html = "<h3>Enter Inputs for choice " + query + "</h3";
                switch (query) {
                    case 1:
                        let pastEv = $("#pastEv");
                        pastEv.css("display", "block");
                    case 5:
                        let incomes = $("#incomes");
                        incomes.css("display", "block");
                    case 6:
                        let insertEmp = $("#insertEmp");
                        insertEmp.css("display", "block");
                    case 7:
                        let discount = $("#discount");
                        discount.css("display", "block");
                    case 8:
                        let saleIncome = $("#saleIncome");
                        saleIncome.css("display", "block");
                }
                count++;
            } else {
                savePost();
                count = 0;
            }

        }
        else {
            savePost();
            count = 0;
        }
    })

    const savePost = async () => {
        try {
            debugger
            let response = await fetch('action.php', {
                method: 'GET',
                body: new FormData(form),
            });
            const result = await response.json();
            tbl.html(result.retVal);
        } catch (error) {
            console.log(error);
            tbl.html(("<span class='l'>" + error + "<span>"));
        }
    }
});