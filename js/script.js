$(document).ready(function () {
    const sub = $("#submitBtn");
    const tbl = $(".result");
    let count = 0;
    let frm = $("#frm");

    frm.on('submit', function (e) {
        debugger
        e.preventDefault();
        if (count == 0) {
            let query = $("#querSel").val()
            let sel = $("#querSel");
            sel.css("display", "none");

            if ((query == 1) || (query == 5) || (query == 6) || (query == 7) || (query == 8)) {
                count++;
                let QPF = $("#QPF").children();
                for (let i = 0; i <= 8; i++) {
                    if (i != (query - 1)) {
                        $(QPF.eq(i)).css("display", "none");
                    }
                }
                if (query == 1) {
                    let pastEv = $("#pastEv");
                    pastEv.css("display", "block");
                    let pastEvChild =pastEv.children("input");
                    for (let i = 0; i < pastEvChild.length; i++){
                        pastEvChild.attr("required","true");
                    }
                }
                else if (query == 5) {
                    let incomes = $("#incomes");
                    incomes.css("display", "block");
                    let incomesChild =incomes.children("input");
                    for (let i = 0; i < incomesChild.length; i++){
                        incomesChild.attr("required","true");
                    }
                }
                else if (query == 6) {
                    let insertEmp = $("#insertEmp");
                    insertEmp.css("display", "block");
                    let incEmpChild =insertEmp.children("input");
                    for (let i = 0; i < incEmpChild.length; i++){
                        incEmpChild.attr("required","true");
                    }
                } else if (query == 7) {
                    let discount = $("#discount");
                    discount.css("display", "block");
                    let discountChild =discount.children("input");
                    for (let i = 0; i < discountChild.length; i++){
                        discountChild.attr("required","true");
                    }
                }
                else {
                    let saleIncome = $("#saleIncome");
                    saleIncome.css("display", "block");
                    let saleIncChild =saleIncome.children("input");
                    for (let i = 0; i < saleIncChild.length; i++){
                        saleIncChild.attr("required","true");
                    }
                }
            } else {
                count = 0;
                // savePost();
                frm.off('submit');
                frm.submit(); 
            }
        }
        else {
            count = 0;
            // savePost();
            frm.off('submit');
            frm.submit(); 
        }
    })

    // const savePost = async() => {
    //     try {
    //     debugger

    //         let response = await fetch('sortFilter.php', {
    //             method: 'GET',
    //             body: new FormData(frm),
    //         });
    //         const result = await response.json();
    //         list.html(result.retVal);
    //     } catch (error) {
    //         console.log(error);
    //         list.html(("<span class='l'>" + error + "<span>"));
    //     }
    // }
});