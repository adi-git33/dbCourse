$(document).ready(function () {
    const sub = $("#submitBtn");
    const tbl = $(".result");
    let count = 0;

    sub.on('click', function (e) {
        debugger
        e.preventDefault();
        if (count == 0) {
            let query = $("#querSel").val()
            let sel = $("#querSel");
            sel.css("display", "none");

            if ((query == 1) || (query = 5) || (query = 6) || (query = 7) || (query = 8)) {
                let ttlChoice = $("ttlChoice");
                ttlChoice.html = "<h3>Enter Inputs for choice " + query + "</h3";
                ttlChoice.css("display, block");
                switch (query) {
                    case 1: {
                        let pastEv = $("#pastEv");
                        pastEv.css("display", "block");
                        break;
                    }
                    case 5: {
                        let incomes = $("#incomes");
                        incomes.css("display", "block");
                        break;
                    }
                    case 6: {
                        let insertEmp = $("#insertEmp");
                        insertEmp.css("display", "block");
                        break;
                    }
                    case 7: {
                        let discount = $("#discount");
                        discount.css("display", "block");
                        break;
                    }
                    case 8: {
                        let saleIncome = $("#saleIncome");
                        saleIncome.css("display", "block");
                        break;
                    }
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