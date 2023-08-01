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

            if ((query == 1) || (query == 5) || (query == 6) || (query == 7) || (query == 8)) {
                let QPF = $("#QPF").children();
                for (let i=0; i<8; i++){
                    if(i!= query){
                        $(QPF.eq(i)).css("display", "none")
                    }
                }

                if (query == 1) {
                    let pastEv = $("#pastEv");
                    pastEv.css("display", "block");
                }
                else if (query == 5) {
                    let incomes = $("#incomes");
                    incomes.css("display", "block");
                }
                else if (query == 6) {
                    let insertEmp = $("#insertEmp");
                    insertEmp.css("display", "block");
                } else if (query == 7) {
                    let discount = $("#discount");
                    discount.css("display", "block");
                }
                else {
                    let saleIncome = $("#saleIncome");
                    saleIncome.css("display", "block")
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